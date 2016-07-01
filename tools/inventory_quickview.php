<link rel='stylesheet' href='.\default.css' type='text/css'>
<?php

$connection = mysqli_connect("localhost", "root", "mason.wolf", "inventory");
$num_rec_per_page = 10;

if(isset($_GET['page'])) { $page = $_GET['page']; } else { $page = 1; }
$start_from = ($page-1) * $num_rec_per_page;
$sql = "SELECT * FROM tools ORDER BY id DESC LIMIT $start_from, $num_rec_per_page";
$result = mysqli_query($connection, $sql);


?>


	<table id="tools">
	<tr><th style='text-align:center;'>Item Name</th><th style='text-align:center;'>Part #</th><th>Quantity</th><th>Manufacturer</th></tr>
	<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<td> <p style="style= text-overflow : ellipsis;
        white-space   : nowrap;
        width         : 150px;
        overflow      : hidden;"><center><a href="../tools/ItemView.php?item=<?php echo $row['ID']; ?>"> <?php echo $row['itemName']; ?> </a></center></p></td>
	<td style='text-align:center;'> <?php echo $row['partNumber']; ?> </td>
	<td style='text-align:center;'> <?php echo $row['quantity']; ?> </td>
	<td> <p style="style= text-overflow : ellipsis;
        white-space   : nowrap;
        width         : 65px;
        overflow      : hidden;text-align:right;"><?php echo $row['manufacturer']; ?> </p></td>
	</tr>
	
	<?php } ?>
	</table></br>
	<a href="../tools/Inventory_FullView.php" style="margin-left:145px;">View All</a>
	
