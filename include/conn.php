<?php
    $DB_HOST = "127.0.0.1";
    $DB_USER = "admin";
    $DB_PASSWORD = "1234";
    $DB_NAME = "20191212";

    // 物件導向方式連接
    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    $mysqli -> query("SET NAMES UTF8");
?>