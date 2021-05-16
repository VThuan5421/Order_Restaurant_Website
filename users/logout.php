<?php
include('config.php');
$session_userId = '';
$_SESSION['userId'] = '';
if(empty($session_userId) && empty($_SESSION['userId'])) {
    session_destroy();
    header("Location: ../home.php");
}

