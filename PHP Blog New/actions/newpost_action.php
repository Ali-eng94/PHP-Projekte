<?php

require '../connection.php';
session_start();

require '../components/not_logged_in.php';

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

/* -------- GET DATA -------- */
$subject = htmlspecialchars(
    trim($_POST["subject"] ?? '')
);

$content = htmlspecialchars(
    trim($_POST["content"] ?? '')
);

$_SESSION['subject'] = $subject;
$_SESSION['content'] = $content;

/* -------- CHECK EMPTY FIELDS -------- */
if(
    empty($subject)
    ||
    empty($content)
){
    header("Location: ../newpost.php?err=1");
    exit();
}

/* -------- INSERT POST -------- */
try {

    $sql = "INSERT INTO posts
            (subject, content, user_id)
            VALUES
            (:subject, :content, :user_id)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(
        ":subject",
        $subject
    );

    $stmt->bindParam(
        ":content",
        $content
    );

    $stmt->bindParam(
        ":user_id",
        $_SESSION['user_id']
    );

    $stmt->execute();

    header("Location: ../index.php");
    exit();

}
catch(PDOException $e){
    header("Location:../newpost.php?err=0");
    exit();
}