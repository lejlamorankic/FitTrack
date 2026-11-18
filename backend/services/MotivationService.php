
<?php

require_once __DIR__ . '/../dao/MotivationDao.php';

class MotivationService
{
    private MotivationDao $motivationDao;


public function get_random_quote()
{
    $url = 'https://zenquotes.io/api/random';

    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 10,
            'ignore_errors' => true
        ]
    ]);

    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        throw new RuntimeException(
            "External motivation API unavailable",
            503
        );
    }

    $data = json_decode($response, true);

    if (
        !is_array($data) ||
        !isset($data[0]['q'], $data[0]['a'])
    ) {
        throw new RuntimeException(
            "Invalid response from motivation API",
            502
        );
    }

    return [
        'quote' => $data[0]['q'],
        'author' => $data[0]['a']
    ];
}


    public function __construct()
    {
        $this->motivationDao = new MotivationDao();
    }

    public function get_all()
    {
        return $this->motivationDao->get_all();
    }

    public function get_by_id($id)
    {
        $id = $this->validate_id($id);

        $motivation = $this->motivationDao->get_by_id($id);

        if (!$motivation) {
            throw new RuntimeException(
                "Motivation record not found",
                404
            );
        }

        return $motivation;
    }

    public function get_by_user($user_id)
    {
        return $this->motivationDao->get_by_user(
            $this->validate_id($user_id)
        );
    }

    public function add($data)
    {
        $motivation = $this->validate_data($data);

        return $this->motivationDao->add($motivation);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);

        $this->get_by_id($id);

        $motivation = $this->validate_data(
            $data,
            false
        );

        if (empty($motivation)) {
            throw new InvalidArgumentException(
                "No valid fields provided",
                400
            );
        }

        return $this->motivationDao->update(
            $motivation,
            $id,
            'motivation_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);

        $this->get_by_id($id);

        return $this->motivationDao->delete(
            $id,
            'motivation_id'
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
                "Invalid motivation ID",
                400
            );
        }

        return $result;
    }

    private function validate_data($data, $required = true)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException(
                "Invalid motivation data",
                400
            );
        }

        $allowed = [
            'user_id',
            'quote',
            'date'
        ];

        $motivation = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if ($required) {
            foreach ($allowed as $field) {
                if (!isset($motivation[$field])) {
                    throw new InvalidArgumentException(
                        "$field is required",
                        400
                    );
                }
            }
        }

        if (array_key_exists('user_id', $motivation)) {
            $motivation['user_id'] = $this->validate_id(
                $motivation['user_id']
            );
        }

        if (array_key_exists('quote', $motivation)) {
            if (
                !is_string($motivation['quote']) ||
                trim($motivation['quote']) === ''
            ) {
                throw new InvalidArgumentException(
                    "Motivation quote is required",
                    400
                );
            }

            if (mb_strlen($motivation['quote']) > 500) {
                throw new InvalidArgumentException(
                    "Quote cannot exceed 500 characters",
                    400
                );
            }

            $motivation['quote'] = trim(
                $motivation['quote']
            );
        }

        if (array_key_exists('date', $motivation)) {
            if (!is_string($motivation['date'])) {
                throw new InvalidArgumentException(
                    "Invalid date",
                    400
                );
            }

            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $motivation['date']
            );

            if (
                !$date ||
                $date->format('Y-m-d') !== $motivation['date']
            ) {
                throw new InvalidArgumentException(
                    "Date must be YYYY-MM-DD",
                    400
                );
            }
        }

        return $motivation;
    }
}
