<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	echo "Please try again";	
}
$table = 'Person';
	$param1 = $_POST['uta_id'];
	$param2 = $_POST['person_type'];
	$sql = "INSERT INTO " . $table . " (PersonID,PersonType) VALUES ( '" . $param1 . "', '" . $param2 . "');";

	if ($conn->query($sql) === TRUE) {
		echo $param1 . ", " . $param2 . " entered into table '" . $table . "' successfully<br>";
	} else {
		echo "Error creating record: Please try again<br>";
	}
			

$conn->close();
?>