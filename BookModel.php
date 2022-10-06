<?php

/**
 * Books model class for books table
 * 
 * @author Radiant C. Juan
 */
class BookModel extends Model
{
    /**
     * @var string book name
     */
    public $book_name;

    /**
     * @var string author ID from author table
     */
    public $author_id;

    /**
     * Save books model
     * 
     * @return void
     */
    public function save()
    {
        $dbconnection = $this->db_connection;
        $sql = $dbconnection->prepare('INSERT INTO books (book_name, author_id) VALUES (:book_name, :author_id)');
        $sql->bindValue('book_name', $this->book_name, PDO::PARAM_STR);
        $sql->bindValue('author_id', $this->author_id, PDO::PARAM_INT);
        $sql->execute();
    }
}
