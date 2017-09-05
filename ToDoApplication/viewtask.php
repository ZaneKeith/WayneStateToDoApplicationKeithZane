<!DOCTYPE HTML>	
<html>
<head>
</head>
<body>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ToDoApplication";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT TaskID, Name, Description, DueDate, StatusID FROM TaskList where TaskID = " .$_GET['id'];
	$result = $conn->query($sql);
	
	$row = $result->fetch_assoc();
	
	print 	
	"<form action=\"update.php\">
	<input type=\"hidden\" name=\"id\" value=\"" .$_GET["id"]."\">
	Task Name: <input type=\"text\" name=\"name\" value=\"" . $row["Name"]. "\" required />
	<br><br>
	<input type=\"submit\" value=\"Update Task\" />
	<a href=\"index.php\" onclick=\"javascript:return confirm('Do you want to return without saving?');\">
		<input type=\"button\" value=\"Cancel\" />
	</a>
	</form>"

	

?>

	


</body>
</html>