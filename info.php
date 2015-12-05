<?php session_start();
session_unset();
// check session variables
//print_r($_SESSION);
//print_r($_POST);
?>
<!DOCTYPE html>
<html>
<head>
    <title>PizzaTime - Order Page 2</title>
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
<body onload="loadDeliveryForm()">
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
                <h2>Delivery Information</h2>
                <p>(* required information)</p>
                <form id="delivery_form" action="summary.php" method="post">
<?php
// create variables for sending to next page
$form_values = filter_input_array(INPUT_POST);

// check to see if extra toppings and store in session variable
if(filter_has_var(INPUT_POST, "ptoppings")){
    $pizza_toppings = $form_values["ptoppings"];
    $_SESSION['pizza_toppings'] = $pizza_toppings;
}

$pizza_size = filter_input(INPUT_POST, "pizza_size");
$pizza_crust = filter_input(INPUT_POST, "crust_type");
$pizza_type = filter_input(INPUT_POST, "pizza_type");
$_SESSION['subtotal'] = filter_input(INPUT_POST, "subtotal");
$_SESSION['tax'] = filter_input(INPUT_POST, "tax");
$_SESSION['total'] = filter_input(INPUT_POST, "total");


// print out the form elements
print <<<HERE
    <input type="hidden" name="pizza_size" value="$pizza_size">
    <input type="hidden" name="crust_type" value="$pizza_crust">
    <input type="hidden" name="pizza_type" value="$pizza_type">
    
HERE;



?>
                    <div id="firstNameDiv" class="text-group">
                        <label for="fname">First Name: *</label>
                        <input name="fname" class="text-group-text required" type="text" id="fname" size="47">
                    </div>
                    <div id="lastNameDiv" class="text-group">
                        <label for="lname">Last Name: *</label>
                        <input name="lname" type="text" class="text-group-text required" id="lname" size="47">
                    </div>
                    <div id="emailDiv" class="text-group">
                        <label for="email">Email: *</label>
                        <input name="email" type="email" class="text-group-text required" id="email" size="47">
                    </div>
                    <div id="addressDiv" class="text-group">
                        <label for="address">Address: *</label>
                        <input name="address" type="text" class="text-group-text required" id="address" size="47">
                    </div>
                    <div  class="text-group">
                        <label for="apartment">Apartment:</label>
                        <input name="apartment" type="text" class="text-group-text" id="apartment" size="47">
                    </div>
                    <div id="cityStateZipDiv" class="text-group">
                        <label for="city">City, State, Zip *</label>
                        <input name="city" type="text" class="text-group-text required" id="city" size="30">
                        <input name="state" class="required" type="text" id="state" size="3">
                        <input name="zip" class="required" type="text" id="zip"  size="8">
                    </div>
                    <div id="phoneDiv" class="text-group">
                        <label for="phone">Phone: * (XXX-XXX-XXXX)</label>
                        <input name="phone" type="text" class="text-group-text required" size="47" id="phone">
                    </div>
                <input class="submit_button" type="submit" value="Submit Order" onclick=" validateForm(this.form);">
                </form>

            </article>

            <aside class="aside">
                <h3>Your Order Summary</h3>
                <p><span id="psize"></span>
                <span id="pcrust"></span><br>
                <span id="ptype"></span> pizza:</p>
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