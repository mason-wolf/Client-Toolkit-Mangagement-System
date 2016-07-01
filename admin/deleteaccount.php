<?php
include 'header.php';
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
if(isset($_GET['profile_id'])) { $id = $_GET['profile_id']; }
$deleteItem = "DELETE FROM users WHERE ID=$id";
$deleteQuery = mysqli_query($connection, $deleteItem);
Header('Location:index.php');
?>
