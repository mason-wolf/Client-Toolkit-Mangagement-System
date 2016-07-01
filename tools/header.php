<!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<?php

if(isset($_SESSION['user']) || isset($_SESSION['admin'])) {
$Accounts = mysqli_connect("localhost", "root", "mason.wolf", "accounts");
$UserQuery = "SELECT * FROM users WHERE Username='" . $_SESSION['user'] . "'";
$UserQueryResult = mysqli_query($Accounts, $UserQuery);
$User = mysqli_fetch_assoc($UserQueryResult);
?>
<link rel='stylesheet' href='../default.css' type='text/css'>
<script src="jquery.min.js"></script>
<title>Client Systems Tools Control Panel</title>
<div class="header">
<h1 class="title">CST Tools Management</h1>
<div style="margin-top:60px;">
<a href="ControlPanel.php">Overview</a> | <a href="ViewKits.php">View Kits</a> |
<a style='color:green;' href="Inventory.php?technician=<?php echo $User['LastName']; ?>">Conduct Inventory</a>

</div>
<span style="float:right;margin-top:-60px;font-size:12px;"><?php if(isset($_SESSION['user'])) {echo $_SESSION['user']; }?>
</br><a href='../logout.php'>Logout</a>
</span>
<span style="float:right;margin-top:-20px;">
<form method="GET" action="SearchResults.php">
<input type="text" name="keyword" id="keyword">
<input type="submit" value="Search">
</form>
</div>
<?php
}
else {
echo "<span style='color:red;'>You do not have access to this page.</span>";
}
?>