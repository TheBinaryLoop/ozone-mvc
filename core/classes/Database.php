<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 21.02.2018
 * Time: 10:25
 */

namespace core\classes;

class Database
{
    protected $dbh;
    protected $stmt;

    function __construct($host, $username, $password, $database)
    {
        $this->dbh = new \PDO("mysql:host=" . $host . ";dbname=" . $database . ';charset=utf8', $username, $password);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function query($query, $params = array())
    {
        $this->stmt = $this->dbh->prepare($query);
        $result = $this->stmt->execute($params);

        if (explode(' ',$query)[0] == 'SELECT') {
            $data = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $data;
        }
        return $result;
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

}