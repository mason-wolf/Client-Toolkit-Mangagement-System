<link rel='stylesheet' href='style.css' type='text/css'>
<?php
session_start();
if(isset($_SESSION['user'])) {
include('header.php');
}
else {
include('../admin/header.php');
}

?>
	
	<div class="inventory_fullDisplay">
	
	<div class="kitTitle">Tool Inventory Reports</div>
	<div class="toolDisplay_full">
	<?php 
	$connection = mysqli_connect("localhost", "root", "mason.wolf", "inventory");

	$num_rec_per_page = 30;
	if(isset($_GET['page'])) { $page = $_GET['page']; } else { $page = 1; }
	$start_from = ($page-1) * $num_rec_per_page;
	
	$sql = "SELECT * FROM reports ORDER BY ID DESC LIMIT $start_from, $num_rec_per_page";
	$result = mysqli_query($connection, $sql);

	while ($Report = mysqli_fetch_assoc($result)) { 
	?>
	<table style="width:60%" id="reports">
   <tr>
    <td style="overflow: hidden; width: 150px; text-align: left; valign: top; whitespace: nowrap;">

    <?php 	echo $Report['User']; ?></td>
	
     <td><?php echo $Report['AssignedKit'];?></td> 
    <td><?php echo $Report['InspectionDate'];?></td>
	<td style="float:right;"><a href="DeleteReport.php?Report=<?php echo $Report["ID"]; ?>">Delete</a></td>
	<td style="float:right;"></td>
    <td style="float:right;"><a href="Tool_Report.php?Report=<?php echo $Report["ID"]; ?>">View</a></td>
   </tr>
 
</table> 
			
	<?php 
	}
	
	echo "</div>";

	$paginateQuery = "SELECT * FROM reports";
	$queryResult = mysqli_query($connection, $paginateQuery);
	$total_records = mysqli_num_rows($queryResult);
	$total_pages = ceil($total_records / $num_rec_per_page);
	
	echo "</br></br><a href='Reports_FullView.php?page=1' class='pagination'>" . 'First' . "</a>";

	for ($i=1;$i<=$total_pages; $i++) {
		echo "<a href='Reports_FullView.php?page=" . $i . "' class='pagination'>" . $i . "</a>";
		}; 
	echo "<a href='Reports_FullView.php?page=" . $total_pages . "' class='pagination'>" . 'Last' . "</a>";
	?>
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
   top:840px;
   height:100px;
   color:gray;
   
   '>
   <center>
	Communications using, or data stored on, this IS are not private, are subject to routine monitoring, interception, and search, and may be disclosed or used for any USG authorized purpose. - This IS includes security measures (e.g., authentication and access controls) to protect USG interests--not for your personal benefit or privacy. NOTICE: There is the potential that information presented and exported from the AF Portal contains FOUO or Controlled Unclassified Information (CUI). It is the responsibility of all users to ensure information extracted from the AF Portal is appropriately marked and properly safeguarded. If you are not sure of the safeguards necessary for the information, contact your functional lead or Information Security Officer. - Notwithstanding the above, using this IS does not constitute consent to PM, LE or CI investigative searching or monitoring of the content of privileged communications, or work product, related to personal representation or services by attorneys, psychotherapists, or clergy, and their assistants. Such communications and work product are private and confidential. See User Agreement for details. 
	</center>
	</div>