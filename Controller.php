<?php

class Controller
{
    function __construct()
    {
    }

    public function index()
    {

        $xml_file_paths = [];
        $dir = new DirectoryIterator(dirname(__FILE__) . '/librarybooks');
        $xml_file_paths = $this->iterate_through_folder($dir, $xml_file_paths);

        $books_array = [];
        foreach ($xml_file_paths as $xml_file_path) {
            $xml = simplexml_load_file($xml_file_path);
            $books_array[] = [
                'author' => (string)$xml->author[0],
                'book' => (string)$xml->name[0]
            ];
        }

        $author_array = array_map(function($val) {
            return $val['author'];
        }, $books_array);

        foreach ($author_array as $author) {
            $author_model = new AuthorModel();
            $author_model->author_name = $author;
            $author_model->save();
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
