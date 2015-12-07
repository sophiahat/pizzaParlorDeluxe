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
    <title>Admin Update</title>
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
                   <li><a href="../order.html">Order</a></li>
               </ul>
           </nav>
        <main class="main">
            <article class="article-admin-change">
            <h1>Admin Edits</h1>
            <h3>Administrative Accounts</h3>
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
                            <div class="scrolling">
                <hr>
                <h3>Edit Admin Users</h3>
                <form method="post" action="processAdminChange.php" onsubmit="">
                    <p>Please enter User ID and any required edits to that user</p>
                    User ID: <input type="text" name="EuserID" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"> <br>
                    Login:<input type="text" name="Elogin" class="input-admin-change" value=""><br>
                    First Name: <input type="text" name="EfirstName" class="input-admin-change" value=""><br>
                    Last Name:<input type="text" name="ElastName" class="input-admin-change" value=""><br>
                    Password:<input type="text" name="Epassword" class="input-admin-change" value=""><br>
                    Admin Level:<input type="text" name="EadminLevel" class="input-admin-change" value=""><br>
                    <br>
                    <input type="submit" value="Submit User Edit">
                    </p>
                    <span id="loginWarn">

                    </span>


                </form>
                <hr>
                <h3>Delete Admin User</h3>
                 <form method="post" action="processAdminChange.php" onsubmit="return chkForm(1)">
                    <p>Please enter User Id to delete.</p>
                    User ID: <input type="text" name="DuserID" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"> <br>

                    <br>
                    <input type="submit" value="Delete User">
                    </p>
                    <span id="loginWarn">

                    </span>


                </form>
                <hr>
                <h3>Add Admin User</h3>
                <form method="post" action="processAdminChange.php" onsubmit="return chkForm(2)">
                    <p>Please enter info in all fields</p>
                    Login:<input type="text" name="Alogin" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"><br>
                    First Name: <input type="text" name="AfirstName" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"><br>
                    Last Name:<input type="text" name="AlastName" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"><br>
<!--                    Password:<input type="text" name="Apassword" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"><br>-->
                    Admin Level:<input type="text" name="AadminLevel" class="input-admin-change" value="" onchange="return clrErr('loginWarn')"><br>
                    <br>
                    <input type="submit" value="Submit New User">
                    </p>
                    <span id="loginWarn">

                    </span>


                </form>
                
            </div>
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