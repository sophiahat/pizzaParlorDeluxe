<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta content="Chris Spencer" name="author">
    <meta content="July 2015" name="date">
    <meta content="NOINDEX, NOFOLLOW" name="robots">
    <meta content="pizza delivery website with online order processing" name="description">
    <meta content="pizza online, order pizza, pizza delivery" name="keywords">
    <meta content="text/html" name="http-equiv">
    <link rel="stylesheet" href="../css/styles.css">
    <script type="text/javascript" src="../javascript/admin.js"></script>
<?php
// boolean to show form
$showForm = true;

//check if this is first attempt to login to admin site, if so, there is currently no session variable

if(!isset($_SESSION['logOnAttempt'])) {
    //create session variable to track login attempts
    $_SESSION['logOnAttempt'] = 0;
    $showForm = true;
}
// check to see if more than 10 attempts have been made
elseif($_SESSION['logOnAttempt'] >= 10) {
    $_SESSION['loginWarn'] = "There is a problem with the log in capabilities. Contact the administrator of this site for access.";
    $showForm = false;
}
// check to see if there have been 3 or more log in attempts
elseif($_SESSION['logOnAttempt'] >= 3) {
    $_SESSION['loginWarn'] = "There is a problem with your credentials. Contact the administrator of this site for access.";
    $showForm = false;
}
?>
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
<?php
    if ($showForm == true){               
?>    
               <form method="post" action="login.php" onsubmit="return chkForm(0)">
                <h2>Admininstrative Login</h2>
                <p>Please enter your Administrator login credentials:</p>
                <p>User name: <input type="text" name="txtUser" class="input" value=""></p>
                <p>Password: <span><input type="password" name="pswWord" class="input"></span></p>
                <input type="submit" value="Log In">
<?php
    }
?>
                  <span id="loginWarn">
                      <?php
                      //Session variable to display login warning
                      if (isset($_SESSION['loginWarn'])) {
                          print $_SESSION['loginWarn'];
                      }
                      ?>
                  </span>
           
                </form>
            </article>
            <aside class="aside">
                <h3>Login Restricted Access</h3>
                <p>This is an area of limited access, you must have a valid username and password to proceed</p>
                <p>If you have reached this page in error, please use your browser&#39;s back button or choose one of the pages from the navigation above.</p>
            </aside>
        </main>        
    </div>
    <footer>
        <p>Copyright 2015 Spencer Creative</p>
    </footer>
</body>
</html>