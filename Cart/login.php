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


$nameErr = $emailErr = $genderErr=$websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['gender']) || empty($_POST['comment']) || empty($_POST['website'])) {
        echo "All fields are required.";
    } else {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $gender = test_input($_POST["gender"]);
        $comment = test_input($_POST["comment"]);
        $website = test_input($_POST["website"]);

        $query = "INSERT INTO login(Name,Email,Gender,Comment,Website) VALUES('$name','$email','$gender','$comment','$website')";
        $result = mysqli_query($conn, $query);

        if($result){
            header("Location: index.php");
            exit();
        } else {
            echo "<script>document.write('there is an error')</script>";
        }
    }
}

function test_input($data) {

    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
h2 {
    text-align: center;
    color: #333;
}
p {
    text-align: center;
    color: #666;
}
.center {
    width: 50%;
    margin: auto;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.form{
    background-color: lightgray;
}


input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="radio"] {
    margin-right: 10px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>  
<div class="form">

<h2 style="text-align:center; background-color: green">Welcome to Hamro-Ramro</h2>
<p style="text-align:center;"><span class="error">* required field</span></p>
<div class="center"> 
<form method="post"> 
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Email: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit"> 
</form>
</div>
</div>
</body>
</html>
