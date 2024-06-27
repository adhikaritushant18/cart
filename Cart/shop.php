<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="cart";

$conn= mysqli_connect($servername,$username,$password,$dbname); 

if(!$conn){
    echo "Failed to connect"; 
}
if(isset($_POST["add"])){
    $productName=$_POST["hidden_name"];
    $productImage=$_POST["hidden_image"];
    $productPrice=$_POST["hidden_price"];
    $productQuantity=$_POST["quantity"];

    $sql="INSERT INTO `product-2` ( `description`, `img`, `price`, `quantity`) VALUES ( '$productName', '$productImage', '$productPrice', '$productQuantity');";
    mysqli_query($conn,$sql);
}
function addToWishlist($conn, $productName, $productImage, $productPrice) {
    $productName = mysqli_real_escape_string($conn, $productName);
    $productImage = mysqli_real_escape_string($conn, $productImage);
    $productPrice = mysqli_real_escape_string($conn, $productPrice);

    $sql_1 = "INSERT INTO wishlist (`description`, `Image`, `price`) VALUES ('$productName', '$productImage', '$productPrice')";

    if (mysqli_query($conn, $sql_1)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["wishlist"])) {
    $productName = $_POST["hidden_name"];
    $productImage = $_POST["hidden_image"];
    $productPrice = $_POST["hidden_price"];

    if (addToWishlist($conn, $productName, $productImage, $productPrice)) {
        echo "Item added to wishlist successfully.";
    } else {
        echo "Error: Unable to add item to wishlist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const quantityInputs = document.querySelectorAll('.product input[name="quantity"]');

            quantityInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    const quantity = parseInt(this.value);
                    if (quantity < 1 || isNaN(quantity)) {
                        this.value = 1;
                    }
                });
            });
        });
    </script>
</head>
<body>
<section class="header">
        <a href="index.php" class="logo"><img src="hamro-ramro.png" height="100px" width="100px"></a>
            <nav class="navbar">
            <a href="index.php">home</a>
            <a href="shop.php">Shop</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Terms and Condition</a></b></h3>
            </nav>
            <div>
            <a href="wishlist.php"> <i class="fa fa-heart-o" style="font-size:24px"></i></a> 
            <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
            <button class="nav-btn"><i class="fa fa-bars"></i></button>

            </div>
    </section>