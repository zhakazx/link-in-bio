<?php

define('BASE_PATH', '/link-in-bio');

function asset($path) {
    return BASE_PATH . '/public/assets/' . ltrim($path, '/') . '?v=1.2';
}

function url($path = '') {
    if ($path === '' || $path === '/') {
        return BASE_PATH . '/';
    }
    return BASE_PATH . '/' . ltrim($path, '/');
}

function redirect($path) {
    header('Location: ' . url($path));
    exit;
}
