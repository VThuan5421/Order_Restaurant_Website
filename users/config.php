<?php
session_start();
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'order1';
    
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}

$num_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; // use for index
$year = date('Y'); // use for index

function template_navbar($userDetails) {
    $num_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    echo <<<EOT
    <div class = "nav-wrapper" id = "navbar_top">
        <div class = "container1">
            <div class = "nav">
                <a href = "main_profile.php" class = "logo">
                    <i class='bx bxs-medal bx-tada' ></i>Perf<span class = "main-color">e</span>ct
                </a>
                <div class = "responsive">
                    <ul class = "nav-menu" id = "nav-menu">
                        <li><a href = "main_profile.php">Home</a></li>
                        <li><a href = "main_profile.php?page=products">Our Food</a></li>
                        <li><a href = "#">About Us</a></li>
                        <!--<li><a href = "#">FAQ</a></li>-->
                        <li><a href = "#">FAQ</a></li>
                        <li>
                            <a href = "#" class = "dropdown-toggle profile" data-toggle = "dropdown">
                                <span class = "show-user">Hi, $userDetails->name</span>
                            </a>
                            <ul class = "dropdown-menu pr-4 text-center" style = "border-radius: 10px; margin-left:-4%;">
                                <li></li>
                                <li class = "profile1 pt-2 pb-2"><a href = "#" style = "color: black; font-size: 12px;">My cart</a></li>
                                <li class = "profile1 pt-2 pb-2"><a href = "#" style = "color: black; font-size: 12px;">Order History</a></li>
                                <li class = "profile1 pt-2 pb-2"><a href = "#" style = "color: black; font-size: 12px;">Change Password</a></li>
                                <li class = "profile1 pt-2 pb-2"><a href = "./logout.php" style = "color: black; font-size: 12px;">Logout</a></li>
                            </ul>

                        </li>
                    </ul>
                    <!-- shopping cart-->
                    <!---->
                    <a href = "main_profile.php?page=cart" class = "cart">
                        <i class='bx bx-shopping-bag'></i>
                        <span style = "font-size: 20px;">$num_in_cart</span>
                    </a>
                    <!---->
                
                    <!-- MObile MENU TOGGLE-->
                    <div class = "hamburger-menu" id = "hamburger-menu">
                        <div class="hamburger">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
EOT;
}

function template_footer() {
    $year = date('Y');
    echo <<<EOT
    <div class = "footer bg-dark">
        <div class = "container bg-dark pt-5">
            <div class = "row">
                <div class = "col-xl-4 col-lg-3 col-md-6 col-sm-12 text-white">
                    <div class = "content">
                        <a href = "#" class = "logo" data-aos = "slide-right">
                            <i class = "bx bxs-medal bx-tada main-color"></i>
                            Perf<span class = "main-color">e</span>ct
                        </a>
                        <p data-aos = "slide-right">Lorem ipsum dolor sit, amet
                            consectetur adipisicing elit. Modi illo nulla soluta,
                            rerum corrupti magnam quibusdam aliquid nihil
                            in eligendi ratione iusto deserunt, doloremque
                            maxime animi. Perferendis at iure libero!</p>
                        
                    </div>
                </div>
                <div class = "col-xl-8 col-lg-9 col-md-6 col-sm-12 pl-0 text-white">
                    <div class = "row">
                        <div class = "col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class = "content">
                                <p><b>Perfect</b></p>
                                <ul class = "footer-menu">
                                    <li><a href = "#">About Us</a></li>
                                    <li><a href = "#">My profile</a></li>
                                    <li><a href = "#">Pricing plans</a></li>
                                    <li><a href = "#">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class = "col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class = "content">
                                <p><b>Browse</b></p>
                                <ul class = "footer-menu">
                                    <li><a href = "#">About Us</a></li>
                                    <li><a href = "#">My profile</a></li>
                                    <li><a href = "#">Pricing plans</a></li>
                                    <li><a href = "#">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class = "col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class = "content">
                                <p><b>Browse</b></p>
                                <ul class = "footer-menu">
                                    <li><a href = "#">About Us</a></li>
                                    <li><a href = "#">My profile</a></li>
                                    <li><a href = "#">Pricing plans</a></li>
                                    <li><a href = "#">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class = "col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class = "content">
                                <p><b>Download App</b></p>
                                <ul class = "footer-menu">
                                    <li><a href = "#"><img src = "../images/google-play.png"></a></li>
                                    <li><a href = "#"><img src = "../images/app-store.png"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style = "color: white; width: 100%; border-color: #b2b2b2;">
            <div class = "row copyright">
                <div class = "col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 text-white pt-3 pb-3">
                    <p><a href = "#" style = "color: white; font-size: 18px;">© <?php echo "$year" ?> Copyright:</a>
                        <span style = "font-weight: 600"><a href = "#" style = "color: palegreen">Hehe</a></span>
                        &nbsp;All Reserved
                    </p>
                </div>
                <div class = "col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 icon-head text-white pt-3 pb-3">
                    <a href = "#"><span class = "social-item"><i class = "fa fa-facebook"></i></span></a>
                    <a href = "#"><span class = "social-item"><i class = "fa fa-twitter"></i></span></a>
                    <a href = "#"><span class = "social-item"><i class = "fa fa-google"></i></span></a>
                    <a href = "#"><span class = "social-item"><i class = "fa fa-instagram"></i></span></a>
                </div>
            </div>
        </div>
    </div>
EOT;
}
?>