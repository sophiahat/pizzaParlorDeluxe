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
    <title>Admin Users</title>
    <meta charset="utf-8">
    <meta content="Chris Spencer" name="author">
    <meta content="July 2015" name="date">
    <meta content="NOINDEX, NOFOLLOW" name="robots">
    <meta content="pizza delivery website with online order processing" name="description">
    <meta content="pizza online, order pizza, pizza delivery" name="keywords">
    <meta content="text/html" name="http-equiv">
    <link rel="stylesheet" href="../css/styles.css">
    <script type="text/javascript" src="../javascript/admin.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
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
                   <li><a href="../order.php">Order</a></li>
               </ul>
           </nav>
        <main class="main">
            <article class="article">
            <h1>Administrative Accounts</h1>
            <table>
                <tr>
                    <th>UserId</th>
                    <th>Login</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Password</th>
                    <th>Admin Level</th>
                </tr>
<?php
// check for data on return
if($result->num_rows > 0 ) {
    // create row for each record
    while($row = $result->fetch_assoc()) {
        // admin id
        $output = "<tr><td>" . $row['userID']. "</td>";
        $output .= "<td>" . $row['login'] . "</td>";
        $output .= "<td>" . $row['firstName'] . "</td>";
        $output .= "<td>" . $row['lastName'] . "</td>";
        $output .= "<td>" . $row['password'] . "</td>";
        $output .= "<td>" . $row['adminLevel'] . "</td></tr>";
        print $output;
    }
    
}


?>
            </table>
           <input type="button" value="Edit Admin Users" onclick="window.location.href='admin_change.php'">
            </article>
            <aside class="aside">
                <h3>Admin Options</h3>
                <ul>
                    <li><a href="admin_menu.html">Admin Menu</a></li>
                    <li><a href="incomplete_orders.php">Incomplete Orders</a></li>
                    <li><a href="complete_orders.php">Complete Orders</a></li>
                    <li><a href="daily_summary.php">Daily Summary</a></li>
                    <li><a href="admin_users.php">Admin Users</a></li>
                    <li><a href="admin_login.php">Log in</a></li>
                </ul>
            </aside>
        </main>
<?php
} // end else
//$errorMessage = $_SESSION['loginWarn'];
//print $errorMessage;
?>
        <footer class="footer"></footer>
    </div>

</body>
</html>        