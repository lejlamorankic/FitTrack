
<?php

require_once __DIR__ . '/BaseDao.php';

class ProgressDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('progress');
    }

    public function get_by_user($user_id)
    {
        return $this->query(
            "SELECT * FROM progress WHERE user_id = :user_id ORDER BY recorded_at DESC",
            ['user_id' => $user_id]
        );
    }
}
