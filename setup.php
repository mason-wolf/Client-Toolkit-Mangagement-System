<link rel='stylesheet' href='default.css' type='text/css'>
<title>CSTT First Time Set-Up</title>
<?php


$connection = mysqli_connect("localhost", "root", "mason.wolf");
$userdb = mysqli_select_db($connection, "accounts");
session_start();

if(!$connection) {

header("location: dberror.php");
}

if(isset($_SESSION['admin'])) {
?>
<div class="registerForm" style="background-color:white;">
<h3>Create Administrator Account</h3>
<form action="/admin/administrator.php" method="post">
<label>Username: </label><input type="text" name="username" required></br></br>
<label>Password:</label> <input type="password" name="password" required></br></br>
<input type="hidden" name="adminRegister">
<input type="submit" value="Submit" style="margin-left:250px;"> 
</form>
</div>

<?php
session_destroy();
}
else {
echo "<span style='color:red;font-weight:bold;'>You do not have permission to access this page.</span>";
}

?>