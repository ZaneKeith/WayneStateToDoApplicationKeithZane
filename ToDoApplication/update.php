<!DOCTYPE HTML>
<html>
<head>
</html><meta http-equiv="refresh" content="0; url=index.php" />
</head>
<body>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ToDoApplication";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "UPDATE TaskList 
			SET Name = '" . $_GET['name'] . "'where TaskID = '" . $_GET['id'] ."'";
			
	if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	} else {
    echo "Error updating record: " . $conn->error;
	}

?>
</body>