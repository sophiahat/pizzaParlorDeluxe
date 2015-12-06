<?php session_start();

//print_r($_SESSION);
if ($_SESSION['loggedIn'] != true){
//    print "not logged in";
   $_SESSION["loginWarn"] = "You must be logged into the system to access the page.";
   $redirectURL = "admin_login.php";
    header('Location: '. $redirectURL);
}
else {


// requiring the db connection file
require_once("../includes/connect.php");

// SQL statement pulling in all orders
$sql = "SELECT orders.orderID, orders.dateTimePlaced, orders.pizzaDesc, orders.priceSub, orders.tax, orders.priceTotal, orders.custID, customers.custID, customers.custFName, customers.custLName, customers.custEmail, customers.custAddress, customers.custApartment, customers.custCity, customers.custState, customers.custZip FROM orders INNER JOIN customers ON orders.custID=customers.custID";
    

// query database and determine error is failure
$result = mysqli_query($con, $sql) or die(mysql_error($con));

// SQL statement pulling all customers
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Incomplete Orders</title>
    <meta charset="utf-8">
    <meta content="Chris Spencer" name="author">
    <meta content="July 2015" name="date">
    <meta content="NOINDEX, NOFOLLOW" name="robots">
    <meta content="pizza delivery website with online order processing" name="description">
    <meta content="pizza online, order pizza, pizza delivery" name="keywords">
    <meta content="text/html" name="http-equiv">
    <link rel="stylesheet" href="../css/styles.css">
    <script type="text/javascript" src="../javascript/admin.js"></script>

</head>
<body>
    <header class="header">
        <h1>Pizza Time</h1>
    </header>
    <div class="container">
       <nav class="nav">
           <ul>
               <li><a href="../home.html">Home</a></li>
               <li><a href="../about.html">About</a></li>
               <li><a href="../menu.html">Menu</a></li>
               <li><a href="../gallery.html">Gallery</a></li>
               <li><a href="../order.html">Order</a></li>
           </ul>
       </nav>
        <main class="main-table">
            <article class="article-table">
 <h1>Undelivered Pizzas</h1>
<?php
    
$tableData = "";
    // array elements
if($result->num_rows > 0 ) {
    // create row for each record
    while($row = $result->fetch_assoc()) {
        // admin id
        $tableData .= "<tr>";
        $tableData .= "<td>" . $row['orderID']. "</td>";
        $tableData .= "<td>" . $row['dateTimePlaced'] . "</td>";
        $tableData .= "<td>" . $row['pizzaDesc'] . "</td>";
        $tableData .= "<td>" . $row['priceSub'] . "</td>";
        $tableData .= "<td>" . $row['tax'] . "</td>";
        $tableData .= "<td>" . $row['priceTotal'] . "</td>";
        $tableData .= "<td>" . $row['custID'] . "</td>";
        $tableData .= "<td>" . $row['custFName']. " ". $row['custLName'] . "</td>";
        $tableData .= "<td>" . $row['custAddress'] . ", ". $row['custApartment']. ", ". $row['custCity']. ", ". $row['custState']. " ". $row['custZip']. "</td>";
//        $tableData .= "<td><input type='select' id='".$row['orderID']."'" name='delivered'></td></tr>";
        $tableData .= "</tr>";
//        print $tableData;
    }
    
}






//foreach($orders as $order) {
//    $subtotal = number_format($order['subtotal'], 2);
//    $tax = number_format($order['tax'], 2);
//    $total = number_format($order['total'],2);
//    $tableData .= "<tr><td>$order[orderId]</td>
//        <td>$order[date], $order[time]</td>
//        <td>$order[pizzaSize] inch,  $order[pizzaCrust], $order[pizzaType],  $order[pizzaToppings]</td>
//        <td>$subtotal</td>
//        <td>$tax</td>
//        <td>$total</td>
//        <td>$order[name]</td>
//        <td>$order[address], $order[city], $order[state], $order[zip]</td>
//        <td><input type='checkbox' name='delivered[$order[orderId]]' value='$order[orderId]'></td></tr>";
//    }
print <<<HERE
    <form name="orders" method="post" action="completeOrder.php">
    <table rows="4"  border="1">
    <tr>
        <th>Ord#</th>
        <th>Date/Time</th>
        <th>Pizza Description</th>
        <th>Sub</th>
        <th>Tax</th>
        <th>Total</th>
        <th>Cust#</th>
        <th>Name</th>
        <th>Address</th>
        <th>Delivered</th>
        $tableData
        
    </tr>

    <tr></tr>
    <tr></tr>
    <tr></tr>
    </table>
    <input type="submit" value="Selected Pizzas Delivered">
    </form>
HERE;
?>
            
            </article>
            <aside class="aside">
                <h3>Admin Options</h3>
                <ul>
                    <li><a href="admin_menu.html">Admin Menu</a></li>
                    <li><a href="incomplete_orders.php">Incomplete Orders</a></li>
                    <li><a href="complete_orders.php">Complete Orders</a></li>
                    <li><a href="daily_summary.php">Daily Summary</a></li>
                    <li><a href="admin_users.php">Admin Users</a></li>
                </ul>
            </aside>
        </main>        
    </div>
<?php
} // end else
//$errorMessage = $_SESSION['loginWarn'];
//print $errorMessage;
?>
    <footer>
        <p>Copyright 2015 Spencer Creative</p>
    </footer>
</body>
</html>