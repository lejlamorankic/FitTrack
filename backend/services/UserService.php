
<?php

require_once __DIR__ . '/../dao/UserDao.php';

class UserService
{
    private UserDao $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function get_all()
    {
        return $this->sanitize_users(
            $this->userDao->get_all()
        );
    }

    public function get_by_id($id)
    {
        $user = $this->userDao->get_by_id(
            $this->validate_id($id)
        );

        if (!$user) {
            throw new RuntimeException("User not found", 404);
        }

        return $this->sanitize_user($user);
    }

    public function add($data)
    {
        $this->validate_user($data);

        if ($this->userDao->get_by_email($data['email'])) {
            throw new InvalidArgumentException(
                "Email already exists", 400
            );
        }

        $user = [
            'name' => trim($data['name']),
            'email' => trim($data['email']),
            'password' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            ),
            'role' => 'user'
        ];

        return $this->userDao->add($user);
    }

    public function update($data, $id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        if (!is_array($data)) {
            throw new InvalidArgumentException(
                "Invalid user data", 400
            );
        }

        $allowed = ['name', 'email'];
        $update = array_intersect_key(
            $data,
            array_flip($allowed)
        );

        if (empty($update)) {
            throw new InvalidArgumentException(
                "No valid fields provided", 400
            );
        }

        if (isset($update['name'])) {
            if (!is_string($update['name']) ||
                trim($update['name']) === '') {
                throw new InvalidArgumentException(
                    "Name is required", 400
                );
            }

            $update['name'] = trim($update['name']);
        }

        if (isset($update['email'])) {
            if (!is_string($update['email']) ||
                !filter_var($update['email'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException(
                    "Invalid email address", 400
                );
            }

            $existing = $this->userDao->get_by_email(
                $update['email']
            );

            if ($existing && (int)$existing['user_id'] !== $id) {
                throw new InvalidArgumentException(
                    "Email already exists", 400
                );
            }
        }

        return $this->userDao->update(
            $update,
            $id,
            'user_id'
        );
    }

    public function delete($id)
    {
        $id = $this->validate_id($id);
        $this->get_by_id($id);

        return $this->userDao->delete($id, 'user_id');
    }

    private function validate_user($data)
    {
        if (!is_array($data) ||
            !isset($data['name'], $data['email'], $data['password']) ||
            !is_string($data['name']) ||
            trim($data['name']) === '' ||
            !is_string($data['email']) ||
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ||
            !is_string($data['password']) ||
            strlen($data['password']) < 8) {
            throw new InvalidArgumentException(
                "Valid name, email and password (min 8 characters) required",
                400
            );
        }
    }

    private function validate_id($id): int
    {
        $validated = filter_var(
            $id,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );

        if ($validated === false) {
            throw new InvalidArgumentException(
                "Invalid user ID", 400
            );
        }

        return $validated;
    }

    private function sanitize_user($user)
    {
        unset($user['password']);
        return $user;
    }

    private function sanitize_users($users)
    {
        return array_map(
            [$this, 'sanitize_user'],
            $users
        );
    }
}
