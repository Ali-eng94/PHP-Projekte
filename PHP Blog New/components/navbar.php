<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container">

        <!-- Navbar Header -->
        <div class="navbar-header">

            <button
                type="button"
                class="navbar-toggle"
                data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">

                <span class="sr-only">
                    Toggle navigation
                </span>

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="index.php">
                Ali Haji Blog
            </a>

        </div>

        <!-- Navbar Links -->
        <div
            class="collapse navbar-collapse"
            id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="about.php">
                        About
                    </a>
                </li>

                <?php

                if(
                    isset($_SESSION['loggedIn'])
                    &&
                    $_SESSION['loggedIn'] == true
                ){

                    echo '
                    <li>
                        <a href="author.php">'
                        .
                        htmlspecialchars(
                            $_SESSION["username"]
                        )
                        .
                        '</a>
                    </li>

                    <li>
                        <a href="newpost.php">
                            New Post
                        </a>
                    </li>

                    <li>
                        <a href="logout.php">
                            Logout
                        </a>
                    </li>
                    ';

                } else {

                    echo '
                    <li>
                        <a href="login.php">
                            Login
                        </a>
                    </li>

                    <li>
                        <a href="signup.php">
                            Sign up
                        </a>
                    </li>
                    ';
                }

                ?>

            </ul>

        </div>

    </div>

</nav>