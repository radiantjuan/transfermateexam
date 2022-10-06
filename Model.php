<?php

class Model
{
    protected $db_connection;

    function __construct()
    {
        $postgres_connect = new PostgresDBConnect('localhost', 'librarydb', 'postgres', 'akosiegang1!');
        $this->db_connection = $postgres_connect->db_connect();
    }
}
