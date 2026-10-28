
<?php

require_once __DIR__ . '/BaseDao.php';

class HydrationDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('hydration');
    }

    public function get_by_user($user_id)
    {
        return $this->query(
            "SELECT * FROM hydration WHERE user_id = :user_id ORDER BY date DESC",
            ['user_id' => $user_id]
        );
    }
}
