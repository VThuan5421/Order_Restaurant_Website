<?php
if (!empty($_SESSION['userId'])) {
    $session_userId = $_SESSION['userId'];
    include('userclass.php');
    $userClass = new UserClass();
}

if (empty($session_userId)) {
    $url = 'main_profile.php?page=login';
    header("Location: $url");
}
?>