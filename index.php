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
function showPrice(){
    $price = 0;
    global $products;
    for ($i = 0; $i < count(handleForm()); $i++){
        $price = $price + $products[handleForm()[$i]]['price'];
} 
return $price;
}
function validate()
{
    // TODO: This function will send a list of invalid fields back
    return [];
}
function handleForm()
{

    $chosen = [];
    if (!$_POST){
        // TODO: handle errors
        return [];
    }
    else{
        foreach($_POST['products'] as $item){
            array_push($chosen, $item);
        }
        $index = array_map('intval', $chosen);
        return $index;
    }

        // Validation (step 2)
        // $invalidFields = validate();
            // if (!$_POST) {

            //     echo 'input fields are empty';
            //     return [];
            // } else {
            //     return $index;
            // }
        };


// TODO: replace this if by an actual check
if (isset($_POST["submit"])){
        handleForm();
}


require 'form-view.php';