
<script type="text/javascript">

function deleteItem(id) {
var deleteItem = confirm("Are you sure you want to delete this tool?");
if(deleteItem == true) {
window.location = "../admin/DeleteTool.php?item=" + id;
}
}

function editItem(id) {
window.location = "../admin/EditTool.php?item=" + id;
}
</script>
<?php
session_start();
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');

if(isset($_SESSION['admin'])) {
include('../admin/header.php');
}
else {
include('header.php');
}

	if(isset($_GET['item'])) {
	$item = $_GET['item'];
	$query = "SELECT * FROM tools WHERE id=" . $item;
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);
	$imageFileFormat =  preg_replace('/\s+/', '', $row['fileFormat']);
	if(isset($_SESSION['admin'])) {
	$toolEdit = "<a href='javascript:void(0)' onclick='return editItem(" . $row['ID'] . ")'>Edit Tool</a>";
	$toolDelete = "<a href='javascript:void(0)' onclick='return deleteItem(" . $row['ID'] . ")'>Delete Tool</a>";
	}
	?>
	<div class="inventory_fullDisplay">
		<div class="toolDisplay_full">
	<?php 
	echo "<div class='itemView' style='padding:.5em 3em;'>";
	echo "<div class='toolName'><img src='../uploads/". $row['imageFileName'] . $imageFileFormat . "' class='Tool_Image'></div>";
	echo $row['itemName'] . "</br></br>";
	echo "Part Number: " . $row['partNumber'] . "</br></br>";
	echo "Manufacturer: " . $row['manufacturer'] . "</br></br>";
	echo "Quantity Allocated: " . $row['quantity'] . "</br></br>";
	echo $row['description'] . "</br></br>";
	if(isset($_SESSION['admin'])) {
	echo $toolEdit . "<span style='padding-left:10px;'></span> " . $toolDelete . "<span style='padding-left:10px;'></span>";
	}
	echo "<a href='javascript:void(0)' onclick='window.history.back();'>Back</a>";
	?>
	</div></div>
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
	<?php
	
}
else {
echo "You do not have access to this page.";
}
?>
