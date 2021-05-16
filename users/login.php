<?php
//include("config.php");
include("userclass.php");
$userClass = new UserClass();

$errorMsgLogin = '';
if(!empty($_POST['loginSubmit'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];
    if(strlen(trim($username)) > 1 && strlen(trim($password)) > 1) {
        $id = $userClass->userLogin($username, $password);
        if($id) {
            header("Location: main_profile.php");
        } else {
            $errorMsgLogin = "Login Fail! Please check the email and password!";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- File bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts-->
    <link rel = "preconnect" href = "https://fonts/gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <!--box icon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href = "../css/login.css" rel = "stylesheet">
</head>
<body>
<div class = "container">
    <div class = "container form bg-white pt-5 mt-4 mb-3">
        <!-- Change after click on sign up-->
        <p class = "text-center login-heading">login</p>
        <div class = "container">
            <form method = "post" action = "" name = "login">
                <div class = "row">
                    <div class = "col mt-4 pl-5 pr-5">
                        <p class = "username">username</p>
                        <div class = "row mt-4">
                            <div class = "col-2 text-center pt-1 pr-0">
                                <i class = "fa fa-user-o" id = "user"></i>
                            </div>
                            <div class = "col-10 pl-0">
                                <input type = "text" name = "email" placeholder = "Type your email" class = "input-1">
                            </div>
                        </div>
                        <hr class = "hr-1">
                        <div class = "hide"></div>  
                    </div>
                </div>
                <div class = "row">
                    <div class= "col mt-4 pl-5 pr-5">
                        <p class = "username">Password</p>
                        <div class = "row mt-4">
                            <div class = "col-2 text-center pt-1 pr-0">
                                <i class = "fa fa-lock" id = "lock"></i>
                            </div>
                            <div class = "col-10 pl-0">
                                <input type = "password" name = "password" placeholder = "Type your password" class = "input-2">
                            </div>
                        </div>
                        <hr class = "hr-1">
                        <div class = "hide-1"></div>
                        <div class = "errorMsg" style = "color:red;"><?php echo $errorMsgLogin; ?></div>
                    </div>
                </div>
                <Div class = "row">
                    <div class = "col text-right pr-5">
                        <a href = "#"><span class = "forget-password">Forget Password?</span></a>
                    </div>
                </Div>
                <div class = "row mt-4">
                    <div class = "col pl-5 pr-5">
                        <input type = "submit" class = "btn btn-block text-white login-button" name = "loginSubmit" value = "Login">
                    </div>
                </div>
            </form>
            <div class = "row mt-5">
                <div class = "col text-center">
                    <span style = "text-transform: capitalize;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148, 141, 141)">or sign up using</span>
                </div>
            </div>
            <div class = "row mt-5">
                <div class = "col text-center">
                    <span class = "fb-icon"><i class = "fa fa-facebook"></i></span>
                    <span class = "tt-icon"><i class = "fa fa-twitter"></i></span>
                    <span class = "gg-icon"><i class = "fa fa-google"></i></span>
                </div>
            </div>
            <div class = "col-12 text-center pt-3">
                <a href = "main_profile.php?page=register"><span class = "sign-up">Register</span></a>
            </div>
        </div>
        <div class = "row mt-5 show-me">
            <div class = "col text-center">
                <span style = "text-transform: capitalize;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148, 141, 141);">or sign up using</span>

            </div>
        </div>
        <div class = "row mt-5 show-me">
            <div class = "col text-center">
                <span class = "fb-icon"><i class = "fa fa-facebook"></i></span>
                <span class = "tt-icon"><i class = "fa fa-twitter"></i></span>
                <span class = "gg-icon"><i class = "fa fa-google"></i></span>
            </div>
        </div>
    </div>
</div>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src = "../js/login.js"></script>
</body>
</html>