<?php
session_start();
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST["post_id"];
    $parent_id = !empty($_POST["parent_id"]) ? $_POST["parent_id"] : null;
    $name = htmlspecialchars(trim($_POST["name"]));
    $comment = htmlspecialchars(trim($_POST["comment"]));
    $user_id = $_SESSION["userId"];

    $sql = "INSERT INTO comments (user_id, post_id, parent_id, name, comment) VALUES (:u, :po, :pi, :n, :c)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":u", $user_id);
    $stmt->bindParam(":po", $post_id);
    $stmt->bindParam(":pi", $parent_id);
    $stmt->bindParam(":n", $name);
    $stmt->bindParam(":c", $comment);
    $stmt->execute();

    $_SESSION["success"] = "Comment added successfully";
    header("Location: ../post.php?id=$post_id");
    exit;
}
?>
