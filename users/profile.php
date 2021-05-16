
<?php
//include('config.php');
include('session.php');
$userDetails = $userClass->userDetails($session_userId);

//$pdo = pdo_connect_mysql();
// Get the 8 most recently orders dishes
$stmt = $pdo->prepare('SELECT p.id, name, p.desc, p.price, p.rrp, p.quantity, img, 
o.quantity as amount from products as p, ordersdetail as o where p.id = o.productid 
union select id, name, products.desc, price, rrp, quantity, img, 0 as amount from 
products where id not in (select productid from ordersdetail) order by amount desc limit 8');
$stmt->execute();
// get the 8 firstly added dishes
$fea = $pdo->prepare('SELECT * FROM products ORDER BY date_added LIMIT 8');
$fea->execute();
// get the newest dish added
$hot = $pdo->prepare('SELECT id from products order by date_added desc limit 1');
$hot->execute();

$total_products = $pdo->query('SELECT * FROM products')->rowCount();
$all_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$feature = $fea->fetchAll(PDO::FETCH_ASSOC);
$hotdeal = $hot->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food</title>
    <!-- File bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- For dropdown-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Google Fonts-->
    <link rel = "preconnect" href = "https://fonts/gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <!-- OWL Carousel-->
    <!--https://cdnjs.com/libraries/OwlCarousel2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <!--box icon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- aos-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!--style css-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel = "stylesheet" href = "../css/loader.css">
</head>
<body>
<!--Loader-->
<div class="loader"> 
    <div class="cssload-container">
      <div class="cssload-circle"></div>
      <div class="cssload-circle"></div>
    </div>
 </div>

<!-- top bar-->
<div class="topbar">
    <div class="container1">
        <div class = "content-top">
                <div class = "left">
                    <p>Foods and Restaurant, The Best in Town</p>
                </div>
                <div class = "right">
                    <p><i class = "bx bx-phone"></i>Order Online +84123456789</p>
                </div>
        </div>
    </div>
</div>

<!-- main navbar-->
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
                            <span class = "show-user"><?php echo "Hi, ".$userDetails->name; ?></span>
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
                    <span style = "font-size: 20px;"><?php echo "$num_in_cart"?></span>
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
<!-- end main nav-->
<!-- Recommend section-->
<div class = "food-section">
    <div class = "food-slide">
        <div class = "owl-carousel carousel-nav-center" id = "food-carousel">
            <!-- slide item-->
            <div class = "food-slide-item">
                <img src = "../images/freshfood.png">
                <div class = "overlay"></div>
                <div class = "food-slide-item-content">
                    <div class = "item-content-wrapper">
                        <div class = "item-content-title top-down">
                            Fresh Food
                        </div>
                        <div class = "food-infos top-down delay-2">
                            <div class = "food-info">
                                <span>Enjoy Delicious Food</span>
                            </div>
                            <div class = "food-info">
                                <i class = "bx bxs-star"></i>
                                <span>4.5</span>
                            </div>
                        </div>
                        <div class = "item-content-description top-down delay-4">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt obcaecati dolorum beatae ratione quo ad, maiores officiis reiciendis enim? Tempora dolor quibusdam sint quia soluta! Quas reprehenderit fuga esse ipsa?
                        </div>
                        <div class = "item-action top-down delay-6">
                            <a href = "#" class = "btn btn-hover">
                                <i class = "bx bx-food-menu"></i>
                                <span>Order Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide item-->
            <!-- slide item-->
            <div class = "food-slide-item">
                <img src = "../images/seafood2.jpg">
                <div class = "overlay"></div>
                <div class = "food-slide-item-content">
                    <div class = "item-content-wrapper">
                        <div class = "item-content-title top-down">
                            Seafood
                        </div>
                        <div class = "food-infos top-down delay-2">
                            <div class=  "food-info">
                                <span>Enjoy Delicious Food</span>
                            </div>
                            <div class = "food-info">
                                <i class = "bx bxs-star"></i>
                                <span>4.5</span>
                            </div>
                        </div>
                        <div class = "item-content-description top-down delay-4">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae a reiciendis alias eveniet aliquam saepe facere asperiores molestias debitis, eum ipsam iure nemo explicabo eligendi facilis, possimus velit fuga! Corrupti!
                        </div>
                        <div class = "item-action top-down delay-6">
                            <a href = "#" class = "btn btn-hover">
                                <i class = "bx bx-food-menu"></i>
                                <span>Order Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  end slide item-->
            <!--slide item-->
            <div class = "food-slide-item">
                <img src = "../images/bakery.jpg">
                <div class = "overlay"></div>
                <div class = "food-slide-item-content">
                    <div class = "item-content-wrapper">
                        <div class = "item-content-title top-down">
                            Bakery Items
                        </div>
                        <div class = "food-infos top-down delay-2">
                            <div class = "food-info">
                                <span>Enjoy Delicious Food</span>
                            </div>
                            <div class = "food-info">
                                <i class = "bx bxs-star"></i>
                                <span>4.5</span>
                            </div>
                        </div>
                        <div class = "item-content-description top-down delay-4">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum a repellat officiis ad facilis commodi, ipsa nihil natus, quod minus magni accusantium cumque quo maxime explicabo reprehenderit voluptates nostrum ea?
                        </div>
                        <div class = "item-action top-down delay-6">
                            <a href = "#" class = "btn btn-hover">
                                <i class = "bx bx-food-menu"></i>
                                <span>Order Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end slide item-->
        </div>
    </div>
    <!-- end food-slide-->
    <!-- top food slide-->
    <div class = "top-food-slide">
        <div class = "owl-carousel" id = "top-food-slide">
            <!-- food item-->
            <?php foreach($all_products as $f): ?>
            <div class = "food-item">
                <img src = "images/<?=$f['img']?>" alt = "<?=$f['name'] ?>">
                <div class = "food-item-content">
                    <div class = "food-item-title">
                        <?=$f['name'] ?>
                    </div>
                    <div class = "food-btns">
                        <div class = "btn btn-hover">
                            <i class='bx bx-cart'></i>
                            <span>Add to Cart</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- end food item-->
        </div>
    </div>
    <!-- end top food slide-->
</div>
<!-- end recommend section-->
<!-- Features Sections-->
<section class = "feature-wrap padding-half" id = "specialities">
    <div class = "container text-center">
        <div class = "row">
            <div class = "col-md-12 text-center">
                <h2 class = "heading">Our &nbsp;Specialities</h2>
                <hr class = "heading-space">
            </div>
        </div>
        <div class = "row">
            <!--<div class = "col-md-2"></div>-->
            <div class = "col-md-3 col-sm-6 feature text-center" >
                <a href = "#"><i class="bx bxs-dish bx-tada"></i></a>
                <a href = "#"><h3 style = "font-weight: bold; margin-top: 10px;">Dinner &amp; Dessert</h3></a>
                <p>Enjoy Delicious Food</p>
            </div>
            <div class = "col-md-3 col-sm-6 feature text-center">
                <a href = "#"><i class = "bx bxs-coffee-alt bx-tada"></i></a>
                <a href = "#"><h3 style = "font-weight: bold; margin-top: 10px;">Breakfast</h3></a>
                <p>Enjoy Delicious Food</p>
            </div>
            <div class = "col-md-3 col-sm-6 feature text-center">
                <a href = "#"><i class = "bx bx-dish bx-tada"></i></a>
                <a href = "#"><h3 style = "font-weight: bold; margin-top: 10px;">Ices Shake</h3></a>
                <p>Enjoy Delicious Food!</p>
            </div>
            <div class = "col-md-3 col-sm-6 feature text-center">
                <a href = "#"><i class = "fa fa-glass bx-tada"></i></a>
                <a href = "#"><h3 style = "font-weight: bold; margin-top: 10px;">Berverges</h3></a>
                <p>Enjoy Delicious Food!</p>
            </div>
            <!--<div class = "col-md-2"></div>-->
        </div>
    </div>
</section>
<!-- end Features SectionS-->
<!--Servies plus working hours-->
<section id = "services" class = "padding-bottom">
    <div class = "container-fluid">
    <div class = "container">
        <div class = "row">
            <!--<div class = "col-md-1"></div>-->
            <div class = "col-xl-8 col-lg-8 col-md-8">
                <h2 class = "heading">Features&nbsp; Food</h2>
                <hr class = "heading-space">
                <div class = "slider_wrap">
                    <div id = "service-slider" class = "owl-carousel">
                    <?php foreach($feature as $product): ?>
                        <div class = "item">
                            <div class = "item_inner">
                                <div class = "image">
                                <a href = "main_profile.php?page=product&id=<?=$product['id']?>"><img src = "../images/<?=$product['img'] ?>" alt = "<?=$product['name'] ?>">
                                
                                </div>
                                <a href = "main_profile.php?page=product&id=<?=$product['id']?>"><h3><?=$product['name']?></h3></a>
                                <p>Enjoy Delicious Food!</p>
                            </div>
                        </div>
                    <?php endforeach; ?>     
                    </div>
                </div>
            </div>
            
            <div class = "col-xl-4 col-lg-4 col-md-4">
                <h2 class = "heading">Our&nbsp; Menu</h2>
                <hr class = "heading-space">
                <div class="menu_widget">
                <ul>
                    <?php foreach($feature as $f): ?>
                    <li><?=$f['name']?><span>&dollar;<?= $f['price'] ?></span></li>
                    <?php endforeach; ?>
                </ul>
                <a href = "#"><h3>Orther Special Menu</h3></a>
                <p>Enjoy Delicious Food!</p>
                </div>
            </div>
            <!--<Div class = "col-md-1"></Div>-->
        </div>
    </div>
</div>
</section>
<!-- image wwith content -->
<section class = "info_section paralax">
    <div class = "container-fluid">
        <div class = "row">
            <div class = "col-md-2"></div>
            <div class = "col-md-8 text-center">
                <h2 class = "heading-space">HOT Deal of the Day</h2>
                <p class = "heading-space detail">Enjoy Delicious Food!</p>
                <a href = "main_profile.php?page=product&id=<?=$hotdeal[0]['id'] ?>" class = "btn-common-white page-scroll">Order Now</a>
            </div>
            <div class = "col-md-2"></div>
        </div>
    </div>
</section>
<!-- FOOD GALLERY-->
<section id = "gallery">
    <div class = "container pt-5 pb-5">
        <div class = "row">
            <div class = "col-md-12 text-center">
                <h2 class = "heading">Delicious Food</h2>
                <hr class = "heading-space">
                <div class = "work-filter" style = "display: none;">
                    <ul class = "text-center">
                        <li><a href = "javascript:;" data-filter = "all" class = "active filter">All Food</a></li>
                        <li><a href = "javascript:;" data-filter = ".starters" class = "filter">Starters</a></li>
                        <li><a href = "javascript:;" data-filter = ".drinks" class = "filter">Drinks & Beverges</a></li>
                        <li><a href = "javascript:;" data-filter = ".dinner" class = "filter">Dinner</a></li>
                        <li><a href = "javascript:;" data-filter = ".lunch" class = "filter">Breakfast & Lunch</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class = "row pt-3">
            <?php foreach ($all_products as $product): ?>
            <div class = "col-md-3 col-sm-6 col-12 text-center pb-3">
                <div class = "container">
                    <div class = "item-food">
                        <div class = "image">
                        <a href = "main_profile.php?page=product&id=<?=$product['id']?>"><img src="../images/<?=$product['img']?>" alt="<?=$product['name']?>">
                            </a>
                        </div>
                        <a href = "main_profile.php?page=product&id=<?=$product['id']?>"><h3><?=$product['name']?></h3></a>
                        <p>Enjoy Delicious Food!</p>
                    </div>
                    <span style = "font-size: 18px; color: rgb(165, 89, 89); padding-bottom: 5px; padding-bottom: 5px;">&dollar;<?=$product['price']?></span><br>
                    <!--<a href = "" class = "btn-common-white page-scroll">Add to Cart</a> -->
                </div>
            </div>
            <?php endforeach; ?>      
        </div>
    </div>
</section>
<!-- facts counter  -->
<section id="facts">
    <div class="container">
      <div class="row number-counters"> 
        <!-- first count item -->
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center fadeInDown" data-wow-duration="500ms" data-wow-delay="300ms">
          <div class="counters-item">
            <i class='bx bx-happy' ></i>
            <h2><strong data-to="4680">0</strong></h2>
            <p>Happy Customers</p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
          <div class="counters-item"> 
            <i class='bx bx-dish'></i>
            <h2><strong data-to="865">0</strong></h2>
            <p>Dishes Served</p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center fadeInDown" data-wow-duration="500ms" data-wow-delay="900ms">
          <div class="counters-item"> 
            <i class="fa fa-glass"></i>
            <h2><strong data-to="510">0</strong></h2>
            <p>Total Beverages</p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center fadeInDown" data-wow-duration="500ms" data-wow-delay="1200ms">
          <div class="counters-item"> 
            <i class='bx bxs-coffee-alt'></i>
            <h2><strong data-to="1350">0</strong></h2>
            <p>Cup of coffees</p>
          </div>
        </div>
      </div>  
    </div>
</section>
<!--Our chefs-->
<section id = "chefs">
    <div class = "container pb-5">
        <div class = "row pt-5 pb-5">
            <div class = "col-md-12 text-center">
                <h2 class = "heading">Our Kitchen Staff</h2>
                <hr class = "heading_space">
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-12">
                <div class = "chefs_wrap_slider">
                    <div class = "owl-carousel" id = "chef">
                        <div class = "item">
                            <div class = "chef_wrap">
                                <img src = "../images/doctor1.jpg">
                                <h3>Nguyen Van A</h3>
                                <small>Head Of Kitchen</small>
                                <p>Enjoy Delicious Food!</p>
                            </div>
                        </div>
                        <div class = "item">
                            <div class = "chef_wrap">
                                <img src = "../images/our-cheffs1.jpg">
                                <h3>Nguyen Hong Lan</h3>
                                <small>Food Supervisor</small>
                                <p>Enjoy Delicious Food!</p>
                            </div>
                        </div>
                        <div class = "item">
                            <div class = "chef_wrap">
                                <img src = "../images/our-cheffs3.jpg">
                                <h3>To Kim Anh</h3>
                                <small>Head Cook</small>
                                <p>Enjoy Delicous Food!</p>
                            </div>
                        </div>
                        <div class = "item">
                            <div class = "chef_wrap">
                                <img src = "../images/our-cheffs2.jpg">
                                <h3>Nguyen Van C</h3>
                                <small>Co-Head Cook</small>
                                <p>Enjoy Delicious Food</p>
                            </div>
                        </div>
                        <div class = "item">
                            <div class = "chef_wrap">
                                <img src = "../images/our-cheffs2.jpg">
                                <h3>Nguyen Van H</h3>
                                <small>Waiter</small>
                                <p>Enjoy Delicious Food</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Online-->
<section id = "order-form" class = "order_section">
    <div class = "container order_form pt-5 pb-5">
        <div class = "row">
            <div class = "col-md-12 appointment_form">
                <h2 class= "heading pt-5">Online booking</h2>
                <hr class = "heading_space">
                <div class = "row">
                    <div class = "col-md-8">
                        <form onSubmit = "return false" id = "order_form" class = "callus">
                            <div class = "row">
                                <div class = "form-group col-md-12">
                                    <div id = "result" class = "text-center"></div>
                                </div>
                            </div>
                            <Div class = "row pt-3">
                            <div class = "form-group col-md-12">
                                    <p>It is recommended to book 30 minutes before arrival !&nbsp;&nbsp;&nbsp;
                                    <span style = "color:red; font-size: 18px;">Sale 10%</span></p>
                                </div>
                            </Div>
                            <div class = "row">
                                <div class = "col-md-6">
                                    <div class = "form-group">
                                        <input type = "text" class = "form-control" placeholder = "Name" name = "name" id = "name" required>

                                    </div>
                                </div>
                                <div class = "col-md-6">
                                    <div class = "form-group">
                                        <input type = "text" class = "form-control" placeholder = "Email Address" name = "email" id = "email" required>

                                    </div>
                                </div>
                                <div class = "col-md-6">
                                    <div class = "form-group">
                                        <input type = "text" class = "form-control" placeholder = "Phone Number" name = "phone" id = "phone" required>
                                    </div>
                                </div>
                                <div class=  "col-md-6">
                                    <div class = "form-group">
                                        <input type = "number" class = "form-control" name = "quantity" placeholder = "Number of people">
                                    </div>
                                </div>
                                <div class = "col-md-6">
                                    <div class = "form-group">
                                        <input type = "date" class = "form-control"  name = "date" id = "date" required>

                                    </div>
                                </div>
                                <div class = "col-md-6">
                                    <div class = "form-group">
                                        <input type = "time" class = "form-control" name = "time" id = "time" required>

                                    </div>
                                </div>
                                <div class = "col-md-12">
                                    <div class = "form-group">
                                        <textarea placeholder = "Enter your notes here" id = "message" name = "message" required></textarea>
                                    </div>
                                    <div class = "form-group">
                                        <input class = "btn-submit" type = "submit" value = "Book now" id = "btn_order_submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <div class = "col-md-3"></div>
        </div>
        <div class = "col-md-3"></div>
    </div>
</section>
<!-- Footer -->
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
        <hr style = "color: white; width: 100%;">
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
<a href = "#" id="back-top"><i class="fa fa-angle-up fa-2x"></i></a>
<!--<img src = "./images/transformer-banner.jpg" alt = "">-->
<!-- jquery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- carousel-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<!-- App script-->
<script src="../js/jquery-countTo.js"></script>
<script src="../js/jquery.appear.js"></script> 
<script src = "../js/app.js"></script>

<!-- navbar fixed on scroll-->

<!-- end navbar fixed on scroll-->
<!-- data aos-->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        once: false,
        duration: 1000,
    });
    
</script>
</body>
</html>