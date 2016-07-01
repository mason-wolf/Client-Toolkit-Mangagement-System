
<title>CSTT - Tools Administration Panel</title>

<?php
session_start();
include('header.php'); 
if(isset($_SESSION['admin'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
$accounts= mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
$kitCountQuery = "SELECT kitCount FROM settings";
$kitCountQuery_Result = mysqli_query($connection, $kitCountQuery);
$kitCount = mysqli_fetch_assoc($kitCountQuery_Result);
$count = $kitCount['kitCount'];

?>
<script type="text/javascript">
function deleteItem(id) {
var deleteItem = confirm("Are you sure you want to delete this kit?");
if(deleteItem == true) {
window.location = "DeleteKit.php?kit=" + id;
}
}


</script>
<div class="addTool">
<?php


for($i = 1; $i < $count + 1; $i++) {

	$kitQuery = "SELECT * FROM kit_" . $i;
	$kitQueryResult = mysqli_query($connection, $kitQuery);
	$kit = @mysqli_fetch_assoc($kitQueryResult);
	$kitDelete = "<a href='javascript:void(0)' onclick='return deleteItem(" . $kit['kitNumber'] . ")' style='margin-left:10px;position:absolute;margin-top:-20px;'>Empty</a>";
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
	while(@$row = $kitQueryResult -> fetch_array()) {
		echo $row[3] . "";
	}
		echo "</br></br></br></p>" . $kitDelete . "</br>";
		echo "<div class='KitDetails'>";
		echo "Assigned Technician:<span style='margin-left:30px;margin-top:10%;'> " . $LastName. " " . $FirstName . "</br>";
		echo "Assigned Date:<span style='margin-left:50px;'> " . $kit['assignedDate']. "</br>";
		echo "Inspection Date:<span style='margin-left:41px;'> " . $kit['lastInspectionDate'];
		echo "</div>";
		?>
</div>
	<?php
}


?> <input type="button" onclick="window.location = 'addkit.php';" value="Modify Kit">
</div>

<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>