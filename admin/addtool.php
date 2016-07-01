
<title>CSTT - Tools Administration Panel</title>

<?php
session_start();

if(isset($_SESSION['admin'])) {
$connection = mysqli_connect('localhost', 'root', 'mason.wolf', 'inventory');

// Create an unique file name for the image

function generateFileName($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

// Determine the format of the image to be used in conjuction with the generated filename

function getImageFormat($path) {

$gettype = exif_imagetype($path);
$type = "";
if($type = 1) {
$type = ".gif";
}
else if($type = 2) {
$type = ".jpeg";
}
else if($type = 3) {
$type = ".png"; 
}
else if($type = 6) {
$type = ".bmp";
}

return $type;
}


if(isset($_POST['itemName'])) {

$uploaddir = '..\uploads\\';
$uploadfile = $uploaddir . basename($_FILES['toolImage']['name']);

if (move_uploaded_file($_FILES['toolImage']['tmp_name'], $uploadfile)) {
    $uploadStatus = "<span style='color:green;font-weight:bold;'>Uploaded image successfully.</span>";
} else {
    $uploadStatus = "<span style='color:red;font-weight:bold;'>Error uploading image.</span>";
}
	$itemName = $_POST['itemName'];
	$partNumber = $_POST['partNumber'];
	$manufacturer = $_POST['manufacturer'];
	$description = mysqli_real_escape_string($connection, $_POST['description']);
	$quantity = $_POST['quantity'];
	$imageFileName = generateFileName(20);
	$fileFormat = getImageFormat("..\uploads\\" . basename($_FILES['toolImage']['name']));
	$query = "INSERT INTO tools ( itemName, partNumber, manufacturer, description, quantity, imageFileName, fileFormat )
	VALUES('" . $itemName . "','" . $partNumber . "','" . $manufacturer . "','" . $description
			  . "','" . $quantity . "','" . $imageFileName . "', ' " . $fileFormat . "')";
	$result = mysqli_query($connection, $query);
	// After inserting the randomly generating file name for the image into the database,
	// we're going to pull it and rename the file itself 
	$fileNameQuery = "SELECT imageFileName from tools where itemName = '" . $itemName . "'";
	$fileName = mysqli_query($connection, $fileNameQuery);
	$newFileName = mysqli_fetch_assoc($fileName);
	// Assign the file its new name and previously identified file type
	rename("..\uploads\\" . basename($_FILES['toolImage']['name']) , "..\uploads\\" . $newFileName['imageFileName'] . $fileFormat);
	Header("Location: index.php");
	}

?>

<?php include('header.php'); ?>
<div class="addTool">

<form enctype="multipart/form-data" action="AddTool.php" method="POST" class="addToolForm">
<label>Item Name:</label> <input type="text" name="itemName" style="width:225px;" required></br></br>
<label>Part Number:</label> <input type="text" name="partNumber" style="width:75px;" required></br></br>
<label>Manufacturer:</label> <input type="text" name="manufacturer" required</br></br>
<label>Description:</label> </br>
<textarea rows=15 cols=30 name="description" style="margin-left:10px;" required></textarea></br></br>
<label>Quantity:</label> <input type="text" name="quantity" style="width:30px;"></br></br><br>

    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
	<div class="imageUpload">
    Upload Image:<br><br><input name="toolImage" type="file"/><br></br>
	</div>
<input type="submit" value="Add" style="margin-left:350px;margin-top:20px;">
</form>
</div>

<?php 
}

else {
echo "<span style='color:red;font-weight:bold;'>Access denied. You do not have permissions to access this page.</span>";
}
?>