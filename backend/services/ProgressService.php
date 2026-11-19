
<?php

require_once __DIR__ . '/../dao/ProgressDao.php';

class ProgressService
{
    private ProgressDao $progressDao;

    public function __construct()
    {
        $this->progressDao = new ProgressDao();
    }

    public function get_all()
    {
        return $this->progressDao->get_all();
    }

    public function get_by_id($id)
    {
        $id = $this->validate_id($id);

        $progress = $this->progressDao->get_by_id(
            $id,
            'progress_id'
        );

        if (!$progress) {
            throw new RuntimeException(
                "Progress record not found", 404
            );
        }

        return $progress;
    }

    public function get_by_user($user_id)
    {
        return $this->progressDao->get_by_user(
            $this->validate_id($user_id)
        );
    }

    public function add($data)
    {
        $progress = $this->validate_data($data);

        return $this->progressDao->add($progress);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        $progress = $this->validate_data(
            $data,
            false
        );

        if (empty($progress)) {
            throw new InvalidArgumentException(
                "No valid fields provided", 400
            );
        }

        return $this->progressDao->update(
            $progress,
            $id,
            'progress_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        return $this->progressDao->delete(
            $id,
            'progress_id'
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
                "Invalid progress ID", 400
            );
        }

        return $result;
    }

    private function validate_data($data, $required = true)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException(
                "Invalid progress data", 400
            );
        }

        $allowed = [
            'user_id',
            'weight_kg',
            'notes',
            'recorded_at'
        ];

        $progress = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if ($required) {
            foreach (['user_id', 'weight_kg', 'recorded_at'] as $field) {
                if (!isset($progress[$field])) {
                    throw new InvalidArgumentException(
                        "$field is required", 400
                    );
                }
            }
        }

        if (array_key_exists('user_id', $progress)) {
            $progress['user_id'] = $this->validate_id(
                $progress['user_id']
            );
        }

        if (array_key_exists('weight_kg', $progress)) {
            if (!is_numeric($progress['weight_kg']) ||
                !is_finite((float)$progress['weight_kg']) ||
                (float)$progress['weight_kg'] <= 0 ||
                (float)$progress['weight_kg'] > 500) {
                throw new InvalidArgumentException(
                    "Weight must be between 0 and 500 kg",
                    400
                );
            }

            $progress['weight_kg'] = (float)$progress['weight_kg'];
        }

        if (array_key_exists('notes', $progress)) {
            if ($progress['notes'] !== null &&
                !is_string($progress['notes'])) {
                throw new InvalidArgumentException(
                    "Notes must be text", 400
                );
            }

            if (is_string($progress['notes'])) {
                $progress['notes'] = trim($progress['notes']);
            }
        }

        if (array_key_exists('recorded_at', $progress)) {
            if (!is_string($progress['recorded_at'])) {
                throw new InvalidArgumentException(
                    "Invalid recorded_at", 400
                );
            }

            $value = $progress['recorded_at'];

            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $value
            );

            $dateTime = DateTimeImmutable::createFromFormat(
                '!Y-m-d H:i:s',
                $value
            );

            $validDate = $date &&
                $date->format('Y-m-d') === $value;

            $validDateTime = $dateTime &&
                $dateTime->format('Y-m-d H:i:s') === $value;

            if (!$validDate && !$validDateTime) {
                throw new InvalidArgumentException(
                    "recorded_at must be YYYY-MM-DD or YYYY-MM-DD HH:MM:SS",
                    400
                );
            }
        }

        return $progress;
    }
}
