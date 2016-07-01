
<title>CSTT - Tools Administration Panel</title>

<?php
session_start();
include('header.php'); 
if(isset($_SESSION['user'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
$accounts= mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
$kitCountQuery = "SELECT kitCount FROM settings";
$kitCountQuery_Result = mysqli_query($connection, $kitCountQuery);
$kitCount = mysqli_fetch_assoc($kitCountQuery_Result);
$count = $kitCount['kitCount'];

?>

<div class="addTool">
<?php


for($i = 1; $i < $count + 1; $i++) {

	$kitQuery = "SELECT * FROM kit_" . $i;
	$kitQueryResult = mysqli_query($connection, $kitQuery);
	$kit = mysqli_fetch_assoc($kitQueryResult);
	$UserQuery = "SELECT FirstName, LastName, AssignedKit FROM users WHERE MATCH (AssignedKit) AGAINST ('kit_" . $kit['kitNumber'] . " ')";
	$UserResult = mysqli_query($accounts, $UserQuery);
	$row = @mysqli_fetch_array($UserResult);
	$LastName = $row['LastName'] . ",";
	$FirstName = $row['FirstName'];
    if(!$row) {
	$LastName = "Not";
	$FirstName = "assigned";
	}
    
 
    echo "<div class='kit'>";
	echo "<div class='kitTitle'>Tool Kit " . $kit['kitNumber'] . "</div></br>";
	echo "</br><p>Inventory: </br></br>". $kit['contents'];
	while($row = $kitQueryResult -> fetch_array()) {
		echo $row[3] . "";
	}
		echo "</br></br></br></p>";
		echo "<div class='KitDetails'>";
		echo "Assigned Technician:<span style='margin-left:30px;'> " . $LastName. " " . $FirstName . "</br>";
		echo "Assigned Date:<span style='margin-left:50px;'> " . $kit['assignedDate']. "</br>";
		echo "Inspection Date:<span style='margin-left:41px;'> " . $kit['lastInspectionDate'];
		echo "</div>";
		?>
</div>
	<?php
}


?> 
</div>

<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>