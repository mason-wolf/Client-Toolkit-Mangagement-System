
<title>CSTT - Tools Administration Panel</title>
<?php
session_start();
include('header.php');
if(isset($_SESSION['admin'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
$kitCountQuery = "SELECT * FROM settings";
$kitCountResult = mysqli_query($connection, $kitCountQuery);
$kitCount = mysqli_fetch_assoc($kitCountResult);
$result = mysqli_query($connection, "show tables from inventory like '%kit%'");

if(isset($_GET['technician'])) {
$technician = $_GET['technician'];
}

if(isset($_GET['kit'])) {
$date = date("F j, Y");
$technician = $_GET['technician'];
$kit = $_GET['kit'];
$accounts = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
$user = "SELECT * FROM users WHERE LastName='" . $technician . "'";
$result = mysqli_query($accounts, $user);
$row = mysqli_fetch_assoc($result);

$updateUserQuery = "UPDATE users SET AssignedKit = '" . $kit . "', InspectionDate = '" . $date . "' WHERE ID='" . $row['ID'] . "'";
$updateUser = mysqli_query($accounts, $updateUserQuery);
Header ("Location: ../tools/Profile.php?technician=" . $technician);
}
 ?>
 
<script>

function AddKit(technician) {
var inv = document.getElementById("inventory");
var kit = inv.options[inv.selectedIndex].value;
window.location = "AssignKit.php?kit=" + kit + "&technician=" + technician;
}
</script>
<div class="addTool" style="height:350px;">
<form action="" method="" class="addToolForm">
<div id="tools">


<label style="margin-top:-5px;margin-left:45px;width:500px;">Which kit would you like to assign to <?php echo $technician; ?>?</label> 

<select size=10 id="inventory" style="width:500px;margin-left:150px;margin-top:25px;">  
<?php

while($table = mysqli_fetch_array($result)) {
echo "<option value='" . $table[0] . "'>" . $table[0] . "</option>";
}

?>
</select>
<input type="button" value="Next" style="margin-top:200px;margin-left:-175px;position:absolute;" onclick="AddKit('<?php echo $technician; ?>');">
</form>
</div>
</div>
<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>