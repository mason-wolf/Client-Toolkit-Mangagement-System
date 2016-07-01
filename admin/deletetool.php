<?php
include 'header.php';
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
if(isset($_GET['item'])) { $item = $_GET['item']; }
$deleteItem = "DELETE FROM tools WHERE id=$item";
$deleteQuery = mysqli_query($connection, $deleteItem);
Header('Location: ../admin/Inventory_FullView.php');
?>
