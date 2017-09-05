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
	$duedate = date("Y-m-d",strtotime($_GET['duedate']));
	$date=date("Y-m-d");
	$sql = "Insert into TaskList (name, description, CreationDate, DueDate, statusid) values ('" . $_GET['name'] . "', '" .$_GET['description'] . "', '"  . $date . "', '" . $duedate . "','" . $_GET['status'] . "')";
	$conn->query($sql);	
	
	$maintaskId = mysqli_insert_id($conn);
	
	for($i = 1; $i <= (int)$_GET['sublistcount'] ; $i++){
		$sql = "Insert into subtasklist (maintaskid, name, description, statusid) values ('" .$maintaskId ."','" . $_GET['subtaskname'.$i] . "', '" .  $_GET['subtaskdescription'.$i] . "', '" .  $_GET['subtaskstatus'.$i] . "')";
		$conn->query($sql);
	}

?>
</body>