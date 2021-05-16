<?php
include('session.php');
$userDetails = $userClass->userDetails($session_userId);
// The amounts of products to show on each page
$num_products_on_each_page = 8;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Food</title>
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
    <!--style css-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/loader.css">
</head>
<body>
<div class="loader"> 
    <div class="cssload-container">
      <div class="cssload-circle"></div>
      <div class="cssload-circle"></div>
    </div>
</div>

<?=template_navbar($userDetails)?>

<!--Page header & Title-->
<section id="page_header">
    <div class="page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">Our Food</h2>
                    <p>Check out our menu and some of our special, featured recipies!</p>
                </div>
            </div>
        </div>
    </div>  
</section>
<!--Wel come -->
<section id = "welcome">
    <div class = "container pt-5">
        <div class = "row">
            <div class = "col-md-12">
                <h2 class = "heading">Welcome to Hehe</h2>
                <hr class = "heading_space">
            </div>
            <div class = "col-md-7 col-sm-6 pt-5">
                <p class = "half_space">Lorem, ipsum dolor sit amet consectetur adipisicing elit. In dolore, dignissimos deleniti, hic libero labore magni saepe quia voluptatibus neque corrupti fugit quod. Odit voluptatum vero placeat, pariatur totam optio!</p>
                <p class = "half_space"></p>
                <p class = "half_space">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint suscipit, placeat temporibus incidunt quibusdam quisquam provident asperiores neque perferendis sunt excepturi debitis expedita, eligendi culpa.</p>
                <ul class = "welcome_list">
                    <li>Business Events</li>
                    <li>Birthday</li>
                    <li>Cardiovascular Diseases</li>
                    <li>Weddings</li>
                    <li>Party & Others</li>
                </ul>
            </div>
            <div class = "col-md-5 col-sm-6">
                <img class = "img-responsive" src = "../images/welcome.jpg">
            </div>
        </div>
    </div>
</section>
<!-- all food -->
<section id = "gallery">
    <div class = "container pt-5 pb-5">
        <div class = "row">
            <div class = "col-md-12 text-center">
                <h2 class = "heading">Delicious Food</h2>
                <hr class = "heading-space">
                <div class = "work-filter">
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
            <?php foreach ($products as $product): ?>
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
                    <form action="main_profile.php?page=cart" method="post">
                        <input type="hidden" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" required>
                        <input type="hidden" name="product_id" value="<?=$product['id']?>">
                        <input type="submit" value="Add To Cart" class = "btn-common-white page-scroll">
                    </form>
                    <!--<a href = "" class = "btn-common-white page-scroll">Add to Cart</a>-->
                </div>
            </div>
            <?php endforeach; ?>      
        </div>
        <div class = "row pt-3">
            <div class = "col-md-12 text-center">
                <div class="buttons">
                    <?php if ($current_page > 1): ?>
                    <a href="main_profile.php?page=products&p=<?=$current_page-1?>#gallery">Prev</a>
                    <?php endif; ?>
                    <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
                    <a href="main_profile.php?page=products&p=<?=$current_page+1?>#gallery">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?=template_footer()?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- carousel-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<!-- App script-->
<script src = "../js/app.js"></script>
</body>
</html>