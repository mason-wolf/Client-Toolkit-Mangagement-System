<title>CSTT - Tools Administration Panel</title>

<?php
session_start();
if(isset($_SESSION['admin'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
include('header.php'); 

if(isset($_GET['item'])) { 

$item = $_GET['item']; 
// Retrieve values first to fill in the form
$getValues = "SELECT * FROM tools WHERE id=". $item;
$valuesQuery = mysqli_query($connection, $getValues);
$values = mysqli_fetch_assoc($valuesQuery);
// Convert special characters to HTML entities or else the echoed variable will be incomplete
$itemName = htmlspecialchars($values['itemName']);
$imageFileFormat =  preg_replace('/\s+/', '', $values['fileFormat']);

}


?>

<div class="addTool">
<form enctype="multipart/form-data" action="EditTool_SaveChanges.php" method="POST" class="addToolForm">
<input type="hidden" name="id" value="<?php echo $values['ID'];?>">
<center><?php echo "<div class='toolName'><img src='../uploads/". $values['imageFileName'] . $imageFileFormat . "' class='Tool_Image'></div>"; ?></center></br>
<label>Item Name:</label> <input type="text" name="itemName" style="width:225px;" required value="<?php echo $itemName;?>"></br></br>
<label>Part Number:</label> <input type="text" name="partNumber" style="width:75px;" required value="<?php echo $values['partNumber'];?>"></br></br>
<label>Manufacturer:</label> <input type="text" name="manufacturer" required value="<?php echo $values['manufacturer'];?>"></br>
<label>Description:</label> </br>
<textarea rows=15 cols=30 name="description" style="margin-left:10px;" required><?php echo $values['description'];?></textarea></br></br>
<label>Quantity:</label> <input type="text" name="quantity" style="width:30px;" value="<?php echo $values['quantity'];?>"></br></br>
<input type="submit" value="Save" style="margin-left:350px;margin-top:20px;">
</form></br>
<span style='padding-left:10px;'></span> <a href='javascript:void(0)' onclick='window.history.back();'>Back</a>
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
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>

