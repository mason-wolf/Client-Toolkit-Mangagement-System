
<title>CSTT - Tools Administration Panel</title>
<?php
session_start();

if(isset($_SESSION['admin'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');
$toolsQuery = "SELECT * FROM tools";
$toolsQuery_result = mysqli_query($connection, $toolsQuery);

	// Retrieve the numbers of kits already created and let user know "There are currently x kits."
	$kitCountQuery = "SELECT kitCount FROM settings";
	$kitCountQuery_Result = mysqli_query($connection, $kitCountQuery);
	$kitCount = mysqli_fetch_assoc($kitCountQuery_Result);
	$TotalKits = $kitCount['kitCount'];
	if($TotalKits == "") {
		$SetDefaultKitCount_Query = "INSERT INTO settings (kitCount) VALUES ('0')";
		$DefaultKitCount = mysqli_query($connection, $SetDefaultKitCount_Query);
		Header('Location:AddKit.php');
	}
	// When the 'add' button is clicked
 if(isset($_POST['inputs'])) {
	$date = date("F j, Y");
	$myInputs = $_POST["inputs"];
	$kitNumber = $_POST["kitNumber"];
	// Retrieve number of kits again.. 
	$kitCountQuery = "SELECT kitCount FROM settings";
	$kitCountQuery_Result = mysqli_query($connection, $kitCountQuery);
	$kitCount = mysqli_fetch_assoc($kitCountQuery_Result);
	$count = $kitCount['kitCount'];
	
	if($kitNumber <= $count) {
		foreach($myInputs as $key=>$inputs) {
			$query = "INSERT INTO kit_" . $kitNumber . " (contents, kitNumber, assignedDate, lastInspectionDate) VALUES ('" . $inputs . "</br>', '" . $kitNumber . "',
		'" . $date . "', '" . $date . "')";
		$qr = mysqli_query($connection, $query);
		Header("Location: kitmanager.php");
		}
			
	}
	else {
		$length = count($myInputs);
		$date = date("F j, Y");
		$myInputs = $_POST["inputs"];
		$CreateKitQuery = "CREATE TABLE kit_" . $kitNumber . " (kitNumber int(255), assignedDate text, lastInspectionDate text, contents text)";
		$CreateKitQuery_Result = mysqli_query($connection, $CreateKitQuery);
	foreach($myInputs as $key=>$inputs) {
		$query = "INSERT INTO kit_" . $kitNumber . " (contents, kitNumber, assignedDate, lastInspectionDate) VALUES ('" . $inputs . "</br>', '" . $kitNumber . "',
		'" . $date . "', '" . $date . "')";
		$qr = mysqli_query($connection, $query);
		$KitCountUpdateQuery = "UPDATE settings SET kitCount = ". $kitNumber;
		$KitCountUpdateQuery_Result = mysqli_query($connection, $KitCountUpdateQuery);
		Header("Location: kitmanager.php");
	}
}

}
?>

<?php include('header.php'); ?>
<script type='text/javascript'>//<![CDATA[ 
    $(window).load(function(){
    $('#inventory').click(function(){
    $('#inventory option:selected').appendTo('#kit');
});

$('#kit').click(function(){
    $('#kit option:selected').appendTo('#inventory');
});

});//]]>  

function getValues() {
	var kitNumber = document.getElementById("kitNumber").value;
	if(kitNumber == "") {
		return;
	}
	else {
    var x = document.getElementById("kit");
    var txt = "";
    var i;
    for (i = 0; i < x.length; i++) {
        txt = txt + "," + x.options[i].value;
    }
	var array = txt.split(",");

for(i = 1; i < array.length; i++) {
 var newdiv = document.createElement('div');
 newdiv.innerHTML = "<br><input type='hidden' name='" + "inputs[]" + "' value='" + array[i] + "'>";
 document.getElementById("tools").appendChild(newdiv);

	}
}
}
</script>
<div class="addTool" style="height:350px;">
<?php echo "<span style='margin-left:300px;'>There are currently " . $TotalKits  . " kits.</span>"?>
<b></b>
<form action="AddKit.php" method="POST" class="addToolForm">
<div id="tools">
<center><span style="color:red;"> <?php if(isset($ExistingKit)) { echo $ExistingKit; } ?>
</center></br></br>
<label>Kit Number:</label> <input type="text" id="kitNumber"name="kitNumber" style="width:25px;" required></br></br>
<label>Available Inventory:</label> 

<select size=10 id="inventory" style="width:200px;">
<?php while($row = mysqli_fetch_assoc($toolsQuery_result)) {
echo "<option> " . $row['itemName']  . "</option>";
}
?>
</select>
<label style="margin-top:-165px;margin-left:300px;">Kit Contents:</label>
<select size=10 style="margin-top:-165px;margin-left:560px;width:200px;" id="kit">
</select>
<input type="submit" value="Add" style="margin-left:360px;margin-top:20px;" onclick="getValues()">
</form>
</div>
</div>
<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>