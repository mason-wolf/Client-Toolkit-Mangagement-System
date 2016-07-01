<?php

$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
if(isset($_GET['Report'])) { $id = $_GET['Report']; }
$deleteItem = "DELETE FROM reports WHERE ID=$id";
$deleteQuery = mysqli_query($connection, $deleteItem);
Header('Location:/tools/Reports_FullView.php');
?>
