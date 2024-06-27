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
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background:url('jeans-2.jpg') no-repeat;">
                    <div class="content">
                        <span>Quality product with huge discount</span>
                        <h3>50% Off on product</h3>
                        
                    </div>
                </div>
                
                <div class="swiper-slide" style="background:url('jeans-3.jpg') no-repeat;">
                    <div class="content">
                    <span>Quality product with huge discount</span>
                    <h3>50% Off on product</h3>
                        
                    </div>
                </div>

                <div class="swiper-slide" style="background:url('jeans-4.jpg') no-repeat;">
                    <div class="content">
                    <span>Quality product with huge discount</span>
                    <h3>50% Off on product</h3>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <main>
        <h2>Highly Recommended For You</h2>
        <div class="container">
            <?php
            $query="SELECT * FROM `product-1` ORDER BY ID ASC";
            $result=mysqli_query($conn,$query);

            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_array($result)){
                    ?>
                    <div class="product">
                    <form method="post" action="index.php?action=add&id=<?php echo $row["ID"]; ?>">  
                    <div class="product">
                        <img src="img/<?php echo $row["Image"];?>" alt="">
                        <h3><?php echo $row["description"]?></h3>
                        <p>Rs<?php echo $row["price"];?></p> 
                        
                        <input type="text" id="quantity" name="quantity" value="1">
                        <input type="hidden" name="hidden_image" value="<?php echo $row["Image"];?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $row["description"];?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
                        <input type="submit" name="add" value="Add to Cart">
                        <button type="submit" name="wishlist" value="Add to Wishlist">Add to wishlist</button>
                    </div>
                    <br><br>
                    </form>
            
                </div>
                <?php
                }
            }
?>

    </div>

</main>
<footer class="footer-distributed">

			<div class="footer-left">

				<h3><span>Hamro-Ramro</span></h3>

				<p class="footer-links">
					<a href="#" class="link-1">Home</a>
					
					<a href="#">Shop</a>
				
					<a href="#">Pricing</a>
				
					<a href="#">About Us</a>
					
					<a href="#">Terms and Condition</a>
					
					<a href="#">Contact Us</a>
				</p>

				<p class="footer-company-name">Hamro-Ramro © 2024</p>
			</div>

			<div class="footer-center">

				<div>
                <i class="fa fa-map-marker"></i>
					<p><span>Sanchya-Kos Galli</span> Naxal, Kathmandu</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+977 9863117953</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:info@hamroramro.com">info@hamroramro.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About the company</span>
					This company provide exceptional online shopping experiences while offering a wide range of products at competitive prices, ultimately aiming for customer satisfaction and loyalty.
				</p>

				<div class="footer-icons">

					<a href="https://www.facebook.com/profile.php?id=100086598578007"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>

		</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
        
</body>
</html>