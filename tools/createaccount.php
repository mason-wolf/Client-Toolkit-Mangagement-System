<!DOCTYPE html>
<link rel='stylesheet' href='../default.css' type='text/css'>
<title>CSTT - Create Account</title>
<?php

$connection = mysqli_connect("localhost", "root", "mason.wolf");
$userdb = mysqli_select_db($connection, "accounts");

if(isset($_POST['userRegistration'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['FirstName'];
$lastname = $_POST['LastName'];
$registerQuery = "INSERT INTO users (Username, Password, FirstName, LastName, AssignedKit) 
VALUES ('" . $username . "', '". $password . "', '" . $firstname . "' , '" . $lastname . "', 'kit_1')";
$registerResult = mysqli_query($connection, $registerQuery);

Header("Location:../Login.php");
}

?>
<div class="registerForm" style="height:200px;background-color:#F1F2F2;">
<?php if(isset($ErrorMessage)) { echo $ErrorMessage; } ?>
<h3>Create Account</h3>
<form action="CreateAccount.php" method="post">
<label>Username:</label> <input type="text" name="username" required></br></br>
<label>Password:</label> <input type="password" name="password" required></br></br>
<label>First Name:</label> <input type="text" name="FirstName" required></br></br>
<label>Last Name:</label> <input type="text" name="LastName" required></br></br>
			  
<input type="hidden" name="userRegistration">
<input type="submit" value="Submit" style="margin-left:250px;"> <a href="login.php" style="margin-left:-50px;">Login</a>
</form>
</div>
<div style="width:200px;margin-left:950px;margin-top:-200px;background-color:#F1F2F2;padding:0.2em 0.6em;">
<p><span style="color:red;">NOTICE! -- </span> This system does not utilize any method of certificate validation
or authentication routes. You are responsible for having integrity and only signing on with your credentials only.
Do not perform tool inventory for another technician and refrain from asking for, obtaining or using another account.

</p>
</div>

