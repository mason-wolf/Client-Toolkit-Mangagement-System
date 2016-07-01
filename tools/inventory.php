<!doctype html>
<script type="text/javascript">
function deleteItem(id) {
var deleteItem = confirm("Are you sure you want to delete this account?");
if(deleteItem == true) {
window.location = "DeleteAccount.php?profile_id=" + id;
}
}

function submitInventory(frm){
	var inventory = "";
	var usr = document.getElementById("usr").value;
	var comments = document.getElementById("comments").value;
	
   for (i = 0; i < frm.tools.length; i++)
      if (frm.tools[i].checked){
        inventory = inventory + frm.tools[i].value + "\n";
      }
	window.location = "Inventory.php?technician=" + usr + "&inventory=" + inventory + "&comments=" +comments;

}
</script>
<?php
session_start();
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');

include "header.php";

if(isset($_SESSION['admin']) || isset($_SESSION['user'])) {

	if(isset($_GET['technician'])) {
	$technician = $_GET['technician'];
	// get user details
	$query = "SELECT * FROM users WHERE LastName='" . $technician . "'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	if(isset($_SESSION['admin'])) {
	$accounts = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
	$assignKit = "<a href='AssignKit.php?technician=" . $technician . "'>Assign Kit</a>";
	$deleteProfile = "<a href='javascript:void(0)' onclick='return deleteItem(" . $row['ID'] . ")'>Delete Account</a>";
	$UserQuery = "SELECT * FROM users WHERE (LastName LIKE '%$technician%')";
	$UserResult = mysqli_query($accounts, $UserQuery);
	$KitDetails = mysqli_fetch_array($UserResult);

	$KitDatabase = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
	$KitQuery = "SELECT * FROM " . $row['AssignedKit'];
	$KitQueryResult = mysqli_query($KitDatabase, $KitQuery);
	$KitDetails_2 = mysqli_fetch_array($KitQueryResult);
	}
	else {
	$assignKit = "<span style='color:gray;'>Assign Kit</span>";
	$deleteProfile = "<span style='color:gray;'>Delete Account</span>";
	}
	
	if(isset($_GET['inventory'])) {
	$accounts = mysqli_connect("localhost", "root", "mason.wolf", "accounts");
	$inventoryDB = mysqli_connect("localhost", "root", "mason.wolf", "inventory");
	$technician = $_GET['technician'];
	$inventory = $_GET['inventory'];
	$comments = $_GET['comments'];
	$date = date("F j, Y");
	
	//$updateInspectionDate= "UPDATE reports SET InspectionDate = '" . $date . "' WHERE LastName='" . $technician . "'";
	//$updateIDQuery = mysqli_query($accounts, $updateInspectionDate);
	$UserQuery = "SELECT * FROM users WHERE LastName='" . $technician . "'";
	$UserQueryResult = mysqli_query($accounts, $UserQuery);
	$User = mysqli_fetch_assoc($UserQueryResult);
	$newReport = "INSERT INTO reports (User, LastName, Inventory, comments, AssignedKit, InspectionDate) VALUES 
		('" . $User['LastName'] . ", " . $User['FirstName'] . "','" . $User['LastName'] . "','" . $inventory . "','" . $comments . "', '" . $User['AssignedKit'] . "','" . $date . "')";
	$ReportQueryResult = mysqli_query($inventoryDB, $newReport);

	Header ('Location: ControlPanel.php');
	}
	?>
	<div class="technician_fullDisplay">

	<?php 
	$accounts = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
	$UserQuery = "SELECT * FROM users WHERE (LastName LIKE '%$technician%')";
	$UserResult = mysqli_query($accounts, $UserQuery);
	$KitDetails = mysqli_fetch_array($UserResult);
	$query = "SELECT * FROM users WHERE LastName='" . $technician . "'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$KitDatabase = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
	$KitQuery = "SELECT * FROM " . $row['AssignedKit'];
	$KitQueryResult = mysqli_query($KitDatabase, $KitQuery);
	$KitDetails_2 = mysqli_fetch_array($KitQueryResult);
	echo "<input type='hidden' id='usr' value='" . $row['LastName'] . "'>";
	echo "<div class='itemView' style='padding:3em 3em;'>";
	echo "Name: <span style='margin-left:108px;'>" . $row['LastName'] . "," . $row['FirstName'] . "</span></br></br>";
	echo "Assigned Kit: <span style='margin-left:70px;'>" . $row['AssignedKit'] . "</span></br></br>";
	echo "Last Inspection Date: <span style='margin-left:20px;'>" . $KitDetails['InspectionDate'] . "</span></br></br>";
	echo "Contents:</br></br>";																// Here
	echo "<form name='inventory'>";
	echo "<span style='margin-left:125px;position:absolute;margin-top:-17px;'><input type='checkbox' name='tools' value='" . $KitDetails_2[3] . " '>" . $KitDetails_2['contents'] . "</span>";
	while($KitDetails_2 = $KitQueryResult -> fetch_array()) {	// Here
		echo "<span style='margin-left:125px;'><input type='checkbox' name='tools' value='" . $KitDetails_2[3] . "'>" . $KitDetails_2[3] . "</span>";
	} 		?>
<span style='margin-left:125px;margin-top:20px;position:absolute;'>
Are any items missing? Unserviceable? Insert detailed comments below:
</span></br>
	<textarea cols=50 rows=10 style='margin-left:125px;margin-top:45px;' id="comments"></textarea>
	<?php
	echo "<input type='button' value='Submit Accountability' onclick='submitInventory(this.form)' style='margin-left:125px;margin-top:10px;'></form>";

	?>
	</div>
	<?php
	}
}


?>

