<?php session_start();

//find http referer
//echo $_SERVER['HTTP_REFERER'];

// check session variables
//print_r($_SESSION);
//print_r($_POST);

// if not authorized send back to Admin users
$adminLevel = $_SESSION['adminAuthLevel'];
if ($adminLevel != 1) {
    $_SESSION['loginWarn'] = "You are not authorized to make changes to Admin Users.";
    header('Location: '. "admin_login");

}

// variable to hold refering page
$httpReferer = "http://localhost:8888/PaceItStuff/PHP/PizzaParlorDeluxe/admin/incomplete_orders.php";


// session variables
//clear previous error message
$_SESSION['loginWarn'] = "";

if ($_SESSION['loggedIn'] != true){
//    print "Here";
   $_SESSION["loginWarn"] = "You must be logged into the system to access the page.";
   $redirectURL = "admin_login.php";
    header('Location: '. $redirectURL);
}
elseif($_SERVER['HTTP_REFERER'] != $httpReferer) {
    //send user back
   $_SESSION["loginWarn"] = "You must be logged into the system to access the page.";
   $redirectURL = "admin_login.php";
    header('Location: '. $redirectURL);
}
else {
    // requiring database connection
    require_once("../includes/connect.php");
    
    //  create variable to hold post array
    $idMarkedComplete = filter_input_array(INPUT_POST);
//    print_r($idMarkedComplete);
    foreach($idMarkedComplete as $order => $complete) {
//        print "$order <br>";
        $sql = "UPDATE orders SET completed='y' WHERE orderID=$order";
//        print $sql
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
//        print_r($result);
//        print "<br>";
    }





     header('Location: ' . "incomplete_orders.php");
    
}

?>