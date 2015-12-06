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

// SQL statement
$sql = "SELECT * FROM admins";

// query database and determine error is failure
$result = mysqli_query($con, $sql) or die(mysql_error());

?>
<!DOCTYPE html>
<html>
<head>
    <title>Daily Summary</title>
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
        <main class="main">
            <article class="article">
            <h3>Welcome to the Admin section of Pizza Time!</h3>
            <p>Please choose your task from the menu to the right.</p>
            
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