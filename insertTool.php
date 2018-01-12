<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	echo "Please try again";
}
$table = 'Tools';
	$param1 = $_POST['toolid'];
	$param2 = $_POST['name'];
	$param3 = $_POST['toolType'];
	$param4 = $_POST['number'];
	$param5 = $_POST['box'];
	$param6 = $_POST['drawer'];
	$param7 = $_POST['notes'];
	
	$sql = "INSERT INTO " . $table . " (ToolID, Name, ToolType, NumOfPieces, checkedOutTo, TurnedInBy, CheckOutTime, TurnInTime,Box, Drawer, Notes) VALUES ('" . $param1 . "','" . $param2 . "','" . $param3 . "','" . $param4 . "', 0, 0, CURDATE(), CURDATE(),'" . $param5 . "', '" . $param6 . "','" . $param7 . "');";

	$sqlCheck = "SELECT EXISTS (SELECT ToolType FROM Tools WHERE ToolID = '" . $param1 . "';";

	if ($conn->query($sql) === TRUE) {
		
		
			echo $param1 . ", " . $param2 . " entered into table '" . $table . "' successfully<br>";

		
		
	}
	 else {
	 	//$query = mysqli_query($conn, $sqlCheck); 
	 	if ($conn->query($sqlCheck) === TRUE) {

			echo "Error creating record: Please try again<br>";
		}
		else {

			echo $param1 . ", already exists<br>";

		}
		
	}
			

$conn->close();
?>