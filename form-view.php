<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Your fancy store</title>
</head>
<body>
<div class="container">
<div class=" float-end">
        <button type="button" id="newOrder"><a href="<?php $_SERVER['PHP_SELF']; ?>">New Order</a></button>
    </div>
    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <?php /*
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    */ ?>
    <form method="post" action="index.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" />
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" >
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="number" id="streetnumber" name="streetnumber" class="form-control" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" >
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="number" id="zipcode" name="zipcode" class="form-control" >
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value="<?php echo $i?>" name="products[<?php echo $i ?>]" price="<?php $product['price'] ?>"/> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>
    <?php if(isset($magic)){
        echo "<div class='alert alert-success'> your order has been received </div>";
    } ?>
    <h1 class="text-center">Order Informarion</h1>
    <div class="container d-flex justify-content-around">
        <div id="deliveryAdresInfo">
        <h3>delivery adres:</h3>
            <ul>
                <?php
                    echo deliveryInfo();
                ?>
            </ul>
        </div>
        <div id="orderInformation">
            <h3>order</h5>
            <ul>
                <?php 
                if(isset($magic)){
                    for ($i = 0; $i < count($magic); $i++){
                        echo "<li>".$products[$magic[$i]]['name']. " - €".$products[$magic[$i]]['price']."</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <footer>You already ordered <strong>&euro; 
        <?php 
            $price = 0;
            if(isset($magic)){
                for ($i = 0; $i < count($magic); $i++){
                    $price = $price + $products[$magic[$i]]['price'];
            }
            echo $price;
        }
        ?>
        </strong> in food and drinks.</footer>
</div>


<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>