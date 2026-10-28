<?php

require_once __DIR__ . '/BaseDao.php';

class WorkoutDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("workouts");
    }

    public function get_by_id($id, $id_column = "workout_id")
    {
        return parent::get_by_id($id, $id_column);
    }

    public function get_by_user($user_id)
    {
        return $this->query(
            "SELECT * FROM workouts
             WHERE user_id = :user_id
             ORDER BY date DESC",
            ["user_id" => $user_id]
        );
    }
}