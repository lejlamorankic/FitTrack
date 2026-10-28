
<?php

require_once __DIR__ . '/../config/Database.php';

class BaseDao
{
    protected $conn;
    protected $table;

    public function __construct($table)
    {
        $this->conn = Database::connect();
        $this->table = $table;
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query_unique($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_all()
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    public function get_by_id($id, $id_column = "id")
    {
        return $this->query_unique(
            "SELECT * FROM {$this->table} WHERE {$id_column} = :id",
            ["id" => $id]
        );
    }

    public function add($entity)
    {
        $columns = array_keys($entity);

        $column_names = implode(", ", $columns);
        $placeholders = ":" . implode(", :", $columns);

        $sql = "INSERT INTO {$this->table} ($column_names)
                VALUES ($placeholders)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($entity);

        return $this->conn->lastInsertId();
    }

    public function update($entity, $id, $id_column = "id")
    {
        $columns = array_keys($entity);
        $set = [];

        foreach ($columns as $column) {
            $set[] = "$column = :$column";
        }

        $set_clause = implode(", ", $set);

        $sql = "UPDATE {$this->table}
                SET $set_clause
                WHERE {$id_column} = :record_id";

        $entity["record_id"] = $id;

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($entity);
    }

    public function delete($id, $id_column = "id")
    {
        $sql = "DELETE FROM {$this->table}
                WHERE {$id_column} = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(["id" => $id]);
    }
}
