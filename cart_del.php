<?php

session_start();
include 'server.php';


    if(!empty($_GET['id'])){
        unset($_SESSION['cart'][$_GET['id']]);
    }


header('location:cart.php');