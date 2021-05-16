<?php
//include("config.php");
include("userclass.php");
$userClass = new UserClass();

$errorMsgReg = '';

if(!empty($_POST['signupSubmit'])) {
    $username = $_POST['usernameReg'];
    $email = $_POST['emailReg'];
    $name = $_POST['nameReg'];
    $password = $_POST['passwordReg'];
    if(strlen(trim($username)) && strlen(trim($email)) && strlen(trim($name)) && strlen(trim($password)) > 0) {
        $id = $userClass->userRegistration($username, $password, $email, $name);
        if ($id) {
            header("Location: main_profile.php?page=login");       
        }
        else {
            $errorMsgReg = "Username or email already exists!";
            
        }
    } else {
        $errorMsgReg = "Please check again information!";
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
    <div class = "container form bg-white pt-5 mt-4 mb-3" style = "height:188vh;">
        <!--change it-->
        <p class = "text-center login-heading">Register</p>
        <form method = "post" action = "" name = "signup">
            <div class = "row">
                <div class = "col mt-4 pl-5 pr-5">
                    <p class = "username">Username</p>
                    <div class = "row mt-4">
                        <div class = "col-2 text-center pt-1 pr-0">
                            <i class = "fa fa-user-o" id = "user"></i>
                        </div>
                        <div class = "col-10 pl-0">
                            <input type = "text" name = "usernameReg" placeholder = "Type your username" class = "user_name">
                        </div>
                    </div>
                    <hr class = "hr-1" style = "border-color: 1px solid rgb(194, 187, 187);">
                    <div class = "username-hide"></div>
                </div>
            </div>
            <div class = "row">
                <div class = "col mt-4 pl-5 pr-5">
                    <p class = "username">Name</p>
                    <div class = "row mt-4">
                        <div class = "col-2 text-center pt-1 pr-0">
                            <i class = "fa fa-user-o" id = "user"></i>
                        </div>
                        <div class = "col-10 pl-0">
                            <input type = "text" name = "nameReg" placeholder = "Type your name" class = "name">

                        </div>
                    </div>
                    <hr class = "hr-1">
                    <div class = "name-hide"></div>
                </div>
            </div>
            <div class = "row">
                <div class = "col mt-4 pl-5 pr-5">
                    <p class = "username">Email address</p>
                    <div class = "row mt-4">
                        <div class = "col-2 text-center pt-1 pr-0">
                            <i class = "fa fa-envelope-o" id = "user"></i>
                        </div>
                        <div class= "col-10 pl-0">
                            <input type = "text" name = "emailReg" placeholder = "Type your email address" class = "email">
                        </div>
                    </div>
                    <hr class = "hr-1">
                    <div class = "email-hide"></div>
                </div>
            </div>
            <div class = "row">
                <div class = "col mt-4 pl-5 pr-5">
                    <p class = "username">Password</p>
                    <div class = "row mt-4">
                        <div class = "col-2 text-center pt-1 pr-0">
                            <i class = "fa fa-lock" id = "lock"></i>
                        </div>
                        <div class = "col-10 pl-0">
                            <input type = "password" name = "passwordReg" placeholder = "Type your password" class = "password-signup">
                        </div>
                    </div>
                    <hr class = "hr-1">
                    <div class = "password-signup-hide"></div>
                </div>
            </div>
            <div class = "row">
                <div class = "col mt-4 pl-5 pr-5">
                    <p class = "username">Confirm password</p>
                    <div class = "row mt-4">
                        <div class = "col-2 text-center pt-1 pr-0">
                            <i class = "fa fa-lock" id = "lock"></i>
                        </div>
                        <div claass = "col-10 pl-0">
                            <input type = "password" name = "repassReg" placeholder = "Type your password" class = "confirm-password-signup">
                        </div>
                    </div>
                    <hr class = "hr-1">
                    <div class = "confirm-password-signup-hide"></div>
                    <div class = "errorMsg" style = "color: red;"><?php echo $errorMsgReg; ?></div>
                </div>
            </div>
            <div class = "row">
                <div class = "col pl-5">
                    <a href = "#"><span class = "forget-password">I accept the <span 
                    style = "text-transform:capitalize; color:blue;">&nbsp;terms of use</span>
                    &nbsp;&&nbsp;<span style = "text-transform:capitalize;color:blue">&nbsp;privacy</span>
                </a>
                </div>
            </div>
            <Div class = "row mt-4">
                <div class = "col pl-5 pr-5">
                    <input type = "submit" class = "btn btn-block text-white signup-button" name = "signupSubmit" value = "Register">
                </div>
            </Div>
        </form>
        <div class = "row mt-5">
            <div class = "col text-center">
                <span style = "text-transform: capitalize;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148, 141, 141);">or sign up using</span>

            </div>
        </div>
        <div class = "row mt-5">
            <div class = "col text-center">
                <span class = "fb-icon"><i class = "fa fa-facebook"></i></span>
                <span class = "tt-icon"><i class = "fa fa-twitter"></i></span>
                <span class = "gg-icon"><i class = "fa fa-google"></i></span>
            </div>
        </div>
        <div class = "row mt-5">
            <div class = "col text-center">
                <span style = "text-transform:capitalize;font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148,141,141);">already have an account</span>
            </div>
            <div class = "col-12 text-center pt-3">
                <a href = "main_profile.php?page=login"><span class = "login-page">LOGIN</span></a>
            </div>
        </div>
    </div>
</div>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src = "../js/login.js"></script>
</body>
</html>