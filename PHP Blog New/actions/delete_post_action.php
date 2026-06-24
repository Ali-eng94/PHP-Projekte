<?php

require '../connection.php';
session_start();

require '../components/not_logged_in.php';

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "GET"){
    die("Wrong Method");
}

/* -------- GET POST ID -------- */
$id = $_GET['id'] ?? '';

if(empty($id)){
    die("Invalid Post ID");
}

/* -------- GET POST OWNER -------- */
$sql = "
SELECT 
    u.id AS user_id
FROM posts p
INNER JOIN users u
ON u.id = p.user_id
WHERE p.id = :id
AND p.deleted_at IS NULL
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

/* -------- CHECK POST EXISTS -------- */
if(!$post){
    die("Post does not exist");
}

/* -------- CHECK OWNER -------- */
$isPostOwner =
isset($_SESSION['user_id'])
&&
$_SESSION['user_id']
==
$post['user_id'];

if(!$isPostOwner){
    die("Access Denied");
}

try {

    /* -------- DELETE POST -------- */
    $sql = "
    UPDATE posts
    SET deleted_at = NOW()
    WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(
        ":id",
        $id,
        PDO::PARAM_INT
    );

    $stmt->execute();

    /* -------- REDIRECT -------- */
    header("Location: ../index.php");
    exit();

}
catch(PDOException $e){

    die($e->getMessage());

}