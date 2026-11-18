
<?php

require_once __DIR__ . '/../dao/ExerciseDao.php';

class ExerciseService
{
    private ExerciseDao $exerciseDao;

    public function __construct()
    {
        $this->exerciseDao = new ExerciseDao();
    }

    public function get_all()
    {
        return $this->exerciseDao->get_all();
    }

    public function get_by_id($id)
    {
        $id = $this->validate_id($id);

        $exercise = $this->exerciseDao->get_by_id(
            $id,
            'exercise_id'
        );

        if (!$exercise) {
            throw new RuntimeException(
                "Exercise not found", 404
            );
        }

        return $exercise;
    }

    public function get_by_muscle_group($muscle_group)
    {
        if (!is_string($muscle_group) ||
            trim($muscle_group) === '') {
            throw new InvalidArgumentException(
                "Muscle group is required", 400
            );
        }

        return $this->exerciseDao->get_by_muscle_group(
            trim($muscle_group)
        );
    }

    public function add($data)
    {
        $exercise = $this->validate_data($data);

        return $this->exerciseDao->add($exercise);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        $exercise = $this->validate_data(
            $data,
            false
        );

        if (empty($exercise)) {
            throw new InvalidArgumentException(
                "No valid fields provided", 400
            );
        }

        return $this->exerciseDao->update(
            $exercise,
            $id,
            'exercise_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        return $this->exerciseDao->delete(
            $id,
            'exercise_id'
        );
    }

    private function validate_id($id): int
    {
        $result = filter_var(
            $id,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($result === false) {
            throw new InvalidArgumentException(
                "Invalid exercise ID", 400
            );
        }

        return $result;
    }

    private function validate_data($data, $required = true)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException(
                "Invalid exercise data", 400
            );
        }

        $allowed = [
            'name',
            'muscle_group',
            'difficulty'
        ];

        $exercise = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if ($required) {
            foreach ($allowed as $field) {
                if (!isset($exercise[$field])) {
                    throw new InvalidArgumentException(
                        "$field is required", 400
                    );
                }
            }
        }

        foreach (['name', 'muscle_group', 'difficulty'] as $field) {
            if (array_key_exists($field, $exercise)) {
                if (!is_string($exercise[$field]) ||
                    trim($exercise[$field]) === '') {
                    throw new InvalidArgumentException(
                        "$field cannot be empty", 400
                    );
                }

                $exercise[$field] = trim($exercise[$field]);
            }
        }

        if (array_key_exists('difficulty', $exercise)) {
            $allowedDifficulties = [
                'beginner',
                'intermediate',
                'advanced'
            ];

            $difficulty = strtolower(
                $exercise['difficulty']
            );

            if (!in_array(
                $difficulty,
                $allowedDifficulties,
                true
            )) {
                throw new InvalidArgumentException(
                    "Difficulty must be beginner, intermediate or advanced",
                    400
                );
            }

            $exercise['difficulty'] = $difficulty;
        }

        return $exercise;
    }
}
