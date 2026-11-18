
<?php

require_once __DIR__ . '/../dao/WorkoutDao.php';

class WorkoutService
{
    private WorkoutDao $workoutDao;

    public function __construct()
    {
        $this->workoutDao = new WorkoutDao();
    }

    public function get_all()
    {
        return $this->workoutDao->get_all();
    }

    public function get_by_id($id)
    {
        $id = $this->validate_id($id);

        $workout = $this->workoutDao->get_by_id($id);

        if (!$workout) {
            throw new RuntimeException("Workout not found", 404);
        }

        return $workout;
    }

    public function get_by_user($user_id)
    {
        return $this->workoutDao->get_by_user(
            $this->validate_id($user_id)
        );
    }

    public function add($data)
    {
        $workout = $this->validate_data($data);

        return $this->workoutDao->add($workout);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        $workout = $this->validate_data($data, false);

        if (empty($workout)) {
            throw new InvalidArgumentException(
                "No valid fields provided", 400
            );
        }

        return $this->workoutDao->update(
            $workout,
            $id,
            'workout_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        return $this->workoutDao->delete(
            $id,
            'workout_id'
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
                "Invalid ID", 400
            );
        }

        return $result;
    }

    private function validate_data($data, $required = true)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException(
                "Invalid workout data", 400
            );
        }

        $allowed = [
            'user_id',
            'name',
            'duration',
            'calories',
            'date',
            'exercise_id'
        ];

        $workout = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if ($required) {
            foreach (['user_id', 'name', 'duration', 'date'] as $field) {
                if (!isset($workout[$field])) {
                    throw new InvalidArgumentException(
                        "$field is required", 400
                    );
                }
            }
        }

        if (array_key_exists('user_id', $workout)) {
            $workout['user_id'] = $this->validate_id(
                $workout['user_id']
            );
        }

        if (array_key_exists('exercise_id', $workout) &&
            $workout['exercise_id'] !== null) {
            $workout['exercise_id'] = $this->validate_id(
                $workout['exercise_id']
            );
        }

        if (array_key_exists('name', $workout)) {
            if (!is_string($workout['name']) ||
                trim($workout['name']) === '') {
                throw new InvalidArgumentException(
                    "Workout name is required", 400
                );
            }

            $workout['name'] = trim($workout['name']);
        }

        foreach (['duration', 'calories'] as $field) {
            if (array_key_exists($field, $workout)) {
                if (!is_numeric($workout[$field]) ||
                    $workout[$field] < 0 ||
                    ($field === 'duration' && $workout[$field] == 0)) {
                    throw new InvalidArgumentException(
                        "Invalid $field", 400
                    );
                }
            }
        }

        if (array_key_exists('date', $workout)) {
            if (!is_string($workout['date'])) {
                throw new InvalidArgumentException(
                    "Invalid date", 400
                );
            }

            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $workout['date']
            );

            if (!$date ||
                $date->format('Y-m-d') !== $workout['date']) {
                throw new InvalidArgumentException(
                    "Date must be YYYY-MM-DD", 400
                );
            }
        }

        return $workout;
    }
}
