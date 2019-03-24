<?php
namespace App\Models;

use App\Core\Database\Database;
use App\Core\Database\MysqlDriver;

class AbstractModel
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Database::init(new MysqlDriver(config('database')));
    }

    public function getTableName()
    {
        return $this->table;
    }

    public function all()
    {
        $query = 'SELECT * FROM '.$this->getTableName();
        return $this->db->fetch($query);
    }

    public function find($id)
    {
        $query = 'SELECT * FROM '.$this->getTableName(). ' WHERE id = :id LIMIT 1';
        return $this->db->fetchOne($query, ['id' => $id]) ?? null;
    }
}