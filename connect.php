<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db="stock";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id=0;
$designation="";
$price="";
$quantity="";
$update=false;

if(isset($_POST["save"])){
    $des=$_POST['designation'];
    $pr = $_POST['price'];
    $qnt = $_POST['quantity'];
    $conn-> query("INSERT INTO Article (designation, price, quantity) 
      VALUES ('$des', $pr, $qnt)") 
      or die($conn->error($conn));

    $_SESSION["message"] = "Article added successfully.";
    $_SESSION["msg_type"] = "success";
    $conn->close();
    header("location: index.php");
}



if(isset($_GET["delete"])){
  $id=$_GET["delete"];
  $conn-> query("DELETE from Article where id =$id") or die($conn->error());
  $_SESSION["message"] = "Article deleted successfully.";
  $_SESSION["msg_type"] = "danger";
  $conn->close();
  header("location: index.php");
}

if(isset($_GET["add"])){
    $id=0;
    $designation = "";
    $price = 0;
    $quantity = 0;
    $update=false;
    header("location: index.php");
}

if(isset($_GET["edit"])){
  $id=$_GET['edit'];

  $result= $conn -> query("SELECT * from Article where id=$id") or die($conn->error());
  if(count($result)==1){
    $row = $result->fetch_array();
    $designation = $row["designation"];
    $price = $row["price"];
    $quantity = $row["quantity"];
    $update=true;
  }
}

if(isset($_POST["update"])){
  $id=$_POST["id"];
  $designation=$_POST["designation"];
  $price=$_POST["price"];
  $quantity=$_POST["quantity"];

  $conn-> query("UPDATE Article SET designation='$designation', price=$price, quantity=$quantity")
          or die($conn->error());

  $_SESSION['message'] = "Article infos has been updated";
  $_SESSION['msg_type'] = "warning";

  header("location : index.php");
}
?>
