<link rel='stylesheet' href='style.css' type='text/css'>
<?php
session_start();
if(isset($_SESSION['user'])) {
include('header.php');
}
else {
include('../admin/header.php');
}
	// Report details
	$inventoryDB = mysqli_connect("localhost", "root", "mason.wolf", "inventory");
	if(isset($_GET['Report'])) {
	$ReportID = $_GET['Report'];
	$ReportQuery = "SELECT * FROM reports WHERE ID = '" . $ReportID . "'";
	$ReportResult = mysqli_query($inventoryDB, $ReportQuery);
	$Report = mysqli_fetch_assoc($ReportResult);
	
	// User accounts details
	$Accounts = mysqli_connect("localhost", "root", "mason.wolf", "accounts");
	$UserQuery = "SELECT * FROM users WHERE LastName = '" . $Report['LastName'] . "'";
	$UserQueryResult = mysqli_query($Accounts, $UserQuery);
	$User = mysqli_fetch_assoc($UserQueryResult);
	
	// Kit Details
	$KitQuery = "SELECT * FROM " . $User['AssignedKit'];
	$KitQueryResult = mysqli_query($inventoryDB, $KitQuery);
	$Kit = mysqli_fetch_assoc($KitQueryResult);
	}
?>

	<div class="inventory_fullDisplay">
	<div class="kit">
	<div class="kitTitle">Tool Accountability - <?php echo $User['AssignedKit']?></div>
	<div class="kitDetails" style="margin-left:-150px;">
	<p>
	<div style='border:1px solid black;padding:0.2em 0.6em;width:400px;overflow:auto;'>
	Assignee: <span style='margin-left:170px;'><?php echo $User['LastName'] . ", " . $User['FirstName']; ?></br>

	Last Inspection Date: <span style='margin-left:100px;'><?php echo $Report['InspectionDate'];?></span></br></div>
	<div style='border:1px solid black;padding:0.2em 0.6em; width:400px;margin-top:10px;overflow:auto;'>
	<?php
	echo "</br><p>Assigned Inventory: </br></br>". $Kit['contents'];
	while(@$row = $KitQueryResult -> fetch_array()) {
		echo $row[3] . "";
	}
	echo "</div>";
	?>
</br><div style='position: absolute; top: 73; bottom: 0; left: 435; right: 0;border:1px solid black;padding:0.2em 0.6em;height:440;width:300px;overflow:auto;'>
<p>Inspected Inventory: </br></br>
<?php 
echo $Report['Inventory'];
echo "</br> Assignee Comments: </br></br>";
echo $Report['comments'];
	?>
	</p>
</div>
	
	</div>
	</div>
	</div>
	</div>
	<div class="footer_2">
    <span style='position:relative;margin-top:15px;'>
	<a href='../uploads/TOOLS_OI_23-1001.pdf'>Tools Management Operating Instructions</a> |  
    <a href='../uploads/MICT.xls'>Management Internal Control Toolset</a> |  
    <a href='../uploads/TO_33A_1001.pdf'>Technical Order</a> |
    <a href='../archive/'>Archived Reports</a> |
    <a href='mailto: mason.wolf.1@us.af.mil'>Contact</a>
    </span>
</div>
<div style="position:absolute;margin-top:-35px; margin-left:1000px;">

<a href="https://www.gsaadvantage.gov/advantage/main/start_page.do"><img src="../images/gsa_logo.png" style="border-style: none"></a>

<a href="http://www.stanleysupplyservices.com/"> <img src="../images/stanley_logo.gif" style="border-style: none"></a>

</div>

<div class="footer" style='position:absolute;
   bottom:0;
   width:90%;
   top:850px;
   height:100px;
   color:gray;
   
   '>
   <center>
	Communications using, or data stored on, this IS are not private, are subject to routine monitoring, interception, and search, and may be disclosed or used for any USG authorized purpose. - This IS includes security measures (e.g., authentication and access controls) to protect USG interests--not for your personal benefit or privacy. NOTICE: There is the potential that information presented and exported from the AF Portal contains FOUO or Controlled Unclassified Information (CUI). It is the responsibility of all users to ensure information extracted from the AF Portal is appropriately marked and properly safeguarded. If you are not sure of the safeguards necessary for the information, contact your functional lead or Information Security Officer. - Notwithstanding the above, using this IS does not constitute consent to PM, LE or CI investigative searching or monitoring of the content of privileged communications, or work product, related to personal representation or services by attorneys, psychotherapists, or clergy, and their assistants. Such communications and work product are private and confidential. See User Agreement for details. 
	</center>
	</div>