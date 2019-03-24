<?php

namespace App\Models;

class User extends AbstractModel
{
    protected $table = 'users';

    protected $id;
    protected $name;
    protected $email;
    protected $password;

    public function create(string $email, string $name, string $password)
    {
        return $this->db->insert([
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ], $this->getTableName());
    }

    /**
     * @param string $email
     * @return bool
     */
    public function isEmailExist(string $email)
    {
        $query = 'SELECT COUNT(*) as count FROM '.$this->getTableName(). ' WHERE email = :email LIMIT 1';
        return boolval($this->db->fetchOne($query, ['email' => $email])['count']);
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function isValidUser($email, $password)
    {
        $query = 'SELECT id FROM '.$this->getTableName(). ' WHERE email = :email AND PASSWORD = :password LIMIT 1';
        return $this->db->fetchOne($query, ['email' => $email, 'password' => $password])['id'] ?? null;
    }

}