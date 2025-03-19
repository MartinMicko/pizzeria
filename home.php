<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // error display

require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');
if (isset($_POST['sendRATING'])) {

    $nick = $_POST['nick'];
    $text = $_POST['text'];

    if (!empty($nick) || !empty($text)) {
        Db::query("INSERT INTO `rating` (nick, text) VALUES ('$nick', '$text')");
    } else {
        echo "All fields must be field out";
        die();
    }
}

$products = Db::queryAll("SELECT id, name, image, cost, description from products where id =1 or id =2 or id =3");
$ratings = Db::queryAll("SELECT id, nick, text from rating");




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
            <div class="row">
                <div class="col-2">
                    <h1>Mario & Luigi pizza</h1>
                    <p>Place where every slice is a slice of Italy!</p>
                    <a href="products.php" class="btn">Check our menu! &#10144;</a>
                </div>
                <div class="col-2">
                    <img id="overallphoto" src="img/overall.jpeg" alt="">
                </div>
            </div>
        </div>
    </div>

    <!--recomended products-->
    <div class="small-container">
        <h2 class="title">Popular Products</h2>
        <section class="row">
            <div class="products">
                <?php foreach ($products as $product) : ?>
                    <div class="product" data-product="<?= $product['id'] ?>" method="POST">
                        <img class="product-img" src="<?= $product['image'] ?>">
                        <p class="product-title"><?= $product['name'] ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
        
    </div>

    <!--Offers-->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="./img/pizza1.png" class="offer-img">
                </div>
                <div class="col-2">
                    
                    <h1>Pizza Margherita</h1>
                    <p>Greatest Mergherita in whole country made with <b id="love">LOVE</b> </p>
                    <a class="btn" href="products.php">ORDER NOW! &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!--reviews-->
    <h2 class="title">Reviews</h2>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <?php foreach ($ratings as $rating) : ?>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>

                            <div class="card-image">
                                <img src="./img/anonym.png" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="nick-rating"><?= $rating['nick'] ?></h2>
                            <p class="description"><?= $rating['text'] ?></p>


                        </div>
                    </div>

                <?php endforeach ?>
                
                <div class="card swiper-slide">
                    <div class="image-content">
                        <span class="overlay"></span>

                        <div class="card-image">
                            <img src="./img/anonym.png" class="card-img">
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <form action="" method="POST" >
                            <label for="subject">Name</label>
                            <h2 class="nick-rating"> <input name="nick" id="nictext" type="text"></h2>
                            <label for="subject">Review</label>
                            <p class="description"><input name="text" id="rectext" type="text"></p>
                            <button class="btnrec" type="submit" name="sendRATING">Submit</button>
                        </form>

                    </div>
                    
                </div>
                


            </div>

        </div>
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    </div>

    <!--brands-->




<?php require_once "./includes/footer.php" ?>
</body>
<!-- Toggle menu -->
<script src="js/toggleMenu.js"></script>
<!-- Swiper -->
<script src=" https://cdn.jsdelivr.net/npm/swiper@9.0.1/swiper-bundle.min.js "></script>
<script src="js/slider.js"></script>

</html>