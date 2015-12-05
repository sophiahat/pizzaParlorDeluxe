
//Name : Order processing form 
//Description: validates and gathers information for a pizza order
//Author : Chris Spencer
//Created : October 2015

//global variables

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
        ["meatlover", "Meat Lover's", ["Pepporoni","Sausage", "Ham"], 3.75],
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

function Pizza(size, crust, type, price, toppings) {
    this.size = size;
    this.crust = crust;
    this.type = type;
    this.price = price;
    this.toppings = toppings;
    this.tax = (this.price * .09).toFixed(2);
    this.total = (Number(this.price) + Number(this.tax)).toFixed(2);
}

 var pizza_order;

function orderUpdate(form) {
    var price = 0;
    var pizza_size = form.pizza_size.value;
    var pizza_crust = form.crust_type.value;
    var pizza_type = form.pizza_type.value;
    var pizza_toppings = [];
    var tax, total;
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
            pizza_type = pizzaTypes[i][1];
            for(j = 0; j < pizzaTypes[i][2].length; j++){
                pizza_toppings.push(pizzaTypes[i][2][j]);
            }
            break;
        }
    }
    toppingsToggle(form);   
}

function submitPizzaOrder();
   pizza_order = new Pizza(pizza_size, pizza_crust, pizza_type, price, pizza_toppings, tax, total);
        alert(pizza_order.size +'" '+ pizza_order.crust +" "+ pizza_order.type +" "+ pizza_order.price +" "+ pizza_order.toppings +" "+ pizza_order.tax +" "+ pizza_order.total);
function submitDelivery(form) {
    
}

function toppingsToggle(form) {
    if(form.build.checked) {
        document.getElementById("toppings").style.display = "block";   
    }else{
        document.getElementById("toppings").style.display = "none";
    }
}
    