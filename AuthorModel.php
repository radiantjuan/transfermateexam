<?php

/**
 * Author model class for author table
 * 
 * @author Radiant C. Juan
 */
class AuthorModel extends Model
{
    /**
     * @var string Author name
     */
    public $author_name;

    /**
     * Save authors to authors table in DB
     * 
     * @return int
     */
    public function save()
    {
        $sql = $this->db_connection->prepare('INSERT INTO authors (author_name)
        VALUES (:author_name)');
        $sql->bindValue('author_name', $this->author_name, PDO::PARAM_STR);
        $result = $sql->execute();

        //return id for saving of books for author_id column
        if ($result) {
            return $this->get_author_id_by_name();
        }
    }

    /**
     * Fetchi author id by name for importation of books for author_id column
     * 
     * @return int
     */
    public function get_author_id_by_name()
    {
        $sql = $this->db_connection->prepare('SELECT author_id FROM authors WHERE author_name = :author_name');
        $sql->bindValue('author_name', $this->author_name, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch();
        return $result['author_id'];
    }

    /**
     * Fetching all authors with books table joined
     * 
     * @return array
     */
    public function get_all_authors_with_books()
    {
        $sql = "SELECT author_name, book_name 
        FROM authors
        INNER JOIN books ON books.author_id = authors.author_id;";
        $sqlQuery = $this->db_connection->prepare($sql);
        $sqlQuery->execute();
        $result = $sqlQuery->fetchAll();
        return $result;
    }

    /**
     * Fetch author by name
     * 
     * @return array
     */
    public function get_author_by_name()
    {
        $query = "SELECT author_name, book_name 
        FROM authors
        INNER JOIN books ON books.author_id = authors.author_id
        WHERE author_name LIKE :author_name";
        $sql = $this->db_connection->prepare($query);
        $sql->bindValue('author_name', '%' . $this->author_name . '%', PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll();
    }
}
