<?php 
    require_once './config/Database.php';
    require_once './controllers/CourseController.php';
    
    $database = new Database();
    $db = $database->connect();
    $controller = new CourseController($db);
    
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', trim($uri, '/'));
    
    if ($uri[0] === 'courses') {
        if ($method === 'GET') {
            $controller->index();
        } elseif ($method === 'POST') {
            $controller->store();
        } else {
            http_response_code(405);
            echo json_encode(["mensagem" => "Método não permitido"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["mensagem" => "Rota não encontrada"]);
    }    
?>