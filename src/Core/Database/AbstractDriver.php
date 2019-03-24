<?php
namespace App\Core\Database;

abstract class AbstractDriver
{
    /** @var \PDO */
    protected $db;

    /**
     * @param $query
     * @param $data
     * @return array
     */
    public function fetch(string $query, array $data = [])
    {
        $stmt = $this->db->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute($data);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $query
     * @param array $data
     * @return bool|\PDOStatement
     */
    public function execute(string $query, array $data = [])
    {
        $stmt = $this->db->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute($data);
        return $stmt;
    }

    /**
     * @param string $query
     * @param array $data
     * @return bool
     */
    public function insert(string $query, array $data)
    {
        $stmt = $this->db->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }
}