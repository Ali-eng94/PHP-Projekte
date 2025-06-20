<?php
// Database connection
require "connection.php";
// Example post_id (retrieve dynamically in real scenarios)
$post_id = $_GET["id"];

// Fetch parent comments (parent_id = NULL) for the specific post
$parentCommentsQuery = $pdo->prepare("SELECT * FROM comments WHERE post_id = :post_id AND parent_id IS NULL ORDER BY created_at DESC");
$parentCommentsQuery->execute([':post_id' => $post_id]);
$parentComments = $parentCommentsQuery->fetchAll(PDO::FETCH_ASSOC);

// Function to fetch replies
function fetchReplies($pdo, $parentId) {
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE parent_id = :parent_id ORDER BY created_at ASC");
    $stmt->execute([':parent_id' => $parentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>Post - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">

</head>
<body>
  <div class="container">
    <!-- Blog Content -->
    <h1>Blog Post Title</h1>

    <!-- Leave a Comment Form -->
    <div>
      <h2>Leave a Comment:</h2>
      <form action="actions/comment.php" method="POST">
        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
        <input type="hidden" name="parent_id" value="">
        <input type="text" name="name" placeholder="Your Name" required><br><br>
        <textarea name="comment" rows="4" placeholder="Your Comment" required></textarea><br><br>
        <button type="submit">Submit</button>
      </form>
    </div>

    <!-- Display Comments -->
    <h2>Comments:</h2>
    <?php foreach ($parentComments as $comment): ?>
      <div>
        <h4><?= htmlspecialchars($comment['name']) ?></h4>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <small><?= $comment['created_at'] ?></small>
        <a href="#reply-form-<?= $comment['id'] ?>">Reply</a>
        
        <!-- Reply Form -->
        <div id="reply-form-<?= $comment['id'] ?>" style="margin-left: 20px;">
        <form action="actions/comment.php" method="POST">
        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
            <input type="hidden" name="parent_id" value="<?= $comment['id']; ?>">
            <input type="text" name="name" placeholder="Your Name" required><br><br>
            <textarea name="comment" rows="2" placeholder="Your Reply" required></textarea><br><br>
            <button type="submit">Reply</button>
          </form>
        </div>

        <!-- Display Replies -->
        <?php $replies = fetchReplies($pdo, $comment['id']); ?>
        <?php foreach ($replies as $reply): ?>
          <div style="margin-left: 40px;">
            <h5><?= htmlspecialchars($reply['name']) ?></h5>
            <p><?= nl2br(htmlspecialchars($reply['comment'])) ?></p>
            <small><?= $reply['created_at'] ?></small>
          </div>
        <?php endforeach; ?>
      </div>
      <hr>
    <?php endforeach; ?>
  </div>
</body>
</html>
