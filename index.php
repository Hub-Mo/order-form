<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}


// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Pizza', 'price' => 10.50],
    ['name' => 'calzone', 'price' => 10],
    ['name' => 'pasta', 'price' => 11],
    ['name' => 'risotto', 'price' => 9]
];

// form variables ///
function deliveryInfo() {
    if ($_POST){
        $email = $_POST['email'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $streetnumber = $_POST['streetnumber'];
        $zipcode = $_POST['zipcode'];
    
        echo "<li> E-mail: ". $email. "</li>";
        echo "<li> Street: ". $street. " " .$streetnumber. "</li>";
        echo "<li> City: ". $city ."</li>";
        echo "<li> Zipcode: ". $zipcode."</li>";
    }else {
        return "";
    }

}

// incrementing prices
// function showPrice(){
//     $price = 0;
//     global $products;
//     if(isset($magic)){

//         for ($i = 0; $i < count($magic); $i++){
//             $price = $price + $products[$magic[$i]]['price'];
//     }
//     return $price;
// } 
// }
function validate()
{
    // TODO: This function will send a list of invalid fields back
    $error = [];

    if (empty($_POST['email'])){ $error['email'] = "enter your Email adress";};
    if (empty($_POST['street'])){ $error['street'] = "enter your street ";};
    if (empty($_POST['streetnumber'])){ $error['streetnumber'] = "enter your street number ";};
    if (empty($_POST['city'])){ $error['city'] = "enter your city ";};
    if (empty($_POST['zipcode'])){ $error['zipcode'] = "enter your zipcode ";};
    if (empty($_POST['products'])){ $error['products'] = "choose atleast one product";};

    if (!empty($error)){
        return $error;
    }
    
}
function handleForm()
{
    $chosen = [];
    $invalidFields = validate();
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        echo "<div class='alert alert-warning'> enter a valid email </div>";
    }
    if (!ctype_digit($_POST['zipcode'])){
        echo "<div class='alert alert-warning'> enter a valid zipcode </div>";
    }
    if (!ctype_digit($_POST['streetnumber'])){
        echo "<div class='alert alert-warning'> enter a valid zipcode </div>";
    }
    if (!isset($_POST['products'])) {
        echo "<div class='alert alert-danger'> choose atleast one item</div>";
    }


    if (!empty($invalifFields)){
        // TODO: handle errors
        foreach($invalidFields as $index=>$invalidFields){
            echo "<div class='alert alert-warning'".$invalidFields."</div>";
        }
    }
    else{
        $food = [];

        if(!isset($_POST['products'])){
            return $food;
        }else{
            $food = $_POST['products'];
                foreach($food as $item){
                array_push($chosen, $item);
            }
            $index = array_map('intval', $chosen);
            return $index;
        }
    }

    
};


// TODO: replace this if by an actual check
if (isset($_POST['submit'])){
        $magic = handleForm();
}



require 'form-view.php';