<?php
namespace App\Core\Database;

class Database
{
    private static $instance;
    protected $driver;

    /**
     * Database constructor.
     * @param AbstractDriver $driver
     */
    protected function __construct(AbstractDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param AbstractDriver $driver
     * @return Database
     */
    public static function init(AbstractDriver $driver)
    {
        if (empty(self::$instance) || !(self::$instance instanceof $driver)) {
            self::$instance = new self($driver);
        }
        return self::$instance;
    }

    /**
     * @param $query
     * @param array $data
     * @return array
     */
    public function fetch($query, $data = [])
    {
        return $this->driver->fetch($query, $data);
    }

    /**
     * @param $query
     * @param array $data
     * @return bool|\PDOStatement
     */
    public function execute($query, $data = [])
    {
        return $this->driver->execute($query, $data);
    }

    /**
     * @param $query
     * @param $data
     * @return mixed|null
     */
    public function fetchOne($query, $data)
    {
        return $this->driver->fetch($query, $data)[0] ?? null;
    }

    /**
     * @param $data
     * @param $table
     * @return int
     */
    public function insert($data, $table)
    {
        $query = " INSERT INTO `$table`";
        $keys = array_map(function ($item) {
            return str_pad($item, strlen($item) + 2, "`", STR_PAD_BOTH);
        }, array_keys($data));
        $query .= ' (' . implode(', ', $keys) . ') ';

        $insertValues = [];
        foreach ($data as $fieldname => $value) {
            $insertValues[':'.$fieldname] = $value;
        }

        $query .= 'VALUES ('.implode(', ', array_keys($insertValues)). ')';

        $insertId = $this->driver->insert($query, $insertValues);

        return $insertId;
    }
}