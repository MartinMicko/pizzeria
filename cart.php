<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // display errors
session_start();
require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');


$products = Db::queryAll("SELECT id, name, image, cost from products");

if (isset($_POST["add"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'             =>     $_POST["hidden_name"],
                'item_price'            =>     $_POST["hidden_price"],
                'item_img'              =>     $_POST["hidden_img"],
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'             =>     $_POST["hidden_name"],
            'item_price'            =>     $_POST["hidden_price"],
            'item_img'              =>     $_POST["hidden_img"],
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                // echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
}


if (isset($_POST['order'])) {
    $name = $_POST['name'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $status = "Unconfirmed";
    $payment = "workinglol";


    if (!empty($email) || !empty($status) || !empty($name) || !empty($telefon) || !empty($_POST['items'])) {
        $lastID = Db::insert_lastID("INSERT INTO orders (Name, Price, mobile, email,payment, status) VALUES ('$name',0,  '$telefon', '$email','$payment', '$status')");
    } else {
        echo "All fields must be field out";
        die();
    }

    if (!empty($_POST['items'])) {
        foreach ($_POST['items'] as $item_id => $item) {
            $count = $item['count'];
            foreach($products as $key => $x){
                if($x["id"]== $item_id){
                    $price = $x["cost"];
                    break;
                }
            }
             
            $total = $total + $count* $price;
            Db::query("INSERT INTO orders_list (order_id, product_id, qty) VALUES ('$lastID', '$item_id', '$count' )");

        }
        Db::update("orders", array(
            'Price'               =>     $total), "WHERE order_id =".$lastID);
        $_SESSION["tracking_number"] = $lastID;
        $_SESSION["total"] = $total;
        
    }
    

    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        unset($_SESSION["shopping_cart"][$keys]);
        // echo '<script>alert("Item Removed")</script>';
        echo '<script>window.location="Cart.php"</script>';
    }

    header("Location: payment.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "./includes/head.php" ?>
</head>

<body>
    <div class="header">
        <div class="container">
            <?php require_once "./includes/header.php" ?>
        </div>
    </div>

    <!--cart items details-->
    <div class="small-container cart-page">
    
        <form action="cart.php?action=order" method="POST">
            <table class="table table-bordered tabulka">
                <tr class="">
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Delete</th>
                </tr>
                <?php
                if (!empty($_SESSION["shopping_cart"])) { 
                    $total = 0;
                    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                ?>
                        <tr class="cartRowsHolder">
                            <td class="cartRow"> <img src="<?php echo $values["item_img"]; ?>" alt=""> </td>
                            <td class="cartRow"><?php echo $values["item_name"] ?></td>                
                            <td  class="price" ><?php echo $values["item_price"]; ?>€</td>
                            <td class="cartRow"><input type="number" class="inputNumber" name="items[<?= $values["item_id"] ?>][count]" default="1" value="1"></td>
                            <td class="cartRow"><a class="delButton" href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Delete item</span></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <!-- <td>$<?php echo number_format($total, 2); ?></td> -->
                        <td class=""></td>
                        <td></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        
            <article class="cartArticle2">
                <h1>PICK UP DETAILS</h1>

                <div class="inputHolder">
                    <input type="text" name="name" require placeholder="Name" class="inputBox">
                    <input type="text" name="telefon" require placeholder="Phone number" class="inputBox">
                    <input type="text" name="email" require placeholder="E-mail" class="inputBox">        
                </div>
                <button type="submit" class="btnn" name="order" class="Order">Order</button>
                
                
                

            </article>
            
        </form>
        <h2><a href="products.php"> <- BACK TO MENU</a></h2>

    </div>

    <?php require_once "./includes/footer.php" ?>
</body>
<!-- Toggle menu -->
<script src="js/toggleMenu.js"></script>
<!-- Swiper -->
<script src=" https://cdn.jsdelivr.net/npm/swiper@9.0.1/swiper-bundle.min.js "></script>
<script src="js/slider.js"></script>
<script src="js/cart.js"></script>

</html>