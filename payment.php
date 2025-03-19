<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // error display
session_start();
require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');






if (isset($_GET["action"])) {
    if ($_GET["action"] == "pay_online") {
        Db::update("orders", array(
            'payment'               =>     "pay_online"), "WHERE order_id =".$_SESSION["tracking_number"]);
            header("Location: tracking.php");
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "pay_on_spot") {
        Db::update("orders", array(
            'payment'               =>     "pay_on_spot"), "WHERE order_id =".$_SESSION["tracking_number"]);
            header("Location: tracking.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payment.css">
    <title>Document</title>
</head>
<body>
    <div class="container p-0">
        <div class="card px-4">
            <p class="h8 py-3">Payment Details</p>
            <p class="h8 py-3">Total: <?php echo $_SESSION["total"]?>€</p>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Person Name</p>
                        <input class="form-control mb-3" type="text" placeholder="Name" value="Barry Allen">
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Card Number</p>
                        <input class="form-control mb-3" type="text" placeholder="1234 5678 435678">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Expiry</p>
                        <input class="form-control mb-3" type="text" placeholder="MM/YYYY">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">CVV/CVC</p>
                        <input class="form-control mb-3 pt-2 " type="password" placeholder="***">
                    </div>
                </div>
                <div class="col-12">
                    <div class="btn btn-primary mb-3">
                        <a href="payment.php?action=pay_online"><span class="ps-3">PAY ONLINE</span></a>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                    <div class="btn btn-primary mb-3">
                        <a href="payment.php?action=pay_on_spot"><span class="ps-3">PAY CASH ON SPOT</span></a>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
