
//Name : Order processing form 
//Description: validates and gathers information for a pizza order
//Author : Chris Spencer
//Created : October 2015




//options arrays

var pizzaSizes = [
        ["12", "12 inch", 10],
        ["16", "16 inch", 13],
        ["20", "20 inch", 17]  
    ]
var pizzaCrusts = [
        ["deep_dish", "Deep Dish", 1.3],
        ["thin_crust", "Thin Crust", 1]
    ]
var pizzaTypes = [
        ["hawaiian", "Hawaiian", ["Pineapple","Canadian Bacon"], 2.5],
        ["meatlover", "Meat Lover's", ["Pepperoni","Sausage", "Ham"], 3.75],
        ["veggie", "Veggie", ["Onions","Green Peppers","Cauliflower"], 1.75],
        ["build", "Build Your Own", [], 0]
    ]
var toppings = [
        ["pepperoni", "Pepperoni", 1.50],
        ["onions", "Onions", .75],
        ["extra_cheese", "Extra Cheese", 1.00],
        ["olives", "Olives", 1.20],
        ["green_peppers", "Green Peppers", .95],
        ["sundried_tomatoes", "Sundried Tomatoes", 1.05]
    ]

//more global variables
    var pizza_order;
    var pizza_size = pizzaSizes[0][1];
    var pizza_crust = pizzaCrusts[0][1];
    var pizza_type = pizzaTypes[1][1];
    var price = ((pizzaSizes[0][2] * pizzaCrusts[0][2]) + pizzaTypes[1][3]).toFixed(2);
    var pizza_toppings = pizzaTypes[1][2];
    var extraToppings = [];
    var tax = calculateTax();
    var total = calculateTotal();
    var extraToppingsPrice = 0;

//pizza object
function Pizza(size, crust, type, price, toppings) {
    this.size = size;
    this.crust = crust;
    this.type = type;
    this.price = price;
    this.toppings = toppings;
    this.tax = (this.price * .09).toFixed(2);
    this.total = (Number(this.price) + Number(this.tax)).toFixed(2);
}


// math calculations for Tax and totals
function calculateTax() {
    var tax = (price * .09).toFixed(2);
    return tax;
}

function calculateTotal() {
    var total = (Number(price) + Number(tax)).toFixed(2);
    return total;
}


// order update, onclick handler for all pizza options
function orderUpdate(form) {
    extraToppings = [];
    price = 0;
    pizza_size = form.pizza_size.value;
    pizza_crust = form.crust_type.value;
    pizza_type = form.pizza_type.value;
    pizza_toppings = [];
    custom_toppings = document.getElementsByClassName("ptoppings");
    extraToppingsPrice = 0;
    for(i = 0; i < custom_toppings.length; i++) {
        if(custom_toppings[i].checked) {
            extraToppings.push(toppings[i][1]);
            extraToppingsPrice += toppings[i][2];    
        }
    }
    toppingsToggle(form);
    
    for(i = 0; i < pizzaSizes.length; i++){
        if(pizza_size == pizzaSizes[i][0]){
            price += pizzaSizes[i][2];
            pizza_size = pizzaSizes[i][1];
            break;
        }
    }
    
    for(i = 0; i < pizzaCrusts.length; i++){
        if(pizza_crust == pizzaCrusts[i][0]){
            price *= pizzaCrusts[i][2];
            pizza_crust = pizzaCrusts[i][1];
            break;
        }
    }
    
    for(i = 0; i < pizzaTypes.length; i++){
        if(pizza_type == pizzaTypes[i][0]){
            price += pizzaTypes[i][3];
            price = price.toFixed(2);
            pizza_type = pizzaTypes[i][1];
            for(j = 0; j < pizzaTypes[i][2].length; j++){
                pizza_toppings.push(pizzaTypes[i][2][j]);
            }
            break;
        }
    }
    tax = calculateTax();
    total = calculateTotal();
    updateOrderHtml();
        
}

// submit for Pizza info
function submitPizza(){
      
    
    setCookie("pizza_size", pizza_size, 2, "order_contact.html");
    setCookie("pizza_crust", pizza_crust, 2, "order_contact.html");
    setCookie("pizza_type", pizza_type, 2, "order_contact.html");
    setCookie("pizza_toppings", toppingsString, 2, "order_contact.html");
    setCookie("price", price, 2, "order_contact.html");
    setCookie("tax", tax, 2, "order_contact.html");
    setCookie("total", total, 2, "order_contact.html");
}

function loadDeliveryForm() {
    
    pizza_size = getCookie("pizza_size");
    pizza_crust = getCookie("pizza_crust");
    pizza_type = getCookie("pizza_type");
    pizza_toppings = getCookie("pizza_toppings");
    price = getCookie("price");
    tax = getCookie("tax");
    total = getCookie("total");
    document.getElementById("psize").innerHTML = pizza_size;
    document.getElementById("pcrust").innerHTML = pizza_crust;
    document.getElementById("ptype").innerHTML = pizza_type;   
    document.getElementById("ptoppings").innerHTML = pizza_toppings;
    document.getElementById("pprice").innerHTML = price;
    document.getElementById("ptax").innerHTML = tax;
    document.getElementById("ptotal").innerHTML = total;
    
}
function validateForm(form) {
    $('#delivery_form').validate({
        rules: {
            fname: {
                required: true,
                minlength: 2
            },
            lname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            address: {
                required: true,
                minlength: 4
            
            },
            city: {
                required: true,
                minlength: 2
            
            },
            state: {
                required: true,
                minlength: 2
            },
            zip: {
                required: true,
                minlength: 5,
                digits: true
            },
            phone: {
                required: true,
                phoneUS: true
            }
        },
        messages: {
            fname: {
                required: "This field is required",
                minlength:  "Minimum length is 2"
            },
            lname: {
                required: "This field is required",
                minlength:  "Minimum length is 2"
            },
            email: {
                required: "This field is required",
                email: "Must be a valid email"
            },
            address: {
                required: "This field is required",
                minlength:  "Minimum length is 4"
            
            },
            city: {
                required: "This field is required",
                minlength:  "Minimum length is 2"
            
            },
            state: {
                required: "This field is required",
                minlength: "Minimum length is 2"
            },
            zip: {
                required: "This field is required",
                minlength: "Minimum length is 5"
            },
            phone: {
                required: "This field is required",
                phone: "Please enter a valid phone number that contains digits only (XXXXXXXXXX)"
            }
        }
            
    });
    
    // get contact info 
    
    var fname = form.fname.value;
    var lname = form.lname.value;
    var email = form.email.value;
    var address = form.address.value;
    var apartment = form.apartment.value;
    var city = form.city.value;
    var state = form.state.value;
    var zip = form.zip.value;
    var phone = form.phone.value;
    
    // create cookies
    setCookie("fname", fname, 2, "order_summary.html");
    setCookie("lname", lname, 2, "order_summary.html");
    setCookie("email", email, 2, "order_summary.html");
    setCookie("address", address, 2, "order_summary.html");
    setCookie("apartment", apartment, 2, "order_summary.html");
    setCookie("city", city, 2, "order_summary.html");
    setCookie("state", state, 2, "order_summary.html");
    setCookie("zip", zip, 2, "order_summary.html");
    setCookie("phone", phone, 2, "order_summary.html");
    setCookie("pizza_size", pizza_size, 2, "order_summary.html");
    setCookie("pizza_crust", pizza_crust, 2, "order_summary.html");
    setCookie("pizza_type", pizza_type, 2, "order_summary.html");
    setCookie("pizza_toppings", toppingsString, 2, "order_summary.html");
    setCookie("price", price, 2, "order_summary.html");
    setCookie("tax", tax, 2, "order_summary.html");
    setCookie("total", total, 2, "order_summary.html");    
    
    
    
    
}

function updateOrderHtml() {
    document.getElementById("psize").innerHTML = pizza_size;
    document.getElementById("pcrust").innerHTML = pizza_crust;
    document.getElementById("ptype").innerHTML = pizza_type;
    toppingsString = "";
    for(i = 0; i < pizza_toppings.length; i++){
        toppingsString += pizza_toppings[i] + "<br>";
    }
    document.getElementById("ptoppings").innerHTML = toppingsString;
    document.getElementById("pprice").innerHTML = price;
    document.getElementById("ptax").innerHTML = tax;
    document.getElementById("ptotal").innerHTML = total;
}   

function toppingsToggle(form) {
    if(form.build.checked) {
        document.getElementById("toppings").style.display = "block";
        pizzaTypes[3][2] = extraToppings;
        price += extraToppingsPrice;
        
    }else{
        document.getElementById("toppings").style.display = "none";
        pizzaTypes[3][2] = [];
    }
}

function loadSummary() {
    var fname = getCookie("fname");
    var lname = getCookie("lname");
    var email = getCookie("email");
    var address = getCookie("address");
    var apartment = getCookie("apartment");
    var city = getCookie("city");
    var state = getCookie("state");
    var zip = getCookie("zip");
    var phone = getCookie("phone");
    var order_pizza_size = getCookie("pizza_size");
    var order_pizza_crust = getCookie("pizza_crust");
    var order_pizza_type = getCookie("pizza_type");
    var order_pizza_toppings = getCookie("pizza_toppings");
    var order_price = getCookie("price");
    var order_tax = getCookie("tax");
    var order_total = getCookie("total");
    
    
    document.getElementById("firstName").innerHTML = fname;
    document.getElementById("lastName").innerHTML = lname;
    document.getElementById("email").innerHTML = email;
    document.getElementById("address").innerHTML = address;
    if(apartment) document.getElementById("apartment").innerHTML = " Apt-" + apartment;   
    document.getElementById("city").innerHTML = city + ",";
    document.getElementById("state").innerHTML = state;
    document.getElementById("zip").innerHTML = zip;
    document.getElementById("phone").innerHTML = phone;

    document.getElementById("pprice").innerHTML = order_price;
    document.getElementById("ptax").innerHTML = order_tax;
    document.getElementById("ptotal").innerHTML = order_total;
    
    //get current time 
    var today = new Date();
    var  h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var pm = false;   // evening indicator
    timeString = "";
    duration = 60 * 30;
    
    // create delivery time (add 30 minutes)
    if(m > 30) {
        h++;
    }
    m = (m + 30) % 60;
    m = checkTime(m);
    s = checkTime(s);
    if(h > 12) {
        pm = true;
        h -= 12;
    }
    timeString = h + ":" + m + ":" + s;
    if (pm) { timeString += " PM";}
    document.getElementById("arrival").innerHTML = timeString;
    function Timer() {
        var s = duration % 60; 
        var m = Math.floor(duration / 60);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById("timer").innerHTML = m + ":" + s;
        duration--;
        var t = setTimeout(Timer, 1000);
    
    }
    function checkTime(i) {
        if(i < 10) {
            i = "0" + i;
        }
        return i;
    }
    Timer();
}
 
//Cookies create, get, check

function setCookie(cname, cvalue, exdays, path) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=" + path;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}