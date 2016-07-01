<link rel='stylesheet' href='style.css' type='text/css'>
<title>CSTT - First Time Set-Up</title>
<?php
$connection = mysqli_connect("localhost", "root", "mason.wolf");
$userdb = mysqli_select_db($connection, "accounts");
session_start();

if(isset($_POST['adminRegister'])) {
$username = $_POST['username'];
$password = $_POST['password'];

$registerQuery = "INSERT INTO admins (Username, Password) VALUES ('" . $username . "', '". $password . "')";
$registerResult = mysqli_query($connection, $registerQuery);
if(!$registerResult) { 
echo "<div class='registerForm'><br><br><br>Error creating account.</div>";
}
else {
echo "<div class='registerForm'><br><br><br>Administrator successfully created.</br> <a href='../login.php'>Login</a></div>";
}
}
else {

echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>