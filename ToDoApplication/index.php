<!DOCTYPE HTML>
<html>
<head>
<title>ToDoApplication Landing Page</title>
<style>
div.wrapper{
	width: 900px;
    margin: 0 auto;
	padding: 10px 100px 10px 100px;
	background-color: #e2edff;
}
body {
	background-color: #93bbf9;
}

div.padtext{
	padding-right: 20px;
    display:inline;
}

.divider{
    width:100px;
    height:auto;
    display:inline-block;
}

td {
	padding: 0px 10px 0px 10px;
}

table {
	margin: 0 auto;
}
</style>
</head>
<body>
<div class="wrapper">
<h1>To Do Application List - Keith Zane (FS9346)</h1>
<hr>

<form action="addnewtask.php">
    <input type="submit" value="Add Task" />
</form>
<br>

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
        	echo "<table border=\"1\"><tr><td style=\"width: 300px \">id: " . $row["TaskID"]. " - " . $row["Name"] . "</td><td><a href=\"viewtask.php?id=".$row["TaskID"] . "\">View Task</a></td><td>
		<a href=\"remove.php?id=".$row["TaskID"]."\" onclick=\"javascript:return confirm('are you sure you want to delete this?');\">Delete Task</a></td></tr></table>";
    	}
	}
	
	echo "<h3>Archived</h3>";
	
	$sqlarch = "SELECT TaskID, Name FROM TaskList where StatusID = 4";
	$resultarch = $conn->query($sqlarch);
	
	if ($resultarch->num_rows > 0) {
    	// output data of each row
    	while($rowarch = $resultarch->fetch_assoc()) {
        	echo "<table border=\"1\"><tr><td style=\"width: 300px \">id: " . $rowarch["TaskID"]. " - " . $rowarch["Name"] . "
		</td><td><a href=\"viewtask.php?id=".$rowarch["TaskID"] . "\">View Task</a></td><td>
		<a href=\"remove.php?id=".$rowarch["TaskID"]."\" onclick=\"javascript:return confirm('are you sure you 		want to delete this?');
		\">Delete Task</a></td></tr></table>";
    	}
	} else {
    		echo "0 results";
	}
	
	$conn->close();


	?>
</div>
</body>
</html>