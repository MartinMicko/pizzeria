<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // error display
session_start();
require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');

$productsR = Db::queryAll("SELECT id, name, image, cost, description from products where id =1 or id =2 or id =3");

if (isset($_GET['product'])) {
    $productid = $_GET['product'];
    $product = Db::queryOne("SELECT id, name, image, cost, description from products WHERE id = ${productid};");
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
    <!--Single products details-->

    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                

                <img id="ProductImg" src="<?= $product['image'] ?>">

            </div>

            <div class="col-2">
                <form method="post" action="cart.php?action=add&id=<?php echo $product["id"]; ?>">

                    <h2><?= $product['name'] ?></h2>
                    <h4>Price: <?= $product['cost'] ?>€</h4>
                   
                    
                    
                    
                    <input class="btn" type=submit name=add value="Add to cart">
                    <h3>Product details <i class="fa fa-indent"></i></h3>
                    <br>
                    <p><?= $product['description'] ?></p>

                    <input type="hidden" name="hidden_name" value=" <?= $product['name'] ?>" />
                    <input type="hidden" name="hidden_price" value=" <?= $product['cost'] ?>" />
                    <input type="hidden" name="hidden_img" value="<?= $product['image'] ?>" />
                </form>
                

            </div>
        </div>
    </div>

    <div class="small-container">
        <h2 class="title">Favourite pizzas</h2>
        <section class="row">
            <div class="products">
                <?php foreach ($productsR as $product) : ?>
                    <div class="product" data-product="<?= $product['id'] ?>" method="POST">
                        <img class="product-img" src="<?= $product['image'] ?>">
                        <p class="product-title"><?= $product['name'] ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
        
    </div>

    <?php require_once "./includes/footer.php" ?>

</body>
<!-- Toggle menu -->
<script src="js/toggleMenu.js"></script>
<!-- Swiper -->
<script src=" https://cdn.jsdelivr.net/npm/swiper@9.0.1/swiper-bundle.min.js "></script>
<script src="js/slider.js"></script>
<!--Product gallery-->
<script src="js/productGallery.js"></script>
<script src="js/cart.js"></script>

</html>