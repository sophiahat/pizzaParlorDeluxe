<?php session_start();

//find http referer
//echo $_SERVER['HTTP_REFERER'];

// check session variables
//print_r($_SESSION);

// variable to hold refering page
$httpReferer = "http://localhost:8888/PaceItStuff/PHP/PizzaParlorDeluxe/admin/password_change.php";

// create variables 
$oldPassCorrect = false;
$newPassCorrect = false;
//$hash = "";

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
    
    // check and or create session variable for number of password
    if (!isset($_SESSION['passChangeAttempt'])) {
        $_SESSION['passChangeAttempt'] = 0;
    }
    $userID = $_SESSION['userID'];
//    print $userID;
    // create SQL statement to get old password
    $sql = "SELECT password FROM admins WHERE userID = '$userID' ";
//    print $sql;
    // execute SQL statement
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
    // check for data in the result
    if ($result) {
        // put result in an associative array
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $storedPass = $row['password'];
        }
    }
    // no match found, return to password change page
    else {
        $_SESSION['loginWarn'] = "Record not found in database";
        $_SESSION['passChangeAttempt'] +=1;
        header('Location: '."password_change.php");
    }
    
    // check for first log in
    if (($_POST['pswOld'] == 'Noth1ng!') && ($storedPass == 'Noth1ng!')) {
        $oldPassCorrect = true;
    }
    // otherwise, check stored password against entered
    elseif($_POST['pswOld'] == $storedPass) {
        $oldPassCorrect = true;
    }
    //otherwise, password doesn't match, redirect to password change page
    else {
        $_SESSION['passChangeAttempt'] += 1;
        $_SESSION['loginWarn'] = "Old password is incorrect.";
        header('Location: '. "password_change.php");
    }
    //check to see if new password and confirmed match 
    if ($_POST['pswWord'] == $_POST['pswConf']) {
        // regular expression to check new password
        $re = "/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{8,}/";
        // check new password
        if (preg_match($re, $_POST['pswWord'])) {
            //all good
            $newPassCorrect = true;
        }
        // does not meet minimum requirements
        else {
            $_SESSION['passChangeAttempt'] += 1;
            $_SESSION['loginWarn'] = "Password does not meet the complexity requirements";
            header('Location: ' . "password_change.php");
        }
    }
    // new password does not match confirmed password entry
    else {
        $_SESSION['passChangeAttempt'] += 1;
        $_SESSION['loginWarn'] = "Passwords do not match, please retype your password";
        header('Location: ' . "password_change.php");
    }
    // all conditions have been met, write new password to database
    if ($oldPassCorrect && $newPassCorrect) {
        $pass = $_POST['pswWord'];
        $sql = "UPDATE admins SET password = '". $_POST['pswWord'] . "' WHERE userID = '$userID'";
//        print $sql;
        
        // execute sql statement
        $result = mysqli_query($con, $sql) or die('shoot');
        
        // send the user to the admin page
        header('Location: ' . "admin_menu.html");
    }
    
}

?>