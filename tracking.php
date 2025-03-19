<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // error display
session_start();
require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');



if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (!empty($_POST["tracking_number"])) {
        $_SESSION["tracking_number"] = $_POST["tracking_number"];
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "./includes/head.php" ?>
    <meta http-equiv="refresh" content="10">
</head>


<body>

    <div class="header">
        <div class="container">
            <?php require_once "./includes/header.php" ?>
        </div>
    </div>

    <div class="small-container cart-page">
        <?php if (!empty($_SESSION["tracking_number"])) : ?>
            <table class="table table-bordered tabulka">
                <tr class="">
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
                <?php $quary = 'SELECT product_id, qty FROM orders_list WHERE order_id = ' . $_SESSION["tracking_number"];
                $tracking = Db::queryAll($quary);
                $status = Db::queryOne('SELECT status FROM orders WHERE order_id = ' . $_SESSION["tracking_number"]);

                foreach ($tracking as $keys => $values) {
                    $product = Db::queryOne('SELECT name, image, cost from products WHERE id = ' . $values["product_id"]); ?>

                    <tr class="cartRowsHolder">
                        <td class="cartRow"><?php echo $_SESSION["tracking_number"]; ?></td>
                        <td class="cartRow"> <img src="<?php echo $product["image"]; ?>" alt=""> </td>
                        <td class="cartRow"><?php echo $product["name"]; ?></td>
                        <td class="cartRow"><?php echo $status["status"]; ?></td>



                    </tr>

                <?php
                }
                ?>

            </table>
            <article class="cartArticle2">
                <form method="POST" action="tracking.php?action=add">


                    Change traking number: <input type="number" name="tracking_number"><br>
                    <button type="submit" class="btnn" name="add" class="add">Submit </button>
    </div>
    </div>
    </form>
    </article>
<?php else : ?>
    <form class="inputHolder" method="POST" action="tracking.php?action=add">
        <div class="row">


            Traking number: <input type="number" name="tracking_number"><br>

        </div>
        <button type="submit" class="btnn" name="add" class="add">Submit </button>
    </form>
<?php endif; ?>
</div>










<?php require_once "./includes/footer.php" ?>
<script src="js/toggleMenu.js"></script>
</body>
</html>