<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // error display

require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');

$category = Db::queryAll("SELECT id, category from category");
$type = Db::queryAll("SELECT id, type from types");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (is_int($page) || $page != 1) {
        $offset = ($page - 1) * 12;
        $products = Db::queryAll("SELECT * FROM `products` limit 12 OFFSET ${offset};");
    } else {
        header("Location: /products.php");
    }
} else {
    $products = Db::queryAll("SELECT * FROM `products` limit 12;");
}

$count = Db::query("SELECT * FROM `products`");
if ($count % 12 == 0) {
    $count = $count / 12;
} else {
    $count = ($count / 12) + 1;
}

if (isset($_GET['category']) || isset($_GET['type'])) {
    switch ($_GET) {
        case !empty($_GET['category']):
            $category = $_GET['category'];
            $products = Db::queryAll("SELECT products.id, products.name, image, cost, description, category.category, type from products left join category on category.id = products.category_id left join types on types.id = products.type_id WHERE `category_id` = '${category}'");
            break;

        case !empty($_GET['type']):
            $type = $_GET['type'];
            $products = Db::queryAll("SELECT products.id, products.name, image, cost, description, category.category, type from products left join category on category.id = products.category_id left join types on types.id = products.type_id WHERE `type_id` = '${type}'");
            break;
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

    <!--recommended products-->
    <div class="small-container">
        <h2>MENU</h2>
        <div class="row row-2">
            
            <form action="">
                <select name="category" onchange="this.form.submit()">
                    <option default selected disabled>CATEGORY</option>
                    <?php foreach ($category as $item) : ?>
                        <option value="<?= $item['id'] ?>"><?= $item['category'] ?></option>
                    <?php endforeach ?>
                </select>
            </form>

            <form action="">
                <select name="type" onchange="this.form.submit()">
                    <option default selected disabled>TYPE</option>
                    <?php foreach ($type as $item) : ?>
                        <option value="<?= $item['id'] ?>"><?= $item['type'] ?></option>
                    <?php endforeach ?>
                </select>
            </form>

            
        </div>
        <section class="row">
            <div class="products">
                <?php foreach ($products as $product) : ?>
                    <div class="product" data-product="<?= $product['id'] ?>" method="POST">
                        <img class="product-img" src="<?= $product['image'] ?>">
                        <p class="product-title"><?= $product['name'] ?></p>
                        <p class="product-title"><?= $product['cost'] ?> €</p>
                    </div>
                <?php endforeach ?>
            </div>
        </section>



        <section class="page-btn">
            <?php for ($i = 1; $i <= $count; $i++) : ?>
                <a href="products.php?page=<?= $i ?>"><span><?= $i ?></span></a>
            <?php endfor; ?>
        </section>

    </div>

    <?php require_once "./includes/footer.php" ?>

</body>
<!-- Toggle menu -->
<script src="js/toggleMenu.js"></script>
<!-- Swiper -->
<script src=" https://cdn.jsdelivr.net/npm/swiper@9.0.1/swiper-bundle.min.js "></script>
<script src="js/slider.js"></script>

</html>