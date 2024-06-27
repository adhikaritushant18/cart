<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Failed to connect";
}

if (isset($_GET["action"]) && $_GET["action"] == "remove") {
     
        $productName = $_GET["name"];
        $deleteQuery = "DELETE FROM wishlist WHERE description= ?";
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
    <title>Wishlist</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <span>SHOP HERE</span>
    </nav>
    <h2>Wishlist</h2>
    <div class="table container">
        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Remove Item</th>
            </tr>
            <?php
            $query = "SELECT * FROM wishlist ORDER BY ID ASC";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <tr>
                        <td><img src="img/<?php echo $row["Image"]; ?>" alt=""></td>
                        <td><?php echo $row["description"]; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td><a href="wishlist.php?action=remove&name=<?php echo $row["description"]; ?>"><span>Remove Item</span></a></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>No items in wishlist</td></tr>";
            }
            ?>
        </table><br>
        <div class="continue_shopping">
            <a href="shop.php" class="continue-shopping-btn">Continue Shopping</a>
        </div>
    </div>
</body>

</html>
