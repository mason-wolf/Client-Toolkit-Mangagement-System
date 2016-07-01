<title>CSTT - Tools Administration Panel</title>

<?php
session_start();
if(isset($_SESSION['admin'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
include('header.php'); 

if(isset($_POST['itemName'])) { 
$id = $_POST['id'];
$itemName = $_POST['itemName'];
$partNumber = $_POST['partNumber'];
$manufacturer = $_POST['manufacturer'];
$description = mysqli_real_escape_string($connection, $_POST['description']);
$quantity = $_POST['quantity'];
$updateTool = "UPDATE tools SET 
			itemName = ' ". $itemName . "', 
			partNumber = '" . $partNumber . "',
			manufacturer = '" .$manufacturer . "', 
			description = '" . $description . "', 
			quantity = '" . $quantity . "' 
			WHERE id='" . $id . "'";
$updateQuery = mysqli_query($connection, $updateTool);
header("location:../tools/Inventory_FullView.php");
}

?>

<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>

