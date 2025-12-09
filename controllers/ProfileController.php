<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Link.php';

class ProfileController {
    private $db;
    private $user;
    private $link;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->user = new User($this->db);
        $this->link = new Link($this->db);
    }

    public function show($username) {
        $userData = $this->user->getByUsername($username);
        
        if(!$userData) {
            echo '404 - User not found';
            return;
        }

        $links = $this->link->getByUserId($userData['id']);
        
        include __DIR__ . '/../views/profile.php';
    }
}
