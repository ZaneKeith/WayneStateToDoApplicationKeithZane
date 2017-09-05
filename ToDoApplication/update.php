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
	
	$sql = "UPDATE TaskList SET Name = '" . $_GET['name'] . "', Description='". $_GET['description'] . "', DueDate='". $duedate . "', StatusID='". $_GET['status'] . "' where TaskID = '" . $_GET['id'] ."'";
			
	$thisstatus = $_GET['statuscount'];


		
	for($i = 1; $i<= $thisstatus; $i=$i+1){
		if($_GET['subtaskid'.$i] == ""){
			$insertsql = "Insert into subtasklist (Maintaskid, Name, Description, StatusID) values ('".$_GET['id']."', '" . $_GET['subtaskname'.$i] . "', '" .$_GET['subtaskdescription'.$i]. "', '" .$_GET['subtaskstatus'.$i] . "')";
			$conn->query($insertsql);
		}
		else
		{
		$updatesql = "UPDATE subtasklist set Name = '" .$_GET['subtaskname'.$i] . "', Description = '" .$_GET['subtaskdescription'.$i]. "', StatusID = '" .$_GET['subtaskstatus'.$i] . "' where subtaskid = '" .$_GET['subtaskid'.$i] . "'";
		$conn->query($updatesql);
		}
	}
			
	if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	} else {
    echo "Error updating record: " . $conn->error;
	}

?>
</body>