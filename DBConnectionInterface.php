<?php
interface DBConnectionInterface {
    function __construct($hostname, $dbname, $user, $password);
    public function db_connect();
}