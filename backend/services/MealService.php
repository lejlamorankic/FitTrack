
<?php

require_once __DIR__ . '/../dao/MealDao.php';

class MealService
{
    private MealDao $mealDao;

    public function __construct()
    {
        $this->mealDao = new MealDao();
    }

    public function get_all()
    {
        return $this->mealDao->get_all();
    }

    public function get_by_id($id)
    {
        $id = $this->validate_id($id);

        $meal = $this->mealDao->get_by_id($id);

        if (!$meal) {
            throw new RuntimeException("Meal not found", 404);
        }

        return $meal;
    }

    public function get_by_user($user_id)
    {
        return $this->mealDao->get_by_user(
            $this->validate_id($user_id)
        );
    }

    public function add($data)
    {
        $meal = $this->validate_data($data);

        return $this->mealDao->add($meal);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        $meal = $this->validate_data($data, false);

        if (empty($meal)) {
            throw new InvalidArgumentException(
                "No valid fields provided", 400
            );
        }

        return $this->mealDao->update(
            $meal,
            $id,
            'meal_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        return $this->mealDao->delete(
            $id,
            'meal_id'
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
                "Invalid meal data", 400
            );
        }

        $allowed = [
            'user_id',
            'name',
            'calories',
            'date'
        ];

        $meal = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if ($required) {
            foreach ($allowed as $field) {
                if (!isset($meal[$field])) {
                    throw new InvalidArgumentException(
                        "$field is required", 400
                    );
                }
            }
        }

        if (array_key_exists('user_id', $meal)) {
            $meal['user_id'] = $this->validate_id(
                $meal['user_id']
            );
        }

        if (array_key_exists('name', $meal)) {
            if (!is_string($meal['name']) ||
                trim($meal['name']) === '') {
                throw new InvalidArgumentException(
                    "Meal name is required", 400
                );
            }

            $meal['name'] = trim($meal['name']);
        }

        if (array_key_exists('calories', $meal)) {
            if (!is_numeric($meal['calories']) ||
                $meal['calories'] < 0) {
                throw new InvalidArgumentException(
                    "Calories must be zero or greater", 400
                );
            }
        }

        if (array_key_exists('date', $meal)) {
            if (!is_string($meal['date'])) {
                throw new InvalidArgumentException(
                    "Invalid date", 400
                );
            }

            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $meal['date']
            );

            if (!$date ||
                $date->format('Y-m-d') !== $meal['date']) {
                throw new InvalidArgumentException(
                    "Date must be YYYY-MM-DD", 400
                );
            }
        }

        return $meal;
    }
}
