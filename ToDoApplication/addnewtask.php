<!DOCTYPE HTML>
<html>
<head>
<title>ToDoApplication Add Task</title>
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

div.centerbuttons{
	width: 200px;
	margin: 0 auto;
}

.divider{
    width:100px;
    height:auto;
    display:inline-block;
}
</style>
</head>
<body>
<div class="wrapper">
	<h1>Add A New Task</h1>
	<hr>
	<form action="insert.php" id="insertForm">
	<table>
	<tr><td>Task Name:</td><td> <input type="text" name="name" value="" required /></td></tr>
	<tr><td>Due Date:</td><td> <input type="date" name="duedate"></td><td>
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
	</select></td></tr>
	<tr><td>Description:</td><td><textarea rows="4" cols="50" name="description" form="insertForm"></textarea></tr></td></table>
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
	<p>Subtasks <input type="button" id="buttonadd" value="Add Subtask" onclick="addItem()" style="float: right;"></p>
	<hr>
	
	<br>
	<p id="sublist"></p>
	<input type="hidden" id="sublistcount" name="sublistcount" form="insertForm" value="0"></input>
	<br><br>
	<div class="centerbuttons">
	<input type="submit" value="Add Task" />
	<a href="index.php" onclick="javascript:return confirm('Do you want to return without saving?');">
		<input type="button" value="Cancel" />
	</a>
	</div>
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
		
        li.innerHTML = "<input type=\"hidden\" name=\"subtask" + window.count + "\">Name: <input type=\"text\" name=\"subtaskname" + window.count + "\" required> Description: <textarea rows=\"2\" cols=\"50\" name=\"subtaskdescription" + window.count + "\" form=\"insertForm\"></textarea> Status: <select name=\"subtaskstatus" + window.count + "\"form=\"insertForm\">" +optionshtml + "</select>";
		
		//li.innerHTML = li.innerHTML + "</select>";
        document.getElementById("sublist").appendChild(li);
		document.getElementById("sublistcount").value = window.count;
		count = count + 1;
    }
	</script>
</div>
</body>
</html>
