<?php

class AuthorModel extends Model
{
    public $author_name;

    public function save()
    {
        $sql = $this->db_connection->prepare('INSERT INTO authors (author_name)
        VALUES (:author_name)');
        $sql->bindValue('author_name', $this->author_name, PDO::PARAM_STR);
        $result = $sql->execute();

        // /return id
        if ($result) {
            return $this->get_author_id_by_name();
        }
    }

    public function get_author_id_by_name()
    {
        $sql = $this->db_connection->prepare('SELECT author_id FROM authors WHERE author_name = :author_name');
        $sql->bindValue('author_name', $this->author_name, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch();
        return $result['author_id'];
    }
}
