<?php
/**
 * Base model class
 * 
 * @author Radiant C. Juan
 */

class Model
{
    protected $db_connection;

    function __construct()
    {
        $postgres_connect = new PostgresDBConnect('localhost', 'transfermate', 'postgres', 'akosiegang1!');
        $this->db_connection = $postgres_connect->db_connect();
    }
}
