<?php
session_start();

if(isset($_SESSION['admin'])) {
$connection = mysqli_connect("localhost", "root", "mason.wolf");
$inventory = mysqli_select_db($connection, "inventory");
$inventory_query = "SELECT * FROM tools";
$inventory_query_result = mysqli_query($connection, $inventory_query);
if($inventory_query_result -> num_rows == 0 ) {
$noInventory = "No inventory available. <a href='AddTool.php'>Add items</a>";
}

?>
<?php include('header.php'); ?>
<div class="inventory">
<?php if(isset($noInventory)) { ?><center><?php echo $noInventory; } else {?></center><?php
include('..\tools\Inventory_QuickView.php');
}
?>
</div>
<div class="technicians">
<?php include('..\tools\Technicians_QuickView.php'); ?>
</div>
<div class="reports">
<?php include('..\tools\Reports.php'); ?>
</div>

<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>

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
   top:700px;
   height:100px;
   color:gray;
   
   '>
   <center>
	Communications using, or data stored on, this IS are not private, are subject to routine monitoring, interception, and search, and may be disclosed or used for any USG authorized purpose. - This IS includes security measures (e.g., authentication and access controls) to protect USG interests--not for your personal benefit or privacy. NOTICE: There is the potential that information presented and exported from the AF Portal contains FOUO or Controlled Unclassified Information (CUI). It is the responsibility of all users to ensure information extracted from the AF Portal is appropriately marked and properly safeguarded. If you are not sure of the safeguards necessary for the information, contact your functional lead or Information Security Officer. - Notwithstanding the above, using this IS does not constitute consent to PM, LE or CI investigative searching or monitoring of the content of privileged communications, or work product, related to personal representation or services by attorneys, psychotherapists, or clergy, and their assistants. Such communications and work product are private and confidential. See User Agreement for details. 
	</center>
	</div>