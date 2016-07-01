<?php

// Database: accounts
// Tables: admins, users
// (admins) ID, username, password
// (users) ID, FirstName, LastName, Username,
//  Password, AssignedKit, InspectionDate


// Database: inventory
// Tables: reports, settings, tools
// (reports) ID, User, Inventory 'text', comments 'text'
// (settings) kitCount
// (tools) ID, itemName 'text', partNumber, manufacturer,
// description 'text', quantity, imageFileName, fileFormat

	

$connection = mysqli_connect("localhost", "root", "mason.wolf");
$userdb = mysqli_select_db($connection, "accounts");
$first_time_setup = "SELECT * FROM admins";
$ftsetup_query = mysqli_query($connection, $first_time_setup);
$currentUsers = mysqli_num_rows($ftsetup_query);
if($currentUsers == 0) {

 session_start();
 $_SESSION['admin'] = 'admin';
 Header("Location:setup.php");

}

else {

Header("Location:login.php");

}


