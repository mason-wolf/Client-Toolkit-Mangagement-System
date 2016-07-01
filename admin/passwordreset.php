<?php
session_start();
if(isset($_SESSION['admin'])) {
    if(isset($_POST['rpassform'])) {
        $newPass = $_POST['newpassword'];
        $user = $_GET['technician'];
        $connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
        $resetquery = "UPDATE users SET Password = '". $newPass . "' WHERE LastName='" . $user . "'";
        $query = mysqli_query($connection, $resetquery);
        header('location:../admin/controlpanel.php');
    }
include "../admin/header.php";
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'accounts');
if(isset($_GET['technician'])) { $technician = $_GET['technician']; }
$userQuery = "SELECT * FROM users WHERE LastName ='" . $technician . "'";
$query = mysqli_query($connection, $userQuery);
$row = mysqli_fetch_assoc($query);
?>

<div class="inventory_fullDisplay">
		<div class="toolDisplay_full">
            <h1>Reset Password</h1></br>
            
            <form action="passwordreset.php?technician=<?php echo $technician?>" method="post" style="margin-top:50px;">
                <input type="hidden" name="rpassform">
                New Password: <input type="password" name="newpassword" required style="margin-left:37px;border:1px solid black;"></br></br>
                <input type="submit" value="Submit">
            </div>
            </div>
            
	<!-- footer -->
    <span style='position:absolute;margin-top:10px;margin-left:150px;background-color:white;padding:0.2em 0.6em;'>
	<a href='../uploads/TOOLS_OI_23-1001.pdf'>Tools Management Operating Instructions</a> |  
    <a href='../uploads/MICT.xls'>Management Internal Control Toolset</a> |  
    <a href='../uploads/TO_33A_1001.pdf'>Technical Order</a> |
    <a href='../archive/'>Archived Reports</a> |
    <a href='mailto: mason.wolf.1@us.af.mil'>Contact</a>
    </span>

<div style="position:absolute;margin-top:-20px; margin-left:1100px;">

<a href="https://www.gsaadvantage.gov/advantage/main/start_page.do"><img src="../images/gsa_logo.png" style="border-style: none"></a>

<a href="http://www.stanleysupplyservices.com/"> <img src="../images/stanley_logo.gif" style="border-style: none"></a>

</div>

<div class="footer" style='position:absolute;
   bottom:0;
   width:90%;
   top:830px;
   height:100px;
   color:gray;
   margin-left:100px;
   '>
   <center>
	Communications using, or data stored on, this IS are not private, are subject to routine monitoring, interception, and search, and may be disclosed or used for any USG authorized purpose. - This IS includes security measures (e.g., authentication and access controls) to protect USG interests--not for your personal benefit or privacy. NOTICE: There is the potential that information presented and exported from the AF Portal contains FOUO or Controlled Unclassified Information (CUI). It is the responsibility of all users to ensure information extracted from the AF Portal is appropriately marked and properly safeguarded. If you are not sure of the safeguards necessary for the information, contact your functional lead or Information Security Officer. - Notwithstanding the above, using this IS does not constitute consent to PM, LE or CI investigative searching or monitoring of the content of privileged communications, or work product, related to personal representation or services by attorneys, psychotherapists, or clergy, and their assistants. Such communications and work product are private and confidential. See User Agreement for details. 
	</center>
	</div>
<?php 
}
else {
    echo "Access denied.";
}
?>
