<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="refresh" content="0; url=index.php" />
</head>
<body>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ToDoApplication";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	
	$sql = "delete from subtasklist where maintaskid = '" . $_GET['id'] . "'";
	$conn->query($sql);


	$sql = "delete FROM TaskList where TaskID = '" . $_GET['id'] . "'";
	$conn->query($sql);
	
?>
</body>
</html>