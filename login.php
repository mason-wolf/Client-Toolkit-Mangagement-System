<!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!DOCTYPE html>
<link rel='stylesheet' href='default.css' type='text/css'>
<style type="text/css">

body{
  overflow:auto;
}

</style>
<title>Client Systems Inventory Management System (CSIMS) Login</title>
<?php
$connection = mysqli_connect("localhost", "root", "mason.wolf");
$userdb = mysqli_select_db($connection, "accounts");

if(isset($_POST['userLogin'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$admin_query = "SELECT * FROM admins WHERE Username='" . $username . "' AND Password='" . $password . "'";
$result = mysqli_query($connection, $admin_query);
$count = mysqli_num_rows($result);
$admin = mysqli_fetch_assoc($result);
if($count >= 1) {
session_start();
$_SESSION['admin'] = $username;
 Header("Location: /admin/controlpanel.php");
}
else {
$user_query = "SELECT * FROM users WHERE Username='" . $username . "' AND Password='" . $password . "'";
$result = mysqli_query($connection, $user_query);
$count = mysqli_num_rows($result);
if($count == 1) {
session_start();
$_SESSION['user'] = $username;
Header("Location: /tools/controlpanel.php");
}
else {
$invalidCredentials = "Incorrect username or password.";
}
}
}
?>
<div id="container">
  <div id="body">
<div class="registerForm" style="height:225px;color:black;background-color:#F1F2F2;margin-left:325px;margin-top:200px;">
<h3 style="margin-top:30px;font: normal normal 12px/1.2em ASAP, asapregular, verdana, sans-serif;">CST Tools Management Login</h3>
<form action="login.php" method="post" style="margin-left:-25px;margin-top:40px;">
<label>Username:</label> <input type="text" name="username" required></br></br>
<label>Password:</label> <input type="password" name="password" required></br></br>
<input type="hidden" name="userLogin">
<input type="submit" value="Login" style="margin-left:190px;"><a href="/tools/CreateAccount.php" style="margin-left:-50px;">Create Account</a>
</form></br>
<?php if(isset($invalidCredentials)) { echo "<div style='color:red;'> " . $invalidCredentials . "</div>";} ?>
</div>
<div style="width:220px;height:222px;margin-left:775px;margin-top:-227px;background-color:#F1F2F2;padding:0.2em 0.6em;">
<p>The security accreditation level of this site is UNCLASSIFIED//FOUO and below. Do not process, store, or transmit information classified above 
the accreditation level of this system. Privacy Act Information: Information accessed through this system must be protected in 
accordance with the Privacy Act of 1974, as amended, and AFI 33-332</p>
</div>
<div class="footer" style=" 
   position:fixed;
   bottom:0;
   width:100%;
   height:100px;
   color:gray;
   ">
<p> <center>Communications using, or data stored on, this IS are not private, are subject to routine monitoring, interception, and search, and may be disclosed or used for any USG authorized purpose.
- This IS includes security measures (e.g., authentication and access controls) to protect USG interests--not for your personal benefit or privacy.
NOTICE: There is the potential that information presented and exported from the AF Portal contains FOUO or Controlled Unclassified Information (CUI). It is the responsibility of all users to ensure information extracted from the AF Portal is appropriately marked and properly safeguarded. If you are not sure of the safeguards necessary for the information, contact your functional lead or Information Security Officer.
- Notwithstanding the above, using this IS does not constitute consent to PM, LE or CI investigative searching or monitoring of the content of privileged communications, or work product, related to personal representation or services by attorneys, psychotherapists, or clergy, and their assistants. Such communications and work product are private and confidential. See User Agreement for details.
</center>
</p>
</div>
</div>

