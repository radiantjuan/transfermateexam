<?php

class BookModel extends Model
{
    public $book_name;
    public $author_id;
    public function save()
    {
        $dbconnection = $this->db_connection;
        $sql = $dbconnection->prepare('INSERT INTO books (book_name, author_id) VALUES (:book_name, :author_id)');
        $sql->bindValue('book_name', $this->book_name, PDO::PARAM_STR);
        $sql->bindValue('author_id', $this->author_id, PDO::PARAM_INT);
        $sql->execute();
    }
}
