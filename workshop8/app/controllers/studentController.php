<?php
require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $studentModel;
    private $blade;
    
    public function __construct($db, $blade) {
        $this->studentModel = new Student($db);
        $this->blade = $blade;
    }
    
    public function index() {
        $students = $this->studentModel->all();
        echo $this->blade->make('students.index', ['students' => $students])->render();
    }
    
    public function create() {
        echo $this->blade->make('students.create')->render();
    }
    
    public function store() {
        $this->studentModel->create($_POST['name'], $_POST['email'], $_POST['course']);
        header("Location: index.php?action=index");
        exit();
    }
    
    public function edit($id) {
        $student = $this->studentModel->find($id);
        echo $this->blade->make('students.edit', ['student' => $student])->render();
    }
    
    public function update($id) {
        $this->studentModel->update($id, $_POST['name'], $_POST['email'], $_POST['course']);
        header("Location: index.php?action=index");
        exit();
    }
    
    public function delete($id) {
        $this->studentModel->delete($id);
        header("Location: index.php?action=index");
        exit();
    }
}
?>