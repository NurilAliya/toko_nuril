<?php
require_once 'app/core/Security.php';

class Controller {
    protected function view($path, $data = []) {
        // Generate CSRF token for forms
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = Security::generateCSRFToken();
        }
        $data['csrf_token'] = $_SESSION['csrf_token'];
        
        extract($data);
        require "app/views/layouts/header.php";
        require "app/views/{$path}.php";
        require "app/views/layouts/footer.php";
    }
    protected function redirect($url){
        header('Location: '.$url);
        exit;
    }
}
?>