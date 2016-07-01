
<script type="text/javascript">

function deleteItem(id) {
var deleteItem = confirm("Are you sure you want to delete this account?");
if(deleteItem == true) {
window.location = "../admin/DeleteAccount.php?profile_id=" + id;
}
}

</script>
<?php
session_start();
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
if(isset($_SESSION['admin'])) {
include "../admin/header.php";
}
else
{
include "header.php";
if(isset($_GET['user'])) {
	$technician = $_GET['technician'];
	$query = "SELECT * FROM users WHERE LastName='" . $technician . "'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$deleteProfile = "<a href='javascript:void(0)' onclick='return deleteItem(" . $row['ID'] . ")'>Delete Account</a>";
	
	$UserQuery = "SELECT AssignedKit FROM users WHERE (LastName LIKE '%$technician%')";
	$UserResult = mysqli_query($accounts, $UserQuery);
	$row = mysqli_fetch_array($UserResult);
	echo $row['AssignedKit'];
	?>
	<div class="technician_fullDisplay">

	<?php 
	echo "<div class='itemView' style='padding:3em 3em;'>";
	echo "Name: <span style='margin-left:50px;'>" . $row['LastName'] . "," . $row['FirstName'] . "</span></br></br>";
	echo "Assigned Kit: <span style='margin-left:20px;'>" . $row['AssignedKit'] . "</span></br></br>";
	echo "<a href='javascript:void(0)' onclick='window.history.back();'>Back</a>";
	?>
	</div>
	<?php
	}
}
if(isset($_SESSION['admin']) || isset($_SESSION['user'])) {

	if(isset($_GET['technician'])) {
	$technician = $_GET['technician'];
	$query = "SELECT * FROM users WHERE LastName='" . $technician . "'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	if(isset($_SESSION['admin'])) {
	$accounts = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
	$assignKit = "<a href='../admin/AssignKit.php?technician=" . $technician . "'>Assign Kit</a>";
	$deleteProfile = "<a href='javascript:void(0)' onclick='return deleteItem(" . $row['ID'] . ")'>Delete Account</a>";
	$passwordReset = "<a href='../admin/passwordreset.php?technician=" . $technician . "'>Password Reset</a>";
	$UserQuery = "SELECT * FROM users WHERE (LastName LIKE '%$technician%')";
	$UserResult = mysqli_query($accounts, $UserQuery);
	$KitDetails = mysqli_fetch_array($UserResult);

	$KitDatabase = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
	$KitQuery = "SELECT * FROM " . $row['AssignedKit'];
	$KitQueryResult = mysqli_query($KitDatabase, $KitQuery);
	$KitDetails_2 = @mysqli_fetch_array($KitQueryResult);

	}
	else {
	$assignKit = "<span style='color:gray;'>Assign Kit</span>";
	$deleteProfile = "<span style='color:gray;'>Delete Account</span>";
	$passwordReset = "";
	}
	?>
	<div class="inventory_fullDisplay">
		<div class="toolDisplay_full">
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
	$KitDetails_2 = @mysqli_fetch_array($KitQueryResult);
	echo "<div class='itemView' style='padding:3em 3em;'>";
	echo "</br></br>" . $assignKit . "<span style='padding-left:10px;'></span>" . $deleteProfile . "<span style='padding-left:10px;'></span>" .
	$passwordReset . "<span style='padding-left:10px;'></span><a href='javascript:void(0)' onclick='window.history.back();'>Back</a></br></br>";
	echo "Name: <span style='margin-left:80px;'>" . $row['LastName'] . "," . $row['FirstName'] . "</span></br></br>";
	echo "Assigned Kit: <span style='margin-left:42px;'>" . $row['AssignedKit'] . "</span></br></br>";
	echo "Inspection Date: <span style='margin-left:20px;'>" . $KitDetails['InspectionDate'] . "</span></br></br>";
	echo "Contents:</br></br>";
	echo "<span style='margin-left:125px;position:absolute;margin-top:-14px;'>" . $KitDetails_2['contents'] . "</span>";

	while(@$KitDetails_2 = $KitQueryResult -> fetch_array()) {
		echo "<span style='margin-left:125px;'>" . $KitDetails_2[3] . "</span>";
	}
	
	
	
	?>

	</div>
	</div>
	
	<?php
	}
}
?>


	
    <span style='position:absolute;margin-top:200px;background-color:white;padding:0.2em 0.6em;'>
	<a href='../uploads/TOOLS_OI_23-1001.pdf'>Tools Management Operating Instructions</a> |  
    <a href='../uploads/MICT.xls'>Management Internal Control Toolset</a> |  
    <a href='../uploads/TO_33A_1001.pdf'>Technical Order</a> |
    <a href='../archive/'>Archived Reports</a> |
    <a href='mailto: mason.wolf.1@us.af.mil'>Contact</a>
    </span>

<div style="position:absolute;margin-top:150px; margin-left:950px;">

<a href="https://www.gsaadvantage.gov/advantage/main/start_page.do"><img src="../images/gsa_logo.png" style="border-style: none"></a>

<a href="http://www.stanleysupplyservices.com/"> <img src="../images/stanley_logo.gif" style="border-style: none"></a>

</div>

<div class="footer" style='position:absolute;
   bottom:0;
   width:90%;
   top:850px;
   height:100px;
   color:gray;
   margin-left:-100px;
   '>
   <center>
	Communications using, or data stored on, this IS are not private, are subject to routine monitoring, interception, and search, and may be disclosed or used for any USG authorized purpose. - This IS includes security measures (e.g., authentication and access controls) to protect USG interests--not for your personal benefit or privacy. NOTICE: There is the potential that information presented and exported from the AF Portal contains FOUO or Controlled Unclassified Information (CUI). It is the responsibility of all users to ensure information extracted from the AF Portal is appropriately marked and properly safeguarded. If you are not sure of the safeguards necessary for the information, contact your functional lead or Information Security Officer. - Notwithstanding the above, using this IS does not constitute consent to PM, LE or CI investigative searching or monitoring of the content of privileged communications, or work product, related to personal representation or services by attorneys, psychotherapists, or clergy, and their assistants. Such communications and work product are private and confidential. See User Agreement for details. 
	</center>
	</div>
