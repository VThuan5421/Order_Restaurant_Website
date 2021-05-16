
<?php
// Get the 4 randomly products
$stmt = $pdo ->prepare('SELECT * FROM products order by RAND() LIMIT 4');
$stmt->execute();
$four_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
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
    <!-- Google Fonts-->
    <link rel = "preconnect" href = "https://fonts/gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <!--box icon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--style css-->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* for product */
        .product h1 {
            font-size: 34px;
            font-weight: normal;
            margin: 0;
            padding: 20px 0 10px 0;
        }
        .product .price {
            display: block;
            font-size: 22px;
            color: rgb(165, 89, 89);
        }
        .product .rrp {
            color: #BBBBBB;
            text-decoration: line-through;
            font-size: 22px;
            padding-left: 5px;
        }
        .product form {
            margin: 40px 0;
        }
        .product form input[type = "number"] {
            width: 300px;
            height: 30px;
            margin: 10px 0;
            font-size: 20px;
        }
        .product form input[type = "submit"] {
            background: #e25111;
            border: 0;
            color: white;
            width: 300px;
            padding: 12px 0;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }
        .product form input[type = "submit"]:hover {
            background: #434f61;
            transition: 0.3s ease;
        }
    </style>
</head>
<body>
<!-- main navbar-->
<div class = "nav-wrapper" id = "navbar_top">
    <div class = "container1">
        <div class = "nav">
            <a href = "home.php" class = "logo">
                <i class='bx bxs-medal bx-tada' ></i>Perf<span class = "main-color">e</span>ct
            </a>
            <div class = "responsive">
                <ul class = "nav-menu" id = "nav-menu">
                    <li><a href = "home.php">Home</a></li>
                    <li><a href = "home.php?page=products#gallery">Our Food</a></li>
                    <li><a href = "#">About Us</a></li>
                    <!--<li><a href = "#">FAQ</a></li>-->
                    <li><a href = "#">FAQ</a></li>
                    <li>
                        <a href = "users/main_profile.php?page=login" class = "btn btn-hover">
                            <span>Sign in</span>
                        </a>
                    </li>
                </ul>
                <!-- shopping cart-->
                <!---->
                <a href = "home.php?page=cart" class = "cart"><i class='bx bx-shopping-bag'></i>
                <sup><span style = "font-size: 20px;">
                    <?php echo "$num_in_cart"?>
                </span></sup>
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
<div class="product content-wrapper">
    <div class = "container  pt-5 pb-5">
        <div class = "card-header">
        <div class = "row pt-5 pb-5">
            <div class = "col-xl-1 col-lg-1 col-md-1 col-sm-1  col-xs-12 col-12">
            </div>
            <div class = "col-xl-5 col-lg-5 col-md-5 col-sm-5  col-xs-12 col-12 text-center pt-5 pb-5">
                <img src="images/<?=$product['img']?>" alt="<?=$product['name']?>" width = "400px" height = "400px">
            </div>
            <div class = "col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-12 col-12 pt-5">
                <h1 class="name"><?=$product['name']?></h1>
                <span style = "color: #e25111"><i class = "bx bxs-star"></i>&nbsp;<i class = "bx bxs-star"></i>&nbsp;<i class = "bx bxs-star"></i>&nbsp;<i class = "bx bxs-star"></i>&nbsp;<i class = "bx bxs-star-half"></i></span>
                <span class="price">
                    &dollar;<?=$product['price']?>
                    <?php if ($product['rrp'] > 0): ?>
                    <span class="rrp">&dollar;<?=$product['rrp']?></span>
                    <?php endif; ?>
                </span>
                <form action="home.php?page=cart" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <input type="submit" value="Add To Cart">
                </form>
                <div class="description">
                    <?=$product['desc']?>
                </div>
            </div>
            <div class = "col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-12 col-12">
            </div>
        </div>
        <!-- Recommend section for product detail -->
        <section id = "gallery">
        <div class = "container"> 
        <div class = "row pb-5">
            <div class = "col text-center">
                <h2 class = "heading">Recommend</h2>
                <hr class = "heading-space">
            </div>
        </div>
        <div class = "row pt-5 pb-5">
            <?php foreach ($four_products as $product): ?>
            <div class = "col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 text-center">
                <div class = "container">
                <div class = "item-food">
                        <div class = "image">
                            <a href = "home.php?page=product&id=<?=$product['id']?>">
                                <img src="images/<?=$product['img']?>" alt="<?=$product['name']?>" width = "200" height = "200">
                            </a>
                        </div>
                        <a href = "home.php?page=product&id=<?=$product['id']?>"><h3><?=$product['name']?></h3></a>
                        <p>Enjoy Delicious Food!</p>
                    </div>
                    <span style = "font-size:18px; color: rgb(165, 89, 89);">&dollar;<?=$product['price'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>  
        </div>
            </div>
        </section>
            </div>
    </div>
</div>
<!-- Footer -->
<div class = "footer bg-dark">
    <div class = "container bg-dark pt-5">
        <div class = "row">
            <div class = "col-xl-4 col-lg-3 col-md-6 col-sm-12 text-white">
                <div class = "content">
                    <a href = "#" class = "logo">
                        <i class = "bx bxs-medal bx-tada main-color"></i>
                        Perf<span class = "main-color">e</span>ct
                    </a>
                    <p>Lorem ipsum dolor sit, amet
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
                                <li><a href = "#"><img src = "./images/google-play.png"></a></li>
                                <li><a href = "#"><img src = "./images/app-store.png"></a></li>
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
<!-- jquery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src = "js/app.js"></script>
</body>
</html>