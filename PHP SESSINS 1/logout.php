<?php
session_start();
session_destroy();// Destory the session
header("Location: index.php");