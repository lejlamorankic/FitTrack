<?php

require_once __DIR__ . '/BaseDao.php';

class MealDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("meals");
    }

    public function get_by_id($id, $id_column = "meal_id")
    {
        return parent::get_by_id($id, $id_column);
    }

    public function get_by_user($user_id)
    {
        return $this->query(
            "SELECT * FROM meals
             WHERE user_id = :user_id
             ORDER BY date DESC",
            ["user_id" => $user_id]
        );
    }
}