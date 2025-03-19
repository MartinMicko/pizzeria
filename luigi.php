<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // display error
session_start();
require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');


if (isset($_POST["action"])) {
    if ($_POST["action"]= "update"){
    Db::update("orders", array(
        'status'               =>     $_POST["change_status"]), "WHERE order_id =".$_POST["order_id"]);

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

            <table class="table table-bordered tabulka">
                <tr class="">
                    <th>Order number</th>
                    <th>Name</th>

                    <th>Amount</th>
                    <th>Status</th>
                    <th>Change status</th>
                </tr>
                <?php
                $order_id_status = Db::queryAll('SELECT order_id, status FROM orders WHERE status != "delivered" && status !="Unconfirmed" && status !="Ready"');
                foreach ($order_id_status as $keys1 => $values1) {
                    $tracking = Db::queryAll('SELECT product_id, qty FROM orders_list WHERE order_id = ' . $values1["order_id"]);


                    foreach ($tracking as $keys => $values) {
                        $product = Db::queryOne('SELECT name, image, cost from products WHERE id = ' . $values["product_id"]); ?>

                        <tr class="cartRowsHolder">

                            <td class="cartRow"><?php echo $values1["order_id"]; ?></td>
                            <td class="cartRow"><?php echo $product["name"]; ?></td>
                            <td class="cartRow"><?php echo $values["qty"]; ?></td>
                            <td class="cartRow"><?php echo $values1["status"]; ?></td>

                            <td class="cartRow">
                            <form method="POST" action="luigi.php?action=add">
                                <select name="change_status" id="change">
                                <option value="Cooking">Cooking</option>
                                <option value="Ready">Ready</option>
                                </select>
                                <input type="submit" value="Submit" name=action value="update">
                                <input type="hidden" name="order_id" value=" <?= $values1['order_id'] ?>" />
                            </form>
                            </td>

                        </tr>

                <?php
                    }
                }
                ?>

            </table>




        </div>
    </div>



    <?php require_once "./includes/footer.php" ?>

</body>