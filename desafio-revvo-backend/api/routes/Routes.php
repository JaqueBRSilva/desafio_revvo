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
    
        $id = $uri[1] ?? null;

        switch ($method) {
            case 'GET':
                if ($id) {
                    $controller->show($id);
                } else {
                    $controller->index();
                }
                break;

            case 'POST':
                $controller->store();
                break;

            case 'PUT':
                if ($id) {
                    $controller->update($id);
                } else {
                    http_response_code(400);
                    echo json_encode(["mensagem" => "ID não informado."]);
                }
                break;

            case 'DELETE':
                if ($id) {
                    $controller->destroy($id);
                } else {
                    http_response_code(400);
                    echo json_encode(["mensagem" => "ID não informado."]);
                }
                break;

            default:
                http_response_code(405);
                echo json_encode(["mensagem" => "Método não permitido"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["mensagem" => "Rota não encontrada"]);
    }    
?>