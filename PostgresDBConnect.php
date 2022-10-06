<?php

class PostgresDBConnect implements DBConnectionInterface
{

    protected $hostname;
    protected $dbname;
    protected $username;
    protected $password;

    function __construct($hostname, $dbname, $user, $password)
    {
        $this->hostname = $hostname;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    function db_connect()
    {
        return new PDO('pgsql:host=' . $this->hostname . ';dbname=' . $this->dbname, $this->user, $this->password);
    }
}
