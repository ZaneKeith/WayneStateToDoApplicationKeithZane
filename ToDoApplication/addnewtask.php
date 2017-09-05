<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

	
	<form action="insert.php" id="insertForm">
	Task Name: <input type="text" name="name" value="" required /> <br><br>
	Description: <textarea rows="4" cols="50" name="description" form="insertForm"></textarea> <br><br>
	Due Date: <input type="date" name="duedate"> <br><br>
	Status: 
	<select name="status" form="insertForm">
		<?php
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
        	print "<option value=\"" .$row["StatusID"] . "\">" .$row["Status"] . "</option>";
		}
		
		?>
	</select>
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
	<br>
	<input type="button" id="buttonadd" value="Add" onclick="addItem()">
	<br><br>
	<p id="sublist"></p>
	<input type="hidden" id="sublistcount" name="sublistcount" form="insertForm" value="0"></input>
	<br><br>
	<input type="submit" value="Add Task" />
	<a href="index.php" onclick="javascript:return confirm('Do you want to return without saving?');">
		<input type="button" value="Cancel" />
	</a>
	</form>
	
	<script>
	var count = 1;
		
    function addItem(){
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
		
        li.innerHTML = "<input type=\"hidden\" name=\"subtask" + window.count + "\">Name: <input type=\"text\" name=\"subtaskname" + window.count + "\" required>Description: <textarea rows=\"4\" cols=\"50\" name=\"subtaskdescription" + window.count + "\" form=\"insertForm\"></textarea> Status: <select name=\"subtaskstatus" + window.count + "\"form=\"insertForm\">" +optionshtml + "</select>";
		
		//li.innerHTML = li.innerHTML + "</select>";
        document.getElementById("sublist").appendChild(li);
		document.getElementById("sublistcount").value = window.count;
		count = count + 1;
    }
	</script>
</body>
</html>
