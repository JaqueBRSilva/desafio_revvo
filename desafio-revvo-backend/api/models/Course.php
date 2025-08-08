<?php
    class Course {
        private $conn;
        private $table = "courses";

        public $id;
        public $title;
        public $description;
        public $creation_date;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function listAllCourses() {
            $query = "SELECT * FROM " . $this->table . " ORDER BY creation_date DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function createCourse() {
            $query = "INSERT INTO " . $this->table . " (title, description) VALUES (:title, :description)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            return $stmt->execute();
        }

        public function getCourseById() {
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }

        public function updateCourse() {
            $query = "UPDATE " . $this->table . " 
                      SET title = :title, description = :description 
                      WHERE id = :id";
            $stmt = $this->conn->prepare($query);
    
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    
        public function deleteCourse() {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
    
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>