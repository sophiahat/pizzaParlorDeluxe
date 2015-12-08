<?php session_start();


//print_r($_SESSION);
if ($_SESSION['loggedIn'] != true){
//    print "not logged in";
   $_SESSION["loginWarn"] = "You must be logged into the system to access the page.";
   $redirectURL = "admin_login.php";
    header('Location: '. $redirectURL);
}
else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Change</title>
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
               <li><a href="../order.php">Order</a></li>
           </ul>
       </nav>
       <main class="main">
            <article class="article-admin-login">
                <form method="post" action="processPasswordChange.php" onsubmit="return chkForm(0)">
    
    

                Current password: <input type="password" name="pswOld" class="input" value="" onchange="return clrErr('loginWarn')"> <br>
                New Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="pswWord" class="input" value="" onchange="return clrErr('loginWarn')"><br>
                Confirm Password: <input type="password" name="pswConf" class="input" value="" onchange="return clrErr('loginWarn')"><br><br>
                <input type="submit" value="Log in">
                </p>
                <span id="loginWarn">
<?php
} // end else
$errorMessage = $_SESSION['loginWarn'];
print $errorMessage;
?>

                </span>


            </form>
            </article>
            <aside class="aside">
                <h3>Update your password</h3>
                <p>The password used to log in is only for the first time.</p>
                <p>You must now create your unique password, good luck and may the force be with you!</p>
                                <p>
                <h3>Please enter your old password and your new password</h3>
                <p>Passwords must include all of the four types of characters below:</p>
                <ul>
                    <li>Upper case letters</li>
                    <li>Lower case letters</li>
                    <li>Numbers</li>
                    <li>Non-alpha characters</li>
                    <li>A minimum length of eight characters</li>
                </ul>
            </aside>
        </main>





