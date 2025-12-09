<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->user = new User($this->db);
    }

    public function showRegister() {
        include __DIR__ . '/../views/register.php';
    }
    public function showLogin() {
        include __DIR__ . '/../views/login.php';
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validation
            if(empty($name) || empty($username) || empty($email) || empty($password)) {
                $_SESSION['error'] = 'All fields are required';
                redirect('/register');
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Invalid email format';
                redirect('/register');
            }

            if($this->user->emailExists($email)) {
                $_SESSION['error'] = 'Email already exists';
                redirect('/register');
            }

            if($this->user->usernameExists($username)) {
                $_SESSION['error'] = 'Username already exists';
                redirect('/register');
            }

            // Create user
            $this->user->name = $name;
            $this->user->username = $username;
            $this->user->email = $email;
            $this->user->password = $password;

            if($this->user->create()) {
                $_SESSION['success'] = 'Registration successful! Please login.';
                redirect('/login');
            } else {
                $_SESSION['error'] = 'Registration failed';
                redirect('/register');
            }
        }
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if(empty($email) || empty($password)) {
                $_SESSION['error'] = 'All fields are required';
                redirect('/login');
            }

            $user = $this->user->login($email, $password);

            if($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                
                // Set cookie if remember me is checked
                if(isset($_POST['remember'])) {
                    setcookie('user_id', $user['id'], time() + (86400 * 1), '/'); // 1 day
                }

                redirect('/dashboard');
            } else {
                $_SESSION['error'] = 'Invalid email or password';
                redirect('/login');
            }
        }
    }

    public function logout() {
        session_destroy();
        setcookie('user_id', '', time() - 3600, '/');
        redirect('/login');
    }
}
