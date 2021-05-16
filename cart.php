<?php
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: home.php?page=cart');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: home.php?page=cart');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: home.php?page=checkout');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfect</title>
    <!-- bootsrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- drop down-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Google Fonts-->
    <link rel = "preconnect" href = "https://fonts/gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <!--box icon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel = "stylesheet" href = "./css/cart.css">
</head>
<body>
<!-- TOP bar-->
<!--
<div class = "topbar">
    <div class = "container1">
        <div class = "content-top">
            <div class = "left">Food & Restaurant, The Best In Town</div>
            <div class = "right"><i class = "bx bx-phone"></i>Order Online, +84-123-456-789</div>
        </div>
    </div>
</div>
-->
<!-- navbar-->
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
                <!-- MObile MENU TOGGLE-->
                <div class = "hamburger-menu" id = "hamburger-menu">
                    <div class="hamburger">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart -->
<div class = "container-fluid pl-5 pr-5 mt-5">
    <div class = "row pt-5">
        <div class = "col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
            <div class = "card">
                <Div class = "card-header">
                        <div class = "row pt-3 pb-3">
                            <div class = "col-md-12">
                                <span style = "font-size: 20px; font-weight: 700; color: black;">ORDER DETAILS(<?php echo "$num_in_cart"?>)</span>
                            </div>
                            <!--
                            <div class = "col-xl-6 col-6">
                                <i class = "fa fa-map-marker"></i>
                                &nbsp;Deliver to &nbsp;
                                <input type = "text" placeholder = "Name, Phone, Adress">
                            </div>
                            -->
                        </div>
                    </div>
                <form action="home.php?page=cart" method="post">
                <Div class = "card-body">
                    <div class = "container">
                    <?php if (empty($products)): ?>
                    <div class = "row">
                        <div class = "col text-center">
                        <p style = "font-size: 20px; font-weight: bold;">You have no food added in your order Cart</p>
                    </div></div>
                    <?php else: ?>
                    <?php foreach ($products as $product): ?>
                    <div class = "row pb-3">
                        <div class = "col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 pt-5 text-center">
                        <img src="images/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
                            <div class = "text-left">
                                <div class = "quantity text-center pt-2">
                                    <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xl-8 col-lg-8 col-md-6 col-sm-6 col-12 pt-5">
                            <p>Item Name:&nbsp;<a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a></p>
                            <p class="price">Price:&nbsp;&dollar;<?=$product['price']?></p>
                            <p class="price">Amount:&nbsp;<?=$products_in_cart[$product['id']]?></p>
                            <p class="price">Total:&nbsp;&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></p>
                            <p><a href="home.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <div class = "row">
                        <div class = "col-12 text-right">
                            <p><input type="submit" value="Update" name="update"></p>
                        </div>
                        
                    </div>
                    </div>
                </Div>
                </form>
            </div>
        </div>
        <div class = "col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 pt-4 pb-5">
            <div class = "container">
                <div class = "row">
                    <div class = "col-md-12">
                        <div class = "card">
                            <Div class = "card-header" style = " font-weight: 700; color: black;">PRICE DETAILS</Div>
                            <div class = "card-body">
                                <Div class = "row">
                                    <div class = "col text-left">
                                        Price(<?php echo "$num_in_cart"?>) :
                                    </div>
                                    <div class = "col text-right">
                                        <p class="price">&dollar;<?=$subtotal?></p>
                                    </div>
                                </Div>
                                <div class = "row pt-3">
                                    <div class = "col-7 text-left">
                                        Delivery Charges :
                                    </div>
                                    <div class = "col text-right">
                                        Free
                                    </div>
                                </div>
                                <hr>
                                <div class = "row">
                                    <div class = "col text-left">
                                        Total Amount: 
                                    </div>
                                    <div class = "col text-right">
                                        <p class="price">&dollar;<?=$subtotal?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "row pt-3">
                    <div class = "col-md-12">
                        <Div class = "card">
                            <div class = "card-header" style = " font-weight: 700; color: black;">Buyer / Consignee</div>
                            <div class = "card-body">
                                <form id = "placeOrder" action = "home.php?page=checkout" method = "post">
                                    <div class = "form-group">
                                        <label for = "txtName">Name</label><br>
                                        <input type = "text" id = "txtName" name = "name" 
                                        placeholder = "Recipient's name" class = "form-control"
                                        style = "width: 100%; height: 40px;">
                                        <div class = "hide-4 ml-3"></div>
                                    </div>
                                    <div class = "form-group">
                                        <label for = "txtPhone">Phone number</label><br>
                                        <input type = "text" id = "txtPhone" name = "phone" class = "form-control"
                                        placeholder = "Phone number (10 digit-mobile-number)"
                                        style = "width: 100%; height: 40px;">
                                        <div class = "hide-5 ml-3"></div>
                                    </div>
                                    <div class = "form-group">
                                        <label for = "txtAddess">Delivery address</label><br>
                                        <input type = "radio" name = "deli" value = "citydefault" checked>
                                        Ho Chi Minh City
                                        <input type = "text" id = "txtAddress" name = "address" class = "form-control"
                                        placeholder = "Address (Area and Street, City/District/Town)"
                                        style = "width: 100%; height: 40px; margin-top: 5px;">
                                        <div class = "hide-6 ml-3"></div>
                                    </div>
                                    <div class = "form-group">
                                        <label for = "txtNote">Note</label><br>
                                        <textarea rows = "2" id = "txtNote" name = "note" class = "form-control"
                                        style = "width: 100%; height: 70px;"></textarea>
                                        <div class = "hide-7 ml-3"></div>
                                    </div>
                                    <div class = "form-group">
                                        <label for = "pmode">Payment Option</label>
                                        <div class = "row">
                                            <div class = "col pl-4" id = "cash-hidder">
                                                <p><input type = "radio" name = "payment-method" value = "Cod">&nbsp;&nbsp;&nbsp;Cash on Delivery</p>
                                            </div>
                                        </div>
                                        <div class = "row"><!-- row1 -->
                                            <Div class = "col pl-4 pb-3" id = "momo-hidder">
                                                <input type = "radio" name = "payment-method" data-toggle = "collapse" data-target = "#momo">&nbsp;&nbsp;&nbsp;
                                                <img src = "./images/momo.png" style = "height:30px;">&nbsp;Momo
                                            </Div>
                                        </div>
                                        <div id = "momo" class = "collapse">
                                                <div class = "row pt-2">
                                                    <div class = "col text-center">
                                                        <p>You'll be redirected to Momo page, where you can pay using credit card or wallet</p>
                                                    </div>
                                                </div>
                                                <div class = "row pl-5">
                                                    <div class = "col">
                                                        <p><button style = "text-transform:uppercase; padding:1.5% 7%;background-color:#e25111;border-color:transparent" data-toggle = "collapse" data-target = "#payment-option">continue</button></p>  
                                                    </div>
                                                </div>
                                        </div>
                                        <div class = "row"> <!-- 2 -->
                                            <div class = "col pl-4" id = "credit-hidder">
                                                    <p><input type = "radio" name = "payment-method" data-toggle = "collapse" data-target = "#credit">&nbsp;&nbsp;&nbsp;Credit/Debit/ATM Card</p>
                                            </div>
                                        </div>
                                        <div class = "collapse" id = "credit">
                                                <div class = "row">
                                                    <div class = "col-12 pl-5">
                                                        <p><input type = "text" placeholder = "Enter Card Number" class = "pt-2 pb-2 pl-4 card-number"></p>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-xl-5 col-lg-5 col-md-4 col-sm-6 col-12 pl-5">
                                                        <p><input type = "date" placeholder = "DD/MM/YYYY" class = "pt-2 pb-2 date" style = "border-radius: 5px; width: 100%"></p>
                                                    </div>
                                                    <div class = "col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 pl-5">
                                                            <p><input type = "text" placeholder = "CVV" class = "pt-2 pb-2 cvv" style = "width: 50%;"></p>
                                                    </div>
                                                    <div class = "col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 pt-1 pl-5">
                                                            <p><button style = "border-radius: 5px; padding:1.5% 10%;background-color: #e25111;color:white;border-color:transparent;"
                                                            data-toggle = "collapse" data-target = "#payment-option">PAY &dollar;<?=$subtotal ?></button></p>
                                                    </div>
                                                    
                                                </div>
                                        </div>
                                        <div class = "row">
                                            <div class = "col pl-4" id = "net-banking-hidder">
                                                <p><input type = "radio" name = "payment-method" data-target = "#net-banking" data-toggle = "collapse">&nbsp;&nbsp;&nbsp;Net Banking</p>
                                            </div>
                                        </div>
                                        <div class = "collapse" id = "net-banking">
                                                    <div class = "row pl-4 pr-4">
                                                        <div class = "col-12 pb-2">
                                                            POPULAR BANKS
                                                        </div>
                                                        <Div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                                            <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                                            <img src = "./images/vcb.jpg" style = "height:20px;">&nbsp;&nbsp;&nbsp;Vietcombank
                                                        </Div>
                                                        <div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                                            <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                                            <img src = "./images/agb.png" style = "height:20px;">&nbsp;&nbsp;&nbsp;Agribank
                                                        </div> 
                                                        <div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                                            <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                                            <img src = "./images/vpb.png" style = "height:20px;">&nbsp;&nbsp;&nbsp;VP Bank
                                                        </div>
                                                        <div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                                            <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                                            <img src = "./images/scb.png" style = "height:20px;">&nbsp;&nbsp;&nbsp;Sacombank
                                                        </div>
                                                        <div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                                            <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                                            <img src = "./images/tpb.jpg" style = "height:20px;">&nbsp;&nbsp;&nbsp;TP Bank
                                                        </div>
                                                        <div class = "col-xl-3 col-lg-4 col-md-6 pt-3">
                                                            <span style = "visibility: hidden;">Hello User</span>
                                                        </div>
                                                    </div>
                                                    <div class = "row pt-3 pl-4">
                                                        <div class = "col-12">
                                                            <span>Other Bank</span>
                                                        </div>
                                                        <div class = "col-12 pt-3">
                                                            <input type = "text" placeholder = "Bank Name" style = "width:50%;" class = "pt-1 pb-1 pl-4">
                                                        </div>
                                                        <div class = "col-12 pt-4">
                                                            <p><button style = "text-transform:uppercase;padding:1.5% 7%;background-color:grey; color:white; border-color:transparent; font-weight: 600;" 
                                                            data-toggle = "collapse" data-target = "#payment-option">PAY &dollar;<?=$subtotal?></button></p>
                                                        </div>
                                                    </div>                           
                                        </div>
                                            
                                    </div>
                                    <div class = "col-12 text-center">
                                        <p><input type = "submit" class = "place-button" style = "text-transform: uppercase; width: 100%; background-color: #e25111; color :white; border-color: transparent; border-radius: 5px;" 
                                        value = "Place order"></input></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </Div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
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
            <div class = "col-xl-8 col-lg-9 col-md-6 col-sm-12 text-white">
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
        <hr style = "color: white; width: 100%; border-color: #b2b2b2;">
        <div class = "row copyright">
            <div class = "col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 text-white pt-2 pb-2">
                <p><a href = "#" style = "color: white; font-size: 18px;">© <?php echo "$year" ?> Copyright:</a>
                    <span style = "font-weight: 600"><a href = "#" style = "color: palegreen">Hehe</a></span>
                    &nbsp;All Reserved
                </p>
            </div>
            <div class = "col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 icon-head text-white pt-2 pb-2">
                <a href = "#"><span class = "social-item"><i class = "fa fa-facebook"></i></span></a>
                <a href = "#"><span class = "social-item"><i class = "fa fa-twitter"></i></span></a>
                <a href = "#"><span class = "social-item"><i class = "fa fa-google"></i></span></a>
                <a href = "#"><span class = "social-item"><i class = "fa fa-instagram"></i></span></a>
            </div>
        </div>
    </div>
</div>
<!-- jquery-->
<!--
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!--app script-->
<script src = "./js/login.js"></script>
<script>
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar_top");
    var sticky = navbar.offsetTop;
    function myFunction() {
        if(window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    };
    $(document).ready(() => {
        $('#hamburger-menu').click(() => {
            $('#hamburger-menu').toggleClass('active');
            $('#nav-menu').toggleClass('active');
        })
    });
</script>
</body>
</html>