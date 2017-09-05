<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<h1>To Do Application List - Keith Zane (FS9346)</h1>
<hr>

<form action="addnewtask.php">
    <input type="submit" value="Add Task" />
</form>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ToDoApplication";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT TaskID, Name FROM TaskList where StatusID <> 4";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
        	echo "id: " . $row["TaskID"]. " - " . $row["Name"] . "
		<a href=\"viewtask.php?id=".$row["TaskID"] . "\">View Task</a>
		<a href=\"remove.php?id=".$row["TaskID"]."\" onclick=\"javascript:return confirm('are you sure you 		want to delete this?');
		\">Delete Task</a><br>";
    	}
	} else {
    		echo "0 results";
	}
	
	echo "<h3>Archived</h3>";
	
	$sqlarch = "SELECT TaskID, Name FROM TaskList where StatusID = 4";
	$resultarch = $conn->query($sqlarch);
	
	if ($resultarch->num_rows > 0) {
    	// output data of each row
    	while($rowarch = $resultarch->fetch_assoc()) {
        	echo "id: " . $rowarch["TaskID"]. " - " . $rowarch["Name"] . "
		<a href=\"viewtask.php?id=".$rowarch["TaskID"] . "\">View Task</a>
		<a href=\"remove.php?id=".$rowarch["TaskID"]."\" onclick=\"javascript:return confirm('are you sure you 		want to delete this?');
		\">Delete Task</a><br>";
    	}
	} else {
    		echo "0 results";
	}
	
	$conn->close();


	?>


<p id="demo></p>
</body>
</html>