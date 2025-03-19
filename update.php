<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // error display
session_start();
require './db/Db.php';

Db::connect('studmysql01.fhict.local', 'dbi525769', 'dbi525769', '1234');


if (isset($_GET["action"])) {
    if ($_GET["action"]= "update"){
    Db::update("orders", array(
        'status'               =>     "Ready"), "WHERE status = 'cooking'");
}
}



?>