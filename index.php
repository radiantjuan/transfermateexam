<?php
spl_autoload_register(function ($class_name) {
    require $class_name . '.php';
});

require __DIR__ . '/views/layouts/header.php';
$request = $_SERVER['REQUEST_URI'];
$controller = new Controller();
switch ($request) {
    case '/':
        $controller->index();
        break;
    case '/import-data':
        $controller->import_xml_data_to_db();
        break;
    default:
        http_response_code(404);
        echo "Can't find your page meow!";
        break;
}
require __DIR__ . '/views/layouts/footer.php';
