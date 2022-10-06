<?php
/**
 * DB Connection interface
 * this interface was made if ever a developer want's to add other DB engine
 * 
 * @author Radiant C. Juan
 */
interface DBConnectionInterface {
    function __construct($hostname, $dbname, $user, $password);
    public function db_connect();
}