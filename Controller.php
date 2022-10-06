<?php

class Controller
{
    function __construct()
    {
    }

    public function import_xml_data_to_db()
    {

        $xml_file_paths = [];
        $dir = new DirectoryIterator(dirname(__FILE__) . '/librarybooks');
        $xml_file_paths = $this->iterate_through_folder($dir, $xml_file_paths);

        $books_array = [];
        foreach ($xml_file_paths as $xml_file_path) {
            $xml = simplexml_load_file($xml_file_path);
            $books_array[(string)$xml->author[0]][] = (string)$xml->name[0];
        }

        foreach ($books_array as $author => $books) {
            $author_model = new AuthorModel();
            $author_model->author_name = $author;
            $author_id = $author_model->save();
            foreach ($books as $book) {
                $book_model = new BookModel();
                $book_model->book_name = $book;
                $book_model->author_id = $author_id;
                $book_model->save();
            }
        }
    }

    private function iterate_through_folder($dir, $xml_file_paths)
    {
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if ($fileinfo->isDir()) {
                    $subdir = new DirectoryIterator($fileinfo->getPathname());
                    $xml_file_paths = $this->iterate_through_folder($subdir, $xml_file_paths);
                } else if ($fileinfo->getExtension() === 'xml') {
                    $xml_file_paths[] = $fileinfo->getPathname();
                }
            }
        }
        return $xml_file_paths;
    }
}
