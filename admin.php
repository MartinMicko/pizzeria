<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // vypísanie chyb

require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');

if (isset($_POST['sendPRODUCTS'])) {

    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $type_id = $_POST['type_id'];

    if (!empty($name) || !empty($image) || !empty($price) || !empty($description) || !empty($category_id) || !empty($type_id)) {
        Db::query("INSERT INTO `products` (name, image, cost , description , category_id, type_id) VALUES ('$name', '$image', '$price', '$description', '$category_id', '$type_id')");
    } else {
        echo "All fields must be field out";
        die();
    }
}

if (isset($_POST['sendNEWS'])) {

    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];

    if (!empty($name) || !empty($image) || !empty($price)) {
        Db::query("INSERT INTO `products` (name, image, cost) VALUES ('$name', '$image', '$price')");
    } else {
        echo "All fields must be field out";
        die();
    }
}

if (isset($_POST['sendFAQ'])) {

    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if (!empty($question) || !empty($answer)) {
        Db::query("INSERT INTO `faq` (questions, answers) VALUES ('$question', '$answer')");
    } else {
        echo "All fields must be field out";
        die();
    }
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
    <div class="adminTitle">
        <h1>Welcome to the admin page</h1>
    </div>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="swiper-wrapper">
                <!-- products form - hotovy -->
                <section class="adminForm swiper-slide">
                    <form class="admin-form" action="./admin.php" method="POST">
                        <div class="admin">
                            <div class="title">
                                <h1>Products form</h1>
                            </div>

                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Input name of product">

                            <label for="subject">Image</label>
                            <input type="text" name="image" id="image" placeholder="Input pic of product">

                            <label for="message">Price</label>
                            <input type="text" name="price" id="price" placeholder="Input price of product">

                            <label for="message">Description</label>
                            <input type="text" name="description" id="description" placeholder="Input description of product">

                            <label for="message">Category</label>
                            <select id="type_id" name="category_id">
                                <option id="doption" default selected disabled>Input category of product</option>
                                <option value="1">Pizza</option>
                                <option value="2">Sauces</option>
                                <option value="3">Drinks</option>
                                <option value="4">Deserts</option>


                            </select>


                            <label for="message">Color</label>

                            <select id="type_id" name="type_id">
                                <option id="doption" default selected disabled>Input type of product</option>
                                <option value="1">Vegan</option>
                                <option value="2">Spicy</option>
                                <option value="3">Favourite</option>
                                <option value="4">Specials</option>
                            </select>

                            <button id="btn" type="submit" name="sendPRODUCTS">Submit</button>
                        </div>
                    </form>
                </section>
                <!-- news form - treba upraviť -->
                <section class="adminForm swiper-slide">
                    <form class="admin-form" action="./admin.php" method="POST">
                        <div class="admin">
                            <div class="title">
                                <h1>News form</h1>
                            </div>

                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Zadaj názov produktu">

                            <label for="subject">Image</label>
                            <input type="text" name="image" id="image" placeholder="Zadaj obrázok produktu">

                            <label for="message">Price</label>
                            <input type="text" name="price" id="price" placeholder="Zadaj cenu produktu">

                            <button id="btn" type="submit" name="sendNEWS">Submit</button>
                        </div>
                    </form>
                </section>
                <!-- faq form - treba upraviť -->
                <section class="adminForm swiper-slide">
                    <form class="admin-form" action="./admin.php" method="POST">
                        <div class="admin">
                            <div class="title">
                                <h1>FAQ form</h1>
                            </div>

                            <label for="name">Question</label>
                            <input type="text" name="question" placeholder="Zadaj otázku">

                            <label for="subject">Answer</label>
                            <input type="text" name="answer" placeholder="Zadaj odpoveď">

                            <button id="btn" type="submit" name="sendFAQ">Submit</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    </div>

    <?php require_once "./includes/footer.php" ?>
</body>
<!-- Toggle menu -->
<script src="js/toggleMenu.js"></script>
<!-- Swiper -->
<script src=" https://cdn.jsdelivr.net/npm/swiper@9.0.1/swiper-bundle.min.js "></script>
<script src="js/sliderAdmin.js"></script>

</html>