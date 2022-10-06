<?php
/**
 * Controlle class for index and import page
 * 
 * @author Radiant C. Juan
 */
class Controller
{
    /**
     * Index page fetching all table in the database
     * 
     * @return void
     */
    public function index() {
        $author = new AuthorModel();

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $author->author_name = $_POST['author_name'];
            $result_data = $author->get_author_by_name();
        } else {
            $result_data = $author->get_all_authors_with_books();
        }
        require __DIR__ . '/views/index.php';
    }

    /**
     * Import xml data to DB getting all the xml records in the library books
     * 
     * @return void;
     */
    public function import_xml_data_to_db()
    {
        //include view
        include(__DIR__ . '/views/import.php');
        try {
            //fetch all xml files from all folders
            $xml_file_paths = [];
            $dir = new DirectoryIterator(dirname(__FILE__) . '/librarybooks');
            $xml_file_paths = $this->iterate_through_folder($dir, $xml_file_paths);

            //load xml file to array
            $books_array = [];
            foreach ($xml_file_paths as $xml_file_path) {
                $xml = simplexml_load_file($xml_file_path);
                $books_array[(string)$xml->author[0]][] = (string)$xml->name[0];
            }

            //save xml values to DB
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
        } catch (\Exception $err) {
            echo "something went wrong";
            die;
        }
    }

    /**
     * Function for iteration for libraryfolder for fetching xml files records
     * 
     * @return array
     */
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
