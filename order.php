<!DOCTYPE html>
<html>
<head>
    <title>PizzaTime - Order</title>
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
<body onload="updateOrderHtml()">
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
                <h2>Let's Order <strong>Now!</strong></h2>
                <form id="pizza_form" action="info.php" method="post">

                   <fieldset>
                       <legend>Choose Your Pizza Size:</legend>
                       <div class="radio-group">
                           <input type="radio" name="pizza_size" id="12" checked value="12" onclick="orderUpdate(this.form)">
                           <label for="12">12-inch</label>
                       </div>
                       <div class="radio-group">
                           <input type="radio" name="pizza_size" id="16" value="16" onclick="orderUpdate(this.form)">
                           <label for="16">16-inch</label>
                       </div>
                       <div class="radio-group">
                           <input type="radio" name="pizza_size" id="20" value="20" onclick="orderUpdate(this.form)">
                           <label for="20">20-inch</label>
                       </div>
                   </fieldset>
                   <fieldset>
                       <legend>Choose Your Pizza Crust</legend>
                       <div class="radio-group">
                           <input type="radio" name="crust_type" id="deep_dish" checked value="deep_dish" onclick="orderUpdate(this.form)">
                           <label for="deep_dish">Deep Dish</label>
                       </div>
                       <div class="radio-group">
                           <input type="radio" name="crust_type" id="thin_crust" value="thin_crust" onclick="orderUpdate(this.form)">
                           <label for="thin_crust">Thin Crust</label>
                       </div>
                   </fieldset>
                   <fieldset>
                       <legend>Choose Your Pizza Type</legend>
                       <div class="radio-group">
                           <input type="radio" name="pizza_type" id="hawaiian" value="hawaiian" onclick="orderUpdate(this.form)">
                           <label for="hawaiian">Hawaiian</label>
                       </div>
                       <div class="radio-group">
                           <input type="radio" name="pizza_type" id="meatlover" checked value="meatlover" onclick="orderUpdate(this.form)">
                           <label for="meatlover">Meat Lovers</label>
                       </div>
                       <div class="radio-group">
                           <input type="radio" name="pizza_type" id="veggie" value="veggie" onclick="orderUpdate(this.form)">
                           <label for="veggie">Veggie</label>
                       </div>
                       <div class="radio-group">
                           <input type="radio" name="pizza_type" id="build" onclick="orderUpdate(this.form)" value="build_your_own">
                           <label for="build">Build Your Own</label>
                       </div>  
                        <div id="toppings">
                            <div class="check-group">
                               <input class="ptoppings" type="checkbox" name="ptoppings[0]" id="pepperoni" value="pepperoni" onclick="orderUpdate(this.form)">
                               <label for="pepperoni">Pepperoni</label>
                           </div>
                           <div class="check-group">
                               <input class="ptoppings" type="checkbox" name="ptoppings[1]" id="onions" value="onions" onclick="orderUpdate(this.form)">
                               <label for="onions">Onions</label>
                           </div>
                           <div class="check-group">
                               <input class="ptoppings" type="checkbox" name="ptoppings[2]" id="extra_cheese"
                               value="extra_cheese" onclick="orderUpdate(this.form)">
                               <label for="extra_cheese">Extra Cheese</label>
                           </div>
                           <div class="check-group">
                               <input class="ptoppings" type="checkbox" name="ptoppings[3]" id="olives" value="olives" onclick="orderUpdate(this.form)">
                               <label for="olives">Olives</label>
                           </div>
                           <div class="check-group">
                               <input class="ptoppings" type="checkbox" name="ptoppings[4]" id="green_peppers" value="green_peppers" onclick="orderUpdate(this.form)">
                               <label for="green_peppers">Green Peppers</label>
                           </div>
                           <div class="check-group">
                               <input class="ptoppings" type="checkbox" name="ptoppings[5]" id="sundried_tomatoes" value="sundried_tomatoes" onclick="orderUpdate(this.form)">
                               <label for="sundried_tomatoes">Sundried Tomatoes</label>
                           </div>
                        <input id="subtotal" type="hidden" name="subtotal" value="5">
                        <input id="tax" type="hidden" name="tax" value="7">
                        <input id="total" type="hidden" name="total" value="9">
                        </div>     
                   </fieldset>
                    
                   <input class="submit_button" type="submit" value="Submit Order" onclick="submitPizza()">
                </form>
            </article>
            <aside class="aside">
                <h3>Your Pie:</h3>
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