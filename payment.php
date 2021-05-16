<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootsrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- drop down-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts-->
    <link rel = "preconnect" href = "https://fonts/gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <!--box icon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel = "stylesheet" href = "./css/payment.css">
</head>
<body>
<!-- Nav bar-->
<div class = "nav-wrapper" id = "navbar_top">
    <div class = "container1">
        <div class = "nav">
            <a href = "#" class = "logo">
                <i class = "bx bxs-medal bx-tada"></i>
                Perf<span class = "main-color">e</span>ct
            </a>
            <div class = "responsive">
                <ul class = "nav-menu" id = "nav-menu">
                    <li><a href = "#">Home</a></li>
                    <li><a href = "#">Our Food</a></li>
                    <li><a href = "#">About Us</a></li>
                    <li><a href = "#">FAQ</a></li>
                    <li><a href = "#" class = "btn btn-hover">
                        <span>Sign in</span>
                    </a></li>
                </ul>
                <div class = "hamburger-menu" id = "hamburger-menu">
                    <div class = "hamburger">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Panel-->
<div class="container mt-5">
    <div class = "row pt-5">
        <div class = "col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
            <div id = "accordion">
                <div class = "card">
                    <div class = "card-header">
                        <div class = "row pt-3">
                            <div class = "col-2 text-center">
                                <span class = "col1">1</span>
                            </div>
                            <div class = "col-6">
                                <span class = "col2">Delivery address</span>
                                <p>User address</p>
                            </div>
                            <div class = "col-4 pl-0">
                                <button class = "btn btn-primary" data-toggle = "collapse" data-target = "#collapseOne" id = "button-hidder">Change</button>
                            </div>
                        </div>
                    </div>
                    <div id = "collapseOne" class = "collapse" data-parent = "#accordion">
                        <div class = "card-body">
                            <div class = "row pl-3">
                                <div class = "col-6">
                                    <input type = "radio" class = "hide-for-front" name = "address" checked><span style = "text-transform: uppercase;font-size:15px;">Guest Account</span>
                                </div>
                                <div class = "col-6 text-right pr-5">
                                    <a href = "#" class = "edit hide-for-front" style = "text-transform: uppercase;">edit</a>
                                </div>
                            </div>
                            <div class = "row pl-5 pb-3 hide-for-front">
                                <div class = "col">
                                    <span style = "text-transform: uppercase">address: Null</span>
                                </div>
                            </div>
                            <div class = "row pl-5 hide-for-front">
                                <div class = "col">
                                    <p><button style = "text-transform:uppercase;padding:2% 5%;background-color:#e25111; color:white;border-color:transparent;" data-toggle = "collapse" data-target = "#collapseOne,#collapseTwo" id = "button-hidder-1">delivery here</button></p>
                                </div>
                            </div>
                            <div class = "container show-for-front">
                                <Div class = "row pl-3">
                                    <input type = "radio" checked><span style = "text-transform:uppercase; font-size:15px;">edit address</span>
                                </Div>
                                <div class = "row pl-5 pt-3 pb-3">
                                    <button class = "btn-primary text-white pl-4 pr-4 pt-2 pb-2" style = "border-radius:10px;">Use my current location</button>
                                </div>
                                <div class = "row pb-3">
                                    <div class = "col-6 text-right pr-0">
                                        <input type = "text" placeholder = "NAME" style = "width:90%;height:50px;" class = "pl-3">
                                    </div>
                                    <div class = "col-6">
                                        <input type = "text" placeholder = "10-digit mobile number" style = "width:90%;height:50px;" class = "pl-3">

                                    </div>
                                </div>
                                <div class ="row pr-0 pb-3">
                                    <div class = "col-6 text-right pr-0">
                                        <input type = "text" placeholder = "Pincode" style = "width:90%; height:50px;" class = "pl-3">
                                    </div>
                                    <div class = "col-6">
                                        <input type = "text" placeholder = "Locality" style = "width:90%;height:50px;" class= "pl-3">
                                    </div>
                                </div>
                                <div class = "row pb-3" style = "padding-left: 4.7%;">
                                    <div class = "col">
                                        <input type = "text" placeholder = "Address (Area and Street)" style = "width:95%; height:50px;" class = "pl-3">

                                    </div>
                                </div>
                                <Div class = "row pb-3">
                                    <div class = "col-6 text-right pr-0">
                                        <input type = "text" placeholder = "City/District/Town" style = "width:90%;height:50px;" class = "pl-3">
                                    </div>
                                    <div class = "col-6">
                                        <input type = "text" placeholder = "State" style = "width:90%; height:50px;" class = "pl-3">

                                    </div>
                                </Div>
                                <div class = "row pr-0 pb-3">
                                    <div class = "col-6 text-right pr-0">
                                        <input type = "text" placeholder = "Landmark (optional)" style = "width:90%;height:50px;" class = "pl-3">

                                    </div>
                                    <div class= "col-6">
                                        <input type = "text" placeholder = "Alternate Phone (Optional)" style = "width:90%;height:50px;" class = "pl-3">
                                    </div>
                                </div>
                                <div class = "row pl-5">
                                    <button class = "btn-primary text-white pl-4 pr-4 pt-2 pb-2" 
                                    style = "border-radius:10px;text-transform:uppercase; font-weight:600;" 
                                    data-toggle = "collapse" data-target = "#collapseOne,#collapseTwo"
                                    id = "button-hidder-1-1">Save and delivery</button>
                                    &nbsp;&nbsp;&nbsp;<span class = "pt-2 call-back"><a href = "#" style = "text-transform:uppercase;">Cancel</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "card">
                    <div class = "card-header">
                        <div class = "row pt-3 pb-3">
                            <div class = "col-2 text-center">
                                <span class = "col1">2</span>
                            </div>
                            <div class = "col-10">
                                <span class = "col2">Order Summary</span>
                            </div>
                        </div>
                    </div>
                    <div id = "collapseTwo" class = "collapse">
                        <div class = "card-body">
                            <div class = "row pb-3">
                                <div class = "col-xl-4 col-lg-2 col-md-4 col-sm-4 col-12 pt-5 text-center">
                                    <img src = "./images/burger.jpg" height = "200px" width = "200px">
                                    <div class = "text-left">
                                        <select name = "Quantity" class = "custom-select mt-2 first">
                                            <option value = "1" selected>1</option>
                                            <option value = "2">2</option>
                                            <option value = "3">3</option>
                                            <option value = "4">4</option>
                                            <option value = "5">5</option>
                                            <option value = "6">6</option>
                                            <option value = "7">7</option>
                                            <option value = "8">8</option>
                                            <option value = "9">9</option>
                                            <option value = "10">10</option>
                                       </select>
                                    </div>
                                </div>
                                <div class = "col-xl-8 col-lg-10 col-md-8 col-sm-8 col-8 pt-5">
                                    <p>Item Name:&nbsp;Hamburger</p>
                                    <p>Seller: &nbsp;Yasuo</p>
                                    <p>Price: &nbsp;$50</p>
                                    <p><a href = "#" style = "font-weight:700; color:#e25111;">REMOVE</a></p>
                                </div>
                            </div>
                            <div class = "row pb-3">
                                <div class = "col-xl-4 col-lg-2 col-md-4 col-sm-4 col-12 pt-5 text-center">
                                    <img src = "./images/pizza.jpg" height = "200px" width = "200px">
                                    <div class = "text-left">
                                        <select name = "Quantity" class = "custom-select mt-2 second">
                                            <option value = "1" selected>1</option>
                                            <option value = "2">2</option>
                                            <option value = "3">3</option>
                                            <option value = "4">4</option>
                                            <option value = "5">5</option>
                                            <option value = "6">6</option>
                                            <option value = "7">7</option>
                                            <option value = "8">8</option>
                                            <option value = "9">9</option>
                                            <option value = "10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class = "col-xl-8 col-lg-10 col-md-8 col-sm-8 col-12 pt-5">
                                    <p>Item Name: &nbsp;Pizza</p>
                                    <p>Seller: &nbsp;Master Yi</p>
                                    <p>Price: &nbsp;$50</p>
                                    <p><a href = "#" style = "font-weight:700; color: #e25111;">REMOVE</a></p>
                                </div>
                            </div>
                            <div class = "row pb-3">
                                <div class = "col-xl-4 col-lg-2 col-md-4 col-sm-4 col-12 pt-5 pl-5 text-center">
                                    <img src = "./images/momo.jpg" height = "200px" width = "200px">
                                    <div class = "text-left">
                                        <select name = "Quantity" class=  "custom-select mt-2 third text-center">
                                            <option value = "1" selected>1</option>
                                            <option value = "2">2</option>
                                            <option value = "3">3</option>
                                            <option value = "4">4</option>
                                            <option value = "5">5</option>
                                            <option value = "6">6</option>
                                            <option value = "7">7</option>
                                            <option value = "8">8</option>
                                            <option value = "9">9</option>
                                            <option value = "10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class= "col-xl-8 col-lg-10 col-md-8 col-sm-8 col-12 pt-5">
                                    <p>Item Name: &nbsp;Dumpling</p>
                                    <p>Seller: &nbsp;Ezreal</p>
                                    <p>Price: &nbsp;$50</p>
                                    <p><a href = "#" style = "font-weight:700px; color:#e25111;">REMOVE</a></p>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col pr-5 text-right">
                                    <p><button style = "text-transform:uppercase; padding:2% 5%; background-color:#e25111;color:white;border-color:transparent" data-toggle = "collapse" data-target = "#collapseTwo,#payment-option">continue</button></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "card">
                    <div class = "card-header">
                        <div class = "row pt-3 pb-3">
                            <div class = "col-2 text-center">
                                <span class=  "col1">3</span>
                            </div>
                            <div class = "col-10">
                                <span class = "col2">Payment Options</span>
                            </div>
                        </div>
                    </div>
                    <div class=  "card-body">
                        <div class = "collapse" id = "payment-option">
                            <div class = "row">
                                <Div class = "col pl-4 pb-3" id = "momo-hidder">
                                    <input type = "radio" name = "payment-method" data-toggle = "collapse" data-target = "#momo">&nbsp;&nbsp;&nbsp;
                                    <img src = "./images/momo.png" style = "height:30px;">Momo
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
                            <div class = "row">
                                <div class = "col pl-4" id = "credit-hidder">
                                    <p><input type = "radio" name = "payment-method" data-toggle = "collapse" data-target = "#credit">&nbsp;&nbsp;&nbsp;Credit/Debit/ATM Card</p>
                                </div>
                            </div>
                            <div class = "collapse" id = "credit">
                                <div class = "row">
                                    <div class = "col pl-5">
                                        <p><input type = "text" placeholder = "Enter Card Number" class = "pt-2 pb-2 pl-4 card-number"></p>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 pl-5">
                                        <p><input type = "date" placeholder = "DD/MM/YYYY" class = "pt-2 pb-2 pl-2 pr-2 date"></p>
                                    </div>
                                    <div class = "col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12 pl-5">
                                        <p><input type = "text" placeholder = "CVV" class = "pt-2 pb-2 pl-4 cvv"></p>
                                    </div>
                                    <div class = "col-xl-6 pt-1 pl-5">
                                        <p><button style = "text-transform:uppercase;padding:1.5% 7%;background-color: #e25111;color:white;border-color:transparent;"data-toggle = "collapse" data-target = "#payment-option">PAY $150</button> </p>

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
                                        <img src = ".images/agb.jpg" style = "height:20px;">&nbsp;&nbsp;&nbsp;Agribank
                                    </div> 
                                    <div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                        <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                        <img src = "./images/vpb.jpg" style = "height:20px;">&nbsp;&nbsp;&nbsp;VP Bank
                                    </div>
                                    <div class = "col-xl-4 col-lg-4 col-md-6 pt-3">
                                        <input type = "radio" name = "bank">&nbsp;&nbsp;&nbsp;
                                        <img src = "./images/scb.jpg" style = "height:20px;">&nbsp;&nbsp;&nbsp;Sacombank
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
                                    <p><button style = "text-transform:uppercase;padding:1.5% 7%;background-color:grey; color:white; border-color:transparent; font-weight: 600;" data-toggle = "collapse" data-target = "#payment-option">PAY $145</button></p>
                                </div>
                            </div>                           
                        </div>
                        <div class = "row">
                            <div class = "col pl-4" id = "cash-hidder">
                                <p><input type = "radio" name = "payment-method" data-toggle = "collapse" data-target = "#cash">&nbsp;&nbsp;&nbsp;Cash on Delivery</p>
                                <div class = "collapse" id = "cash">
                                    <p class = "pl-3"><button style = "text-transform:uppercase;padding:1.5% 7%; background-color:grey;color:white; border-color: transparent;font-weight: 600;" data-toggle = "collapse" data-target = "#payment-option">Confirm</button></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "col-xl-4 col-lg-2 col-md-12 col-sm-12 col-12 mt-3 pb-4">
        <div class = "container">
            <div class = "card">
                <div class = "card-header">PRICE DETAILS</div>
                <div class = "card-body">
                    <div class = "row">
                        <div class = "col text-left">
                            Price(3):
                        </div>
                        <div class = "col text-right">
                            $150
                        </div>
                    </div>
                    <div class = "row pt-3">
                        <div class = "col-7 text-left">
                            Delivery Charges:
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
                            $150
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jquery-
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
-->
<!-- For dropdown-->
<script>

    $(document).ready(() => {
        $('#hamburger-menu').click(() => {
            $('#hamburger-menu').toggleClass('active');
            $('#nav-menu').toggleClass('active');
        })
    });
    $(document).ready(function(){
        $("#button-hidder").click(function(){
            $(this).hide();
            $("#button-hidder-1").show();
        });
        $("#button-hidder-1").click(function(){
            $("#button-hidder").show();
            $(this).hide();
        });
        $("#button-hidder-1-1").click(function() {
            $("#button-hidder").show();
            $(this).hide();
        });
        $(".edit").click(function(){
            $(".hide-for-front").css("display","none");
            $(".show-for-front").css("display","block");
        });
        $(".call-back").click(function(){
            $(".hide-for-front").css("display","block");
            $(".show-for-front").css("display","none");
        });
        $("#button-hidder").click(function(){
            $("#collapseTwo,#payment-option").collapse("hide");
        });
        $("#momo-hidder").click(function(){
            $("#credit,#net-banking,#cash").collapse("hide");
        });
        $("#credit-hidder").click(function(){
            $("#momo,#net-banking,#cash").collapse("hide");
        });
        $("#net-banking-hidder").click(function(){
            $("#momo,#cash,#credit").collapse("hide");
        });
        $("#cash-hidder").click(function(){
            $("#momo,#net-banking,#credit").collapse("hide");
        });
    })
</script>
</body>
</html>