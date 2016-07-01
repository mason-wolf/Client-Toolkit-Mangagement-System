<!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<link rel='stylesheet' href='../default.css' type='text/css'>
<script src="../jquery.min.js"></script>
<title>CSTT - Tools Administration Panel</title>
<?php
	if(isset($_SESSION['admin'])) {
	$User = $_SESSION['admin']; }
	else {
	$User = $_SESSION['user'];
	}
	$Account = mysqli_connect("localhost", "root", "mason.wolf", "accounts");
	$UserQuery = "SELECT * FROM users WHERE (Username LIKE '%$User%')";
	$UserQueryResult = mysqli_query($Account, $UserQuery);
	$Username = @mysqli_fetch_array($Account, $UserQueryResult);
	
	?>
<div class="header">
<h1 class="title">CST Tools Management</h1>
<div style="margin-top:60px;">
<a href="/admin/controlpanel.php">Overview</a> | <a href="../admin/AddTool.php">Add Tool</a> | <a href="../admin/AddKit.php">Add Kit</a> |
<a href="../admin/KitManager.php">Kit Manager</a></div>




<span style="float:right;margin-top:-60px;font-size:12px;"><?php if(isset($_SESSION['admin'])) {echo $_SESSION['admin']; }
else { echo $_SESSION['user']; }?>

</br><a href='../logout.php'>Logout</a>
</span>
<span style="float:right;margin-top:-20px;">
<form method="GET" action="../tools/SearchResults.php">
<input type="text" name="keyword" id="keyword">
<input type="submit" value="Search">
</form>
</div>