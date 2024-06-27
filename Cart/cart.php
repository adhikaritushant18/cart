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

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $productName = $_GET["name"];
   
    $deleteQuery = "DELETE FROM `product-2` WHERE description=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $productName);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Item deleted successfully";
    } 
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <nav>
        <span>SHOP HERE </span>
    
    </nav>
    <h2> Cart </h2>
    <div class="table container">
        <table>
            <tr> 
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product quantity</th>
                <th>Total Price</th>
                <th>Remove Item</th>
            </tr>
            <?php
            $query="SELECT * FROM `product-2` ORDER BY ID ASC";
            $result=mysqli_query($conn, $query);
            $total=0;
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><img src="img/<?php echo $row["img"];?>" alt=""></td>
                        <td><?php echo $row["description"];?></td>
                        <td><?php echo $row["price"];?></td>
                        <td><?php echo $row["quantity"];?></td>
                        <td><?php echo number_format($row["quantity"]*$row["price"],2);?></td>
                        <td><a href="cart.php?action=delete&name=<?php echo $row["description"];?>"><span>Remove Item</span></a></td>
                        <?php
                        $total=$total+ ($row["quantity"]*$row["price"]);
                }
            }
            ?>
                        
                </tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo number_format($total,2);?></td>
                        <td><button>Proceed to Payment</button></td>
                    </tr>    
        </table><br>
    <div class="continue_shopping" >
        <a href="shop.php"  class="continue-shopping-btn">Continue Shopping</a>
    </div>
    </body>
    
</html>
