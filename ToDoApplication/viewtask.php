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
	$idMain = $row["TaskID"];
	$nameMain = $row["Name"];
	$descriptMain = $row["Description"];
	$duedateMain = $row["DueDate"];
	$statusMain = $row["StatusID"];
	
	$sqlstatus = "SELECT Status, StatusID FROM StatusCodes";
	$resultstat = $conn->query($sqlstatus);
	
	$optionshtml = "";
	
	while($rowstat = $resultstat->fetch_assoc()) {
        	$optionshtml = $optionshtml . "<option value=\"" .$rowstat["StatusID"] . "\"";
			
			if($statusMain == $rowstat["StatusID"]){
				$optionshtml = $optionshtml . " selected=\"selected\"";
			}
			
			$optionshtml = $optionshtml . ">" .$rowstat["Status"] . "</option>";
		}
		
	print 	
	"<form action=\"update.php\" id=\"updateForm\">
	<input type=\"hidden\" name=\"id\" value=\"" .$_GET["id"]."\">
	Task Name: <input type=\"text\" name=\"name\" value=\"" . $nameMain . "\" required /> <br><br>
	Description: <textarea rows=\"4\" cols=\"50\" name=\"description\" form=\"updateForm\">" . $descriptMain . "</textarea> <br><br>
	Due Date: <input type=\"date\" name=\"duedate\" value=\"" . $duedateMain . "\"> <br><br>
	Status: 
	<select name=\"status\" form=\"updateForm\">"
	. $optionshtml .
	"</select>"

	

?>
<div id="statuslist" style="display: none;"><?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ToDoApplication";
		$count = 0;

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "SELECT StatusID, Status from Statuscodes";
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc()) {
        	print $row["StatusID"] . "," .$row["Status"] . ";";
		}
		
		?></div>
<input type="button" id="buttonadd" value="Add" onclick="addItem()">
<br><br>
<p id="sublist">
</p>
<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ToDoApplication";
		$count = 0;

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "SELECT Name, Description, StatusID, SubtaskID from subtasklist where maintaskid = " . $_GET["id"];
		$result = $conn->query($sql);
		
		$sqlstatus = "SELECT Status, StatusID FROM StatusCodes";
		$resultstat = $conn->query($sqlstatus);
	
		$optionshtml = "";
	
		
		
		while($row = $result->fetch_assoc()) {
			$count = $count + 1;
        	print "<li><input type=\"hidden\" name=\"subtaskid" . $count . "\" value=\"" . $row["SubtaskID"] . "\">Name: <input type=\"text\" name=\"subtaskname" . $count . "\" required value=\"" . $row["Name"] . "\">Description: <textarea rows=\"4\" cols=\"50\" name=\"subtaskdescription" . $count . "\" form=\"updateForm\">" . $row["Description"] . "</textarea> Status: <select name=\"subtaskstatus" . $count . "\"form=\"updateForm\">"; 
			while($rowstat = $resultstat->fetch_assoc()) {
        	$optionshtml = $optionshtml . "<option value=\"" .$rowstat["StatusID"] . "\"";
			
			if($row["StatusID"] == $rowstat["StatusID"]){
				$optionshtml = $optionshtml . " selected=\"selected\"";
			}
			
			$optionshtml = $optionshtml . ">" .$rowstat["Status"] . "</option>";
			}
			print $optionshtml;
			print "</select></li>";
		}
		
		?>
<br><br>
<input type="submit" value="Update Task" />
<a href="index.php" onclick="javascript:return confirm('Do you want to return without saving?');">
	<input type="button" value="Cancel" />
</a>
<input type="hidden" name="statuscount" id="statuscount" form="updateForm" value ="<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ToDoApplication";
		$count = 0;

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "SELECT Name, Description, StatusID, SubtaskID from subtasklist where maintaskid = " . $_GET["id"];
		$result = $conn->query($sql);
	
		while($row = $result->fetch_assoc()) {
			$count = $count + 1;
		}
		print $count;
		?>"></input>
</form>	

	<script>
	var count = 1;
		
    function addItem(){
		
        var statusnum = parseInt(document.getElementById("statuscount").value, 10);
		count = statusnum;
		count = count + 1;
		
		var changediv = document.getElementById("statuscount").value = count;
		
        var li = document.createElement("LI");
		var thiscountdiv = document.getElementById("statuslist");
		var thistext = thiscountdiv.textContent;
		var optionshtml = "";
		
		var splittext = thistext.split(";");
		var splittextlength = splittext.length;
		var temptext;
		
		for (var i = 0; splittextlength-1> i; i++){
			temptext = splittext[i].split(",");
			optionshtml = optionshtml + "<option value=\"" + temptext[0] + "\">" + temptext[1]+ "</option>";
		}
		
        li.innerHTML = "<input type=\"hidden\" name=\"subtaskid" + window.count + "\">Name: <input type=\"text\" name=\"subtaskname" + window.count + "\" required>Description: <textarea rows=\"4\" cols=\"50\" name=\"subtaskdescription" + window.count + "\" form=\"updateForm\"></textarea> Status: <select name=\"subtaskstatus" + window.count + "\"form=\"updateForm\">" +optionshtml + "</select>";
		
		//li.innerHTML = li.innerHTML + "</select>";
        document.getElementById("sublist").appendChild(li);
		document.getElementById("sublistcount").value = window.count;
    }
	</script>
</body>
</html>