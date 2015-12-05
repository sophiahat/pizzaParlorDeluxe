<?php session_start();

//checks to see if the credentials were received
//echo $_SERVER['HTTP_REFERER'];
//create variables from accepted refering pages
$refer1 = "http://localhost:8888/PaceItStuff/PHP/PizzaParlorDeluxe/admin/";
$refer2 = "http://localhost:8888/PaceItStuff/PHP/PizzaParlorDeluxe/admin/admin_login.php";

// check refering pages
if (($_SERVER['HTTP_REFERER']) != $refer1 && ($_SERVER['HTTP_REFERER'] != $refer2)) {
    $redirectURL = "admin_login.php";
    
} elseif ((!isset($_POST['txtUser'])) && (!isset($_POST['pswWord']))){ 
    $redirectURL = "admin_login.php";
    
} else {
    //connects to the database
    // requiring the db connection file
    require_once("../includes/connect.php");
    
    // assign variable to login credentials
    $adminLogin = $_POST['txtUser'];
    $adminPass = $_POST['pswWord'];
    
    // encrypt user password
    $hash = "";
    
    // set default number of records found in DB
    $recCount = 0;
    
    //checks for the user in the database
    // start sql statement
    $sql = "SELECT userID, firstName, lastName, adminLevel, COUNT(*) AS numRecs FROM admins WHERE login = '$adminLogin' AND password = ";
    

    
    // check for default password being used
    if ($adminPass == "Noth1ng!") {
        //user is signing in for the first time
        $sql .= "'$adminPass';";
//        print "HERE";
        $redirectURL = "password_change.php";
    } else {
        // user has signed in before, password needs encryption
        $hash = hash('sha256', $adminPass);
//        $sql .= "'$hash';";
         $sql .= "'$adminPass';";
        $redirectURL = "admin_menu.html";
    }
    
    // run the query
    $result = mysqli_query($con, $sql) or die(mysqli_error());
    
    // get data as an associative array
    // assign the count of records to a variable
    if ($result) {
//        print_r ($result);
        while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
            $recCount = $row['numRecs'];
//            print "LoL";
//            print $row['lastName'];
            $_SESSION["userID"] = $row['userID'];
            $_SESSION["adminFName"] = $row['firstName'];
            $_SESSION['adminLName'] = $row['lastName'];
            $_SESSION['adminAuthLevel'] = $row['adminLevel'];
            $_SESSION['loggedIn'] = true;
//            print $recCount;
        }
    }
    
    // test number of records returned. value of 0 means no record found
    // set error message for log in page. 
    if ($recCount == 0)  {
        $_SESSION['loginWarn'] = "Log in failed; invalid userID or password";
        $_SESSION['logOnAttempt'] +=1;
        $_SESSION['loggedIn'] = false;
        $redirectURL = "admin_login.php";
    } 
    // user record was found
    // set session variables

//        $_SESSION['userID'] = $row["userID"];
//        $_SESSION['adminFName'] = $row['firstName'];
//        $_SESSION['adminLName'] = $row['lastName'];
//        $_SESSION['adminAuthLevel'] = $row['adminLevel'];
//        $_SESSION['loggedIn'] = true;
//        if($result) {
          
//            while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
//                
//                
//            }
            

//        }
    
    
       // info captured, move user to next page
    header('Location: '. $redirectURL); 
    
}


//[optional] records log ins to the audit table
//sets up authorization to use the administrative side of Pizza Parlor Deluxe
//redirects the user to different locations within the administrative side or the original login page

?>