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
$httpReferer = "http://localhost:8888/PaceItStuff/PHP/PizzaParlorDeluxe/admin/admin_change.php";


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
    
    // check input to determine action
    if (isset($_POST['EuserID'])) {
        $eUserID = $_POST['EuserID'];
        $edits = "";
        if($_POST['Elogin'] != ""){
            $eLogin = $_POST['Elogin'];
            $edits .= "login='$eLogin'";

        }
        if($_POST['EfirstName'] != ""){
            $eFirstName = $_POST['EfirstName'];
            $edits .= "firstName='$eFirstName'";
        }
        if($_POST['ElastName'] != ""){
            $eLastName = $_POST['ElastName'];
            $edits .= "lastName='$eLastName'";
        }
        if($_POST['Epassword'] != ""){
            $ePassword = $_POST['Epassword'];
            $edits .= "password='$ePassword'";
        }
        if($_POST['EadminLevel'] != ""){
            $eAdminLevel = $_POST['EadminLevel'];
            $edits .= "adminLevel='$eAdminLevel'";
        }
        $sql = "UPDATE admins SET $edits WHERE userID='$eUserID'";
        // execute SQL statement
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }
    if (isset($_POST['DuserID'])) {
        $dUserID = $_POST['DuserID'];
        $sql = "DELETE FROM admins WHERE userID='$dUserID'";
//        print $sql;
        // execute SQL statement
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    }
    if (isset($_POST['Alogin'])) {
    //    $aUserID = $_POST['AuserID'];
        $aLogin = $_POST['Alogin'];
        $aFirstName = $_POST['AfirstName'];
        $aLastName = $_POST['AlastName'];
//        $aPassword = $_POST['Apassword'];
        $aAdminLevel = $_POST['AadminLevel'];
        $sql = "INSERT INTO admins (login, firstName, lastName, adminLevel) VALUES ('$aLogin', '$aFirstName', '$aLastName', '$aAdminLevel')";
//        print $sql;
        // execute SQL statement
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }


     header('Location: ' . "admin_users.php");
    
}

?>