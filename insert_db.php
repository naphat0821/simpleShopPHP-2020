<?php
session_start();
include ('server.php');

$product_name = $_POST['product_name'];
$price = $_POST['price'];
$detail = $_POST['detail'];
$image_name = $_FILES['product-image']['name'];

$image_tmp = $_FILES['product-image']['tmp_name'];
$folder ='upload_image/';
$image_location =$folder . $image_name;

$query =mysqli_query($conn,"INSERT INTO products (product_name,price,profile_image,detail) VALUES('{$product_name}','{$price}','{$image_name}','{$detail}')") or die('query failed');

if($query){
    move_uploaded_file($image_tmp, $image_location);
    $_SESSION['add'] = "add product success";
     header("location: index.php");
} else {
    echo 'add product failed!!';
}
