<?php session_start();
//find http referer
//echo $_SERVER['HTTP_REFERER'];

// check session variables
//print_r($_SESSION);
//print_r($_POST);

// variable to hold refering page
//$httpReferer = "http://localhost:8888/PaceItStuff/PHP/PizzaParlorDeluxe/info.php";

// requiring database connection
require_once("includes/connect.php");



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
    $subtotal = $_SESSION['subtotal'];
    $tax = $_SESSION['tax'];
    $total = $_SESSION['total'];
//    print "$subtotal, $tax, $total";
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
    $pizzaDesc = $pizza_size . " " . $pizza_crust . " - ". $pizza_type;
    print "Size: $pizza_size inch<br>Crust: $pizza_crust<br>Type:$pizza_type<br><br>Extra Toppings: <br>";
    if(!$pizza_toppings == []){
        $pizzaDesc .= "  add";
        foreach($pizza_toppings as $topping){
            print "$topping<br>";
            $pizzaDesc .= " - " . $topping;
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
<?php
// check to see if current order customer is in database
$sql = "SELECT custID, custEmail FROM customers WHERE custFName = '$first_name' AND custLName = '$last_name'";

//print $sql;
// execute SQL statement
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
//print_r($result);
//print "<br>";
if($result->num_rows == 0) {
//    print_r($result);
//    print "<br>";
    // create a new customer record
    $sql = "INSERT INTO customers (custFName, custLName, custEmail, custAddress, custApartment, custCity, custState, custZip, custPhone) VALUES ('$first_name', '$last_name', '$email', '$address', '$apartment', '$city', '$state', '$zip', '$phone')";
    
    // execute SQL statement
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    // get custID from newly created record
    $custID = $con->insert_id;
}
else {
//    print"Finding a matching customer record";
    print "<br>";
    while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
        if ($row['custEmail'] == $email) {
            $custID = $row['custID'];
//            print "Found email match <br>";
//            break;
        
        }else {
            
//            print "Same Customer name, different email";
//            print "<br>";
            $sql = "INSERT INTO customers (custFName, custLName, custEmail, custAddress, custApartment, custCity, custState, custZip, custPhone) VALUES ('$first_name', '$last_name', '$email', '$address', '$apartment', '$city', '$state', '$zip', '$phone')";
    
        // execute SQL statement
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        // get custID from newly created record
        $custID = $con->insert_id;
        }
    }
}

$date = getdate();
$day = $date['year']."-". $date['mon']. "-". $date['mday'];
$time = $date['hours'].":".$date['minutes'].":".$date['seconds'];
$orderTime = $date['year']."-". $date['mon']. "-". $date['mday']. " ". $date['hours'].":".$date['minutes'].":".$date['seconds'];
//print $orderTime;
//print "<br>";
//print $custID;
//print "<br>";

// sql statement for writing order
$sql = "INSERT INTO orders (dateTimePlaced, custID, pizzaDesc, priceSub, tax, priceTotal, date, time) VALUES ('$orderTime', '$custID', '$pizzaDesc', '$subtotal', '$tax', '$total', '$day', '$time')";

//print "Final output to database:  $sql";
// execute SQL statement
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

?>
</body>
</html>