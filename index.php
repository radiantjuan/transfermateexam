<?php
spl_autoload_register(function ($class_name) {
    require $class_name . '.php';
});

require __DIR__ . '/views/layouts/header.php';
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/':
        require __DIR__ . '/views/index.php';
        break;
    case '/import-data':
        require __DIR__ . '/views/import.php';
        break;
    default:
        http_response_code(404);
        echo "Can't find your page meow!";
        break;
}
require __DIR__ . '/views/layouts/footer.php';
