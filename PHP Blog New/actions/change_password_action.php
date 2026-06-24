<?php

session_start();

require '../connection.php';
require '../components/not_logged_in.php';

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

$oldpass = trim($_POST['oldpass'] ?? '');
$newpass = trim($_POST['newpass'] ?? '');

if(
    empty($oldpass)
    ||
    empty($newpass)
){
    header(
        "Location: ../change_password.php?err=1"
    );
    exit();
}
$id = $_SESSION['user_id'];

/* -------- GET USER PASSWORD -------- */
$sql = "
SELECT password
FROM users
WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(
    ":id",
    $id
);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

/* -------- CHECK OLD PASSWORD -------- */
if(
    !password_verify(
        $oldpass,
        $user['password']
    )
){
    header(
        "Location: ../change_password.php?err=2"
    );
    exit();
}

/* -------- PASSWORD LENGTH -------- */
if(strlen($newpass) < 8){

    header(
        "Location: ../change_password.php?err=4"
    );
    exit();
}

/* -------- HASH PASSWORD -------- */
$hashed_password = password_hash(
    $newpass,
    PASSWORD_BCRYPT
);

/* -------- UPDATE PASSWORD -------- */
try {

    $sql = "
    UPDATE users
    SET password = :pass
    WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(
        ":pass",
        $hashed_password
    );

    $stmt->bindParam(
        ":id",
        $id
    );

    $stmt->execute();

    header(
        "Location: ../index.php"
    );
    exit();

}
catch(PDOException $e){

    die($e->getMessage());
}