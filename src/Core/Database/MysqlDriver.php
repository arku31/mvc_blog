<?php
namespace App\Core\Database;

use PDO;

class MysqlDriver extends AbstractDriver
{
    /**
     * MysqlDriver constructor.
     * @param array $dbconfig
     */
    public function __construct(array $dbconfig)
    {
        $dsn = "mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']}";
        $this->db = new PDO($dsn, $dbconfig['user'], $dbconfig['password']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}