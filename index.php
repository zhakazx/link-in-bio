<?php
require_once __DIR__ . '/config/config.php';
session_start();

$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?');
if (strpos($request, BASE_PATH) === 0) {
    $request = substr($request, strlen(BASE_PATH));
}

if (empty($request) || $request === '') {
    $request = '/';
}

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/LinkController.php';
require_once __DIR__ . '/controllers/ProfileController.php';

$authController = new AuthController();
$dashboardController = new DashboardController();
$linkController = new LinkController();
$profileController = new ProfileController();

// Router
switch($request) {
    // Auth routes
    case '/':
    case '/login':
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $authController->showLogin();
        } else {
            $authController->login();
        }
        break;

    case '/register':
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $authController->showRegister();
        } else {
            $authController->register();
        }
        break;

    case '/logout':
        $authController->logout();
        break;

    // Dashboard routes
    case '/dashboard':
        $dashboardController->index();
        break;

    case '/edit-profile':
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $dashboardController->editProfile();
        } else {
            $dashboardController->updateProfile();
        }
        break;

    case '/account':
        $dashboardController->account();
        break;

    case '/change-password':
        $dashboardController->changePassword();
        break;

    case '/delete-account':
        $dashboardController->deleteAccount();
        break;

    // Link routes
    case '/link/create':
        $linkController->create();
        break;

    case '/link/update':
        $linkController->update();
        break;

    case '/link/delete':
        $linkController->delete();
        break;

    // Public profile routes
    default:
        if(preg_match('/^\/u\/([a-zA-Z0-9_-]+)$/', $request, $matches)) {
            $profileController->show($matches[1]);
        } else {
            header('Location: /login');
        }
        break;
}
