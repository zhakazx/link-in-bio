<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Link.php';

class DashboardController {
    private $db;
    private $user;
    private $link;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->user = new User($this->db);
        $this->link = new Link($this->db);
    }

    private function checkAuth() {
        if(!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
            redirect('/login');
        }

        // Auto login from cookie
        if(!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
            $userData = $this->user->getById($_COOKIE['user_id']);
            if($userData) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['name'] = $userData['name'];
            }
        }
    }

    public function index() {
        $this->checkAuth();
        
        $userData = $this->user->getById($_SESSION['user_id']);
        $links = $this->link->getByUserId($_SESSION['user_id']);
        
        include __DIR__ . '/../views/dashboard.php';
    }

    public function editProfile() {
        $this->checkAuth();
        
        $userData = $this->user->getById($_SESSION['user_id']);
        
        include __DIR__ . '/../views/edit-profile.php';
    }

    public function updateProfile() {
        $this->checkAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $bio = $_POST['bio'] ?? '';

            // Handle avatar upload
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['avatar']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if(!in_array($ext, $allowed)) {
                    $_SESSION['error'] = 'Invalid file type';
                    redirect('/edit-profile');
                }

                if($_FILES['avatar']['size'] > 2000000) { // 2MB limit
                    $_SESSION['error'] = 'File too large (max 2MB)';
                    redirect('/edit-profile');
                }

                $newFilename = uniqid() . '.' . $ext;
                $uploadPath = __DIR__ . '/../public/uploads/' . $newFilename;

                // Create uploads directory if not exists
                if(!is_dir(__DIR__ . '/../public/uploads')) {
                    mkdir(__DIR__ . '/../public/uploads', 0777, true);
                }

                if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadPath)) {
                    $this->user->updateAvatar($_SESSION['user_id'], 'uploads/' . $newFilename);
                }
            }

            if($this->user->updateProfile($_SESSION['user_id'], $name, $bio)) {
                $_SESSION['success'] = 'Profile updated successfully';
                $_SESSION['name'] = $name;
            } else {
                $_SESSION['error'] = 'Failed to update profile';
            }

            redirect('/edit-profile');
        }
    }

    public function account() {
        $this->checkAuth();
        
        $userData = $this->user->getById($_SESSION['user_id']);
        
        include __DIR__ . '/../views/account.php';
    }

    public function changePassword() {
        $this->checkAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';

            if(empty($currentPassword) || empty($newPassword)) {
                $_SESSION['error'] = 'All fields are required';
                redirect('/account');
            }

            if($this->user->changePassword($_SESSION['user_id'], $currentPassword, $newPassword)) {
                $_SESSION['success'] = 'Password changed successfully';
            } else {
                $_SESSION['error'] = 'Current password is incorrect';
            }

            redirect('/account');
        }
    }

    public function deleteAccount() {
        $this->checkAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($this->user->delete($_SESSION['user_id'])) {
                session_destroy();
                setcookie('user_id', '', time() - 3600, '/');
                redirect('/login');
            } else {
                $_SESSION['error'] = 'Failed to delete account';
                redirect('/account');
            }
        }
    }
}
