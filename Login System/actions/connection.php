<?php

    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "course";

    try {
        // $conn=new mysqli(host,dbanaem,user,pass);
        $pdo = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $exception) {
        echo "Connection failed: " . $exception->getMessage();
        die();
    }
    