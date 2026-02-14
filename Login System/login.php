<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="actions/login_action.php" method="POST">
        <input type="email" required name="email">
        <input type="password" required name="password">
        <input type="submit" value="Login">
    </form>
    <?php
        if(isset($_GET['err'])){
            if($_GET['err'] == 1){
                echo "<p style='color:red'>Wrong Password</p>";
            }else if ($_GET['err'] == 2){
                echo "<p style='color:red'>Wrong Email</p>";
            }
            
        }
    ?>
</body>
</html>