<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // display errors

require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');

$products = Db::queryAll("SELECT id, name, image, cost from products");

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

    <div class="about-section">
        <div class="inner-container">
            <h1>About us</h1>
            <p class="text">
                Welcome to Mario & Luigi pizzeria, where the art of pizza-making meets the heart of Italy.

                At Mario & Luigi pizzeria, we are passionate about crafting authentic Italian pizzas that transport your taste buds straight to the streets of Naples.

                Our pizzeria is a family-owned and operated establishment, and our commitment to quality and tradition runs deep. We use only the finest, freshest ingredients, from the ripest tomatoes for our sauce to the creamiest mozzarella cheese, to create the perfect pizza every time. Our dough is made fresh daily, ensuring that each bite is a symphony of flavors and textures.
            </p>
            <div class="skills">
                <span>Quality</span>
                <span>Freshness</span>
                <span>Flavour</span>
            </div>
        </div>
    </div>
    <?php require_once "./includes/footer.php" ?>
    <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            } else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>

<script src="js/toggleMenu.js"></script>

</body>