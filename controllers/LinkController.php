<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Link.php';

class LinkController {
    private $db;
    private $link;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->link = new Link($this->db);
    }

    private function checkAuth() {
        if(!isset($_SESSION['user_id'])) {
            redirect('/login');
        }
    }

    public function create() {
        $this->checkAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $url = $_POST['url'] ?? '';

            if(empty($title) || empty($url)) {
                $_SESSION['error'] = 'All fields are required';
                redirect('/dashboard');
            }

            if(!filter_var($url, FILTER_VALIDATE_URL)) {
                $_SESSION['error'] = 'Invalid URL format';
                redirect('/dashboard');
            }

            $this->link->user_id = $_SESSION['user_id'];
            $this->link->title = $title;
            $this->link->url = $url;

            if($this->link->create()) {
                $_SESSION['success'] = 'Link added successfully';
            } else {
                $_SESSION['error'] = 'Failed to add link';
            }

            redirect('/dashboard');
        }
    }

    public function update() {
        $this->checkAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $title = $_POST['title'] ?? '';
            $url = $_POST['url'] ?? '';

            if(empty($id) || empty($title) || empty($url)) {
                $_SESSION['error'] = 'All fields are required';
                redirect('/dashboard');
            }

            if(!filter_var($url, FILTER_VALIDATE_URL)) {
                $_SESSION['error'] = 'Invalid URL format';
                redirect('/dashboard');
            }

            if($this->link->update($id, $title, $url)) {
                $_SESSION['success'] = 'Link updated successfully';
            } else {
                $_SESSION['error'] = 'Failed to update link';
            }

            redirect('/dashboard');
        }
    }

    public function delete() {
        $this->checkAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';

            if(empty($id)) {
                $_SESSION['error'] = 'Invalid link ID';
                redirect('/dashboard');
            }

            if($this->link->delete($id)) {
                $_SESSION['success'] = 'Link deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete link';
            }

            redirect('/dashboard');
        }
    }
}
