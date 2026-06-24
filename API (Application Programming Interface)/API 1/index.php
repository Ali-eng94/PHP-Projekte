<?php

require 'connection.php';

$sql = "SELECT * FROM course";

$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>

    <table border="1">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>

        <?php foreach($users as $user): ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($user['name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($user['email']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($user['Phone']); ?>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>