<?php
session_start();
include 'header.php';
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
if(isset($_GET['kit'])) { $kit = $_GET['kit']; }
$deleteItem = "TRUNCATE TABLE kit_" . $kit;
$deleteQuery = mysqli_query($connection, $deleteItem);

$KitNumberQuery = "INSERT INTO kit_" . $kit . " (kitNumber) VALUES ('" . $kit . "')";
Header("Location: kitmanager.php");

?>
