
<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST["name"], $_POST["phone"], $_POST["address"], $_POST["note"], $_POST["payment-method"]) 
&& isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { 
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $products = array();
    $string = "";
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

    
    $date = date('Y-m-d H:i:s'); 
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $note = $_POST["note"];
    $pmode = $_POST["payment-method"];
    $data = "";

    try {
        $insert_stmt = $pdo->prepare("INSERT INTO orders(name_order, datecreation, 
        name, phone, address, note, payment_mode) values ('New Order', 
        '$date', :name, :phone, :address, :note, :pmode)");
        $insert_stmt->bindParam(":name", $name);
        $insert_stmt->bindParam(":phone", $phone);
        $insert_stmt->bindParam(":address", $address);
        $insert_stmt->bindParam(":note", $note);
        $insert_stmt->bindParam(":pmode", $pmode);
        $insert_stmt->execute();
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
    $orderid = $pdo->lastInsertId();

    foreach($products as $product) {
        try {
            $insert_stmt = $pdo->prepare("INSERT INTO ordersdetail(productid, orderid, price, quantity, total) 
            values (:productid, :orderid, :price, :quantity, :total)");
            $total = $product['price'] * $products_in_cart[$product['id']];
            $string .= $product['name'] . ", ";
            
            $insert_stmt->bindParam(":productid", $product['id']);
            $insert_stmt->bindParam(":orderid", $orderid);
            $insert_stmt->bindParam(":price", $product['price']);
            $insert_stmt->bindParam(":quantity", $products_in_cart[$product['id']]);
            $insert_stmt->bindParam(":total", $total);
            $insert_stmt->execute();
        } catch(PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    unset($_SESSION['cart']);
}
else {
    header("Location: home.php?page=cart");
    exit;
}
/*
if(isset($_POST["checkout"]) && isset($_POST["checkout"]) == "order") {
    $date = date('Y-m-d H:i:s'); 
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $note = $_POST["note"];
    $pmode = $_POST["payment-method"];
    $data = "";
    try {
        $insert_stmt = $pdo->prepare("INSERT INTO orders(name_order, datecreation, 
        name, phone, address, note, payment_mode) values ('New Order', 
        '$date', :name, :phone, :address, :note, :pmode)");
        $insert_stmt->bindParam(":name", $name);
        $insert_stmt->bindParam(":phone", $phone);
        $insert_stmt->bindParam(":address", $address);
        $insert_stmt->bindParam(":note", $note);
        $insert_stmt->bindParam(":pmode", $pmode);
        $insert_stmt->execute();
    } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
    $orderid = $pdo->lastInsertId();

    foreach($products as $product) {
        try {
        $insert_stmt = $pdo->prepare("INSERT INTO ordersdetail(productid, orderid, price, quantity, total) 
        values (:productid, :orderid, :price, :quantity, :total)");
        $total = $product['price'] * $products_in_cart[$product['id']];
        $string .= $product['name'] . ", ";
        
        $insert_stmt->bindParam(":productid", $product['id']);
        $insert_stmt->bindParam(":orderid", $orderid);
        $insert_stmt->bindParam(":price", $product['price']);
        $insert_stmt->bindParam(":quantity", $products_in_cart[$product['id']]);
        $insert_stmt->bindParam(":total", $total);
        $insert_stmt->execute();
        } catch(PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    $data.='<div class = "container text-center">
        <h1>Thank you</h1>
        <h2>Your Order Placed Successfully!</h2>
        <h4>Items Purchase: '.rtrim($string, ", ").'</h4>
        <h4>Your name: '.$name.'</h4>
        <h4>Your Phone: '.$phone.' </h4>
        <h4>Address: '.$address.' </h4>
        <h4>Total: &dollar;'.number_format($subtotal, 2).'</h4>
        <h4>Payment Mode: '.$pmode.'</h4>
        <a href = "home.php">Click here to continue buy product</a>
        </div>
        ';
    echo $data;
    unset($_SESSION['cart']);
}
*/

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfect</title>
    <!-- bootsrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Google Fonts-->
    <link rel = "preconnect" href = "https://fonts/gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <!-- aos-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!--<link rel = "stylesheet" href = "../css/cart.css">-->
    
    <style>
        body {
            background-image: url(./images/about.jpg);
            background-size: cover;
            font-family:Arial, Helvetica, sans-serif;
        }
        /* for checkout */
        .show-box {
            /*border: 3px solid black;*/
            background-color: white;
            border-radius: 10px;
            color: black;
            font-weight: 900;
        }
        a {text-decoration: none; color: black;}
        a:hover {text-decoration: none; color: blueviolet;}
    </style>
</head>
<body>
    <div class = "main">
        <div class = "container overlay text-white pt-5">
            <div class = "row">
                <div class = "col text-center">
                    <h1>Thank you</h1>
                    <h2>Your Order Placed Successfully!</h2>
                </div>
            </div>
            <div class = "row">
                <div class = "col-xl-4 col-lg-4 col-md-4 col-12"></div>
                <div class = "col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class = "row show-box" data-aos = "fade-down">
                        <div class = "col-md-12">Your order id: <?php echo $orderid ?></div>
                    </div>
                    <div class = "row show-box mt-2" data-aos = "slide-right">
                        <div class = "col-md-12">Item Purchase: <?php echo rtrim($string, ", ") ?></div>
                    </div>
                    <div class = "row show-box mt-2" data-aos = "slide-left">
                        <div class = "col-md-12">Your name: <?php echo $name ?></div>
                    </div>
                    <div class = "row show-box mt-2" data-aos = "flip-right">
                        <div class = "col-md-12">Your phone: <?php echo $phone ?></div>
                    </div>
                    <div class = "row show-box mt-2" data-aos = "flip-left">
                        <div class = "col-md-12">Address: <?php echo $address ?></div>
                    </div>
                    <div class = "row show-box mt-2" data-aos = "fade-up-right">
                        <div class = "col-md-12">Total: &dollar;<?php echo number_format($subtotal, 2) ?></div>
                    </div>
                    <div class = "row show-box mt-2" data-aos = "fade-up-left">
                        <div class = "col-md-12">Payment mode: <?php echo $pmode ?></div>
                    </div>
                    <div class = "row show-box mt-5" data-aos = "fade-out">
                        <div class = "col-md-12 text-center"><a href = "home.php">Click here to continue order food</a>
                    </div>
                <div class = "col-xl-4 col-lg-4 col-md-4 col-12"></div>
            </div>
        </div>
    </div>
</body>
<!-- data aos-->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        once: false,
        duration: 2000,
    });
    
</script>
</html>