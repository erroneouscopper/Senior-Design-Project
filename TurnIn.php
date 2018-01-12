<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	echo "Please try again";
}

if(isset($_POST['SubmitButton'])){ 
	$table = 'Tools';

	 $param1 = $_POST['uta_id'];
	 $param2 = $_POST['ToolID'];

  $sql = "UPDATE " . $table . " SET TurnedInBy ='" . $param1 . "' WHERE  ToolID ='". $param2 . "';";
  $sql1 = "UPDATE " . $table . " SET checkedOutTo = 0 WHERE  ToolID ='". $param2 . "';";
  $sql2 = "UPDATE " . $table . " SET CheckOutTime = NOW() WHERE  ToolID ='". $param2 . "';";


$query = mysqli_query($conn, $sql);
$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);

if ($conn->query($sql) == TRUE && $conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE) {
	echo "Updated Successfully <br>";
}
else {
   echo "<p style=color:red;>Invalid ID</p>";
}
}


?>
