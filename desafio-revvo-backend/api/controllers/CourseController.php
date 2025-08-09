<?php 
    require_once './models/Course.php';
    
    class CourseController {
        private $db;
    
        public function __construct($conn) {
            $this->db = $conn;
        }
    
        public function index() {
            $course = new Course($this->db);
            $stmt = $course->listAllCourses();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($courses);
        }
    
        public function show($id) {
            $course = new Course($this->db);
            $course->id = $id;
            $stmt = $course->getCourseById();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($data) {
                echo json_encode($data);
            } else {
                http_response_code(404);
                echo json_encode(["mensagem" => "Curso não encontrado."]);
            }
        }

        public function store() {
            $data = json_decode(file_get_contents("php://input"));
            if (!isset($data->title) || !isset($data->description)) {
                http_response_code(400);
                echo json_encode(["mensagem" => "Dados incompletos."]);
                return;
            }
    
            $course = new Course($this->db);
            $course->title = $data->title;
            $course->description = $data->description;
    
            if ($course->createCourse()) {
                http_response_code(201);
                echo json_encode(["mensagem" => "Curso criado com sucesso."]);
            } else {
                http_response_code(500);
                echo json_encode(["mensagem" => "Erro ao criar o curso."]);
            }
        }

        public function update($id) {
            $data = json_decode(file_get_contents("php://input"));
    
            if (!isset($data->title) || !isset($data->description)) {
                http_response_code(400);
                echo json_encode(["mensagem" => "Dados incompletos."]);
                return;
            }
    
            $course = new Course($this->db);
            $course->id = $id;
            $course->title = $data->title;
            $course->description = $data->description;
    
            if ($course->updateCourse()) {
                echo json_encode(["mensagem" => "Curso atualizado com sucesso."]);
            } else {
                http_response_code(500);
                echo json_encode(["mensagem" => "Erro ao atualizar o curso."]);
            }
        }

        public function destroy($id) {
            $course = new Course($this->db);
            $course->id = $id;
    
            if ($course->deleteCourse()) {
                echo json_encode(["mensagem" => "Curso deletado com sucesso."]);
            } else {
                http_response_code(500);
                echo json_encode(["mensagem" => "Erro ao deletar o curso."]);
            }
        }
    }    
?>