<?php

require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("users");
    }

    public function get_by_id($id, $id_column = "user_id")
    {
        return parent::get_by_id($id, $id_column);
    }

    public function get_by_email($email)
    {
        return $this->query_unique(
            "SELECT * FROM users WHERE email = :email",
            ["email" => $email]
        );
    }
}