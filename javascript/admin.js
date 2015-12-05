/* -------------------------------------------
function: chkForm(formNum)
purpose:  to check that minimum form requirements have been meant
author:    mbaker
date:      1-2-2015
paramters: formNum as an integer, representing the index of the form in the form array
---------------------------------------------*/
function chkForm(formNum) {
    // capture the number of elements in the form
    var intElements = document.forms[formNum].elements.length;
    
    // global variables for password field
    var strBadPass = false;
    
    // loop through the elements to verify information 
    for (var i = 0; i < intElements; i++){
        // check to see that all required fields are filed in, a blank field sets a warning and returns false to prevent processing to the next page
        if (document.forms[formNum].elements[i].value == ""){
            document.getElementById("loginWarn").innerHTML = "All fields are required.";
            document.forms[formNum].elements[i].focus();
            return false;
        }
        
        // password must include numbers, upper case letters, lower case letters, and a special character
        // check password requirements
        if (document.forms[formNum].elements[i].name == "pswWord"){
            // capture the value typed into the password input field
            var strPass = document.forms[formNum].elements[i].value;
            
            // Use a regular expression (re) to test for:
            // numbers (?=.*\d)
            // lower case letters (?=.*[a-z])
            // upper case letters (?=.*[A-Z])
            // special characters (?=.*[!@#$%&*()])
            // must be at least 8 characters {8,}
            re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{8,}/; 
            if(!re.test(strPass)) { 
                strBadPass = true;
            }
        }
                if (document.forms[formNum].elements[i].name == "pswConf"){
            if (document.forms[formNum].pswConf.value != document.forms[formNum].pswPass.value){
                document.getElementById("loginWarn").innerHTML = "Passwords do not match.";
                document.forms[formNum].pswConf.value == "";
                document.forms[formNum].pswPass.value == "";
                document.forms[formNum].pswPass.focus();
                
                return false;
            }
        }
    }
    
    if (strBadPass){
        document.getElementById("loginWarn").innerHTML = "Your password does not meet minimum requirements.";
        document.forms[formNum].pswWord.value = "";
        document.forms[formNum].pswWord.focus();
        return false;
    }
    
    // used for testing
//    alert("completed");
//    return false;
    
     return true;
}

function clrErr(fieldName) {
    // clear the warning from the web page
    document.getElementById(fieldName).innerHTML = "";
    
    // return true to acknowledge that the function is complete
    return true;
}