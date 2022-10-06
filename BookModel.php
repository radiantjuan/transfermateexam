<?php

class BookModel extends Model
{
    public $author_name;

    public function save()
    {
        $dbconnection = $this->db_connection;
        $sql = $dbconnection->prepare('INSERT INTO authors (author_name)
        VALUES (:author_name)');
        $sql->bindValue('author_name', $this->author_name, PDO::PARAM_STR);
        $sql->execute();
    }
}
