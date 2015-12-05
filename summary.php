<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>PizzaTime - Order Contact Info</title>
    <meta charset="utf-8">
    <meta content="Chris Spencer" name="author">
    <meta content="July 2015" name="date">
    <meta content="NOINDEX, NOFOLLOW" name="robots">
    <meta content="pizza delivery website with online order processing" name="description">
    <meta content="pizza online, order pizza, pizza delivery" name="keywords">
    <meta content="text/html" name="http-equiv">
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="javascript/jquery.js"></script>
    <script type="text/javascript" src="javascript/jquery.validate.js"></script>
    <script type="text/javascript"src="javascript/additional-methods.min.js"></script>
    <script type="text/javascript" src="javascript/order.js"></script>
</head>
<body onload="loadSummary();">
<?php

    if (isset($_SESSION['pizza_toppings'])) {
        $pizza_toppings = $_SESSION['pizza_toppings'];
    }else{
        $pizza_toppings = [];
    }
    
    $pizza_size = filter_input(INPUT_POST, "pizza_size");
    $pizza_crust = filter_input(INPUT_POST, "crust_type");
    $pizza_type = filter_input(INPUT_POST, "pizza_type");
    $first_name = filter_input(INPUT_POST, "fname");
    $last_name = filter_input(INPUT_POST, "lname");
    $email = filter_input(INPUT_POST, "email");
    $address = filter_input(INPUT_POST, "address");
    $apartment = filter_input(INPUT_POST, "apartment");
    $city = filter_input(INPUT_POST, "city");
    $state = filter_input(INPUT_POST, "state");
    $zip = filter_input(INPUT_POST, "zip");
    $phone = filter_input(INPUT_POST, "phone");
    
?>
    <header class="header">
        <h1>Pizza Time</h1>
    </header>
    <div class="container">
       <nav class="nav">
           <ul>
               <li><a href="home.html">Home</a></li>
               <li><a href="about.html">About</a></li>
               <li><a href="menu.html">Menu</a></li>
               <li><a href="gallery.html">Gallery</a></li>
               <li><a href="order.html">Order</a></li>
           </ul>
       </nav>
        <main class="main">
            <article class="article">
                <h2>Your Order is on the way...</h2>
                <p>Thanks for your order, we sincerely appreciate your patronage!</p>
                <hr>
                <h3>Estimated Delivery</h3>
                <div id="order_details">
                    <p>The scheduled delivery time of your pie is: <span id="arrival"></span> </p>
                    <p id="timer"></p>
                </div>
                <hr>
                <h3>Delivery Details</h3>
<?php
print <<<HERE
    <div id="delivery_details">
        <p>Name: <br><span id="firstName">$first_name</span> <span id="lastName">$last_name</span></p>
        <p>Address:<br> 
            <span id="address">$address</span> <span id="apartment">$apartment</span><br>
            <span id="city">$city</span>
            <span id="state">$state</span>
            <span id="zip">$zip</span>
        </p>
        <p>Email: <span id="email">$email</span><br>Phone: <span id="phone">$phone</span></p>
    </div>
HERE;
?>
            </article>
            <aside class="aside">
                <h3>Your Order Summary</h3>

<?php
    print "Size: $pizza_size inch<br>Crust: $pizza_crust<br>Type:$pizza_type<br><br>Extra Toppings: <br>";
    if(!$pizza_toppings == []){
        foreach($pizza_toppings as $topping){
            print "$topping<br>";
        }
    }

$_SESSION['pizza_toppings'] = $pizza_toppings;
$_SESSION['pizza_size'] = $pizza_size;
$_SESSION['pizza_crust'] = $pizza_crust;
$_SESSION['pizza_type'] = $pizza_type;
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['address'] = $address;
$_SESSION['apartment'] = $apartment;
$_SESSION['city'] = $city;
$_SESSION['state'] = $state;
$_SESSION['zip'] = $zip;
$_SESSION['phone'] = $phone;
            
?>
                <div class="toppings-display-box">
                    <p><span id="ptoppings"></span></p>
                </div>
                <p>Subtotal: <span id="pprice"></span></p>
                <p>Tax: <span id="ptax"></span></p>
                <p>Total: <span id="ptotal"></span></p>
               
            </aside>
        </main>        
    </div>
    <footer>
        <p>Copyright 2015 Spencer Creative</p>
    </footer>
</body>
</html>