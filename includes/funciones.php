<?php
define('IMAGES_DIR', $_SERVER['DOCUMENT_ROOT'] . '/images/');

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Protect Reservations Pages
function isAuth() : void{
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin() : void{
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

function validateORredirect(string $url){
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: $url");
    }

    return $id;
}
