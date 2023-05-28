<?php

    session_start();

    //Database parameters for PDO handle
    CONST DB_TYPE = "mysql";
    CONST DB_HOST = "localhost";
    CONST DB_PORT = "3306";
    CONST DB_NAME = "mydatabase";
    CONST DB_USER = "root";
    CONST DB_PASS = "root";

    //Database handle
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //redirects to other pages
    function redirectTo(string $path): never {
        header("{$_SERVER['SERVER_PROTOCOL']} 302 Found", true, 302);
        header("Location: {$path}");
        exit();
    }

