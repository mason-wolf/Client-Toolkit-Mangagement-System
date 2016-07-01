<link rel='stylesheet' href='style.css' type='text/css'>
<?php

$connection = mysqli_connect("localhost", "root", "mason.wolf", "accounts");
$num_rec_per_page = 10;

if(isset($_GET['page'])) { $page = $_GET['page']; } else { $page = 1; }
$start_from = ($page-1) * $num_rec_per_page;
$sql = "SELECT * FROM users ORDER BY LastName LIMIT $start_from, $num_rec_per_page";
$result = mysqli_query($connection, $sql);
$count = mysqli_num_rows($result);
if($count == 0) {
	$NoTechnicians = "<center>There are currently no technicians assigned.</center>";
}

?>

	<table id="tools">
	<tr><th style='text-align:center;'>Technician</th><th style='text-align:center;'>Assigned Kit</th><th>Last Conducted Inventory</th></tr>
	
	<?php 

	while ($row = mysqli_fetch_assoc($result)) { ?>
<td> <p style="style= text-overflow : ellipsis;
        text-overflow : ellipsis;
        width         : 100px;
        overflow      : hidden;"><center><a href="../tools/Profile.php?technician=<?php echo $row['LastName']; ?>"> 
            <?php echo $row['LastName'];?>, 
            <?php echo $row['FirstName']; ?> 
			</a></center></p></td>
	<td style='text-align:center;'> <?php echo $row['AssignedKit']; ?> </td>
	<td> <?php echo $row['InspectionDate']; ?> </td>
        </tr>

	<?php } ?>
	</table></br>
	
	<?php
		if(isset($NoTechnicians)) {
		echo $NoTechnicians;
	}
	?>
	
		<a href="../tools/technicians_FullView.php" style="margin-left:145px;">View All</a>
