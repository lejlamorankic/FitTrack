
<?php

require_once __DIR__ . '/BaseDao.php';

class MotivationDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('motivation');
    }

    public function get_by_id($id, $id_column = 'motivation_id')
    {
        return parent::get_by_id($id, $id_column);
    }

    public function get_by_user($user_id)
    {
        return $this->query(
            "SELECT * FROM motivation
             WHERE user_id = :user_id
             ORDER BY date DESC",
            ['user_id' => $user_id]
        );
    }
}
