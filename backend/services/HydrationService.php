
<?php

require_once __DIR__ . '/../dao/HydrationDao.php';

class HydrationService
{
    private HydrationDao $hydrationDao;

    public function __construct()
    {
        $this->hydrationDao = new HydrationDao();
    }

    public function get_all()
    {
        return $this->hydrationDao->get_all();
    }

    public function get_by_id($id)
    {
        $id = $this->validate_id($id);

        $hydration = $this->hydrationDao->get_by_id(
            $id,
            'hydration_id'
        );

        if (!$hydration) {
            throw new RuntimeException(
                "Hydration record not found", 404
            );
        }

        return $hydration;
    }

    public function get_by_user($user_id)
    {
        return $this->hydrationDao->get_by_user(
            $this->validate_id($user_id)
        );
    }

    public function add($data)
    {
        $hydration = $this->validate_data($data);

        return $this->hydrationDao->add($hydration);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        $hydration = $this->validate_data(
            $data,
            false
        );

        if (empty($hydration)) {
            throw new InvalidArgumentException(
                "No valid fields provided", 400
            );
        }

        return $this->hydrationDao->update(
            $hydration,
            $id,
            'hydration_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        return $this->hydrationDao->delete(
            $id,
            'hydration_id'
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
                "Invalid hydration data", 400
            );
        }

        $allowed = [
            'user_id',
            'amount_ml',
            'date'
        ];

        $hydration = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if ($required) {
            foreach ($allowed as $field) {
                if (!isset($hydration[$field])) {
                    throw new InvalidArgumentException(
                        "$field is required", 400
                    );
                }
            }
        }

        if (array_key_exists('user_id', $hydration)) {
            $hydration['user_id'] = $this->validate_id(
                $hydration['user_id']
            );
        }

        if (array_key_exists('amount_ml', $hydration)) {
            $amount = filter_var(
                $hydration['amount_ml'],
                FILTER_VALIDATE_INT
            );

            if ($amount === false || $amount <= 0) {
                throw new InvalidArgumentException(
                    "Water amount must be greater than 0 ml",
                    400
                );
            }

            $hydration['amount_ml'] = $amount;
        }

        if (array_key_exists('date', $hydration)) {
            if (!is_string($hydration['date'])) {
                throw new InvalidArgumentException(
                    "Invalid date", 400
                );
            }

            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $hydration['date']
            );

            if (!$date ||
                $date->format('Y-m-d') !== $hydration['date']) {
                throw new InvalidArgumentException(
                    "Date must be YYYY-MM-DD", 400
                );
            }
        }

        return $hydration;
    }
}
