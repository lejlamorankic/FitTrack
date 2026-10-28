
<?php

require_once __DIR__ . '/BaseDao.php';

class ExerciseDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('exercises');
    }

    public function get_by_muscle_group($muscle_group)
    {
        return $this->query(
            "SELECT * FROM exercises WHERE muscle_group = :muscle_group",
            ['muscle_group' => $muscle_group]
        );
    }
}
