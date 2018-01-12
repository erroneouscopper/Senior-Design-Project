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
   
  $sql = "SELECT ToolID FROM Tools AS T, Person AS P WHERE P.PersonID ='" . $param1 . "' AND T.checkedOutTo = P.PersonID;";
  $query = mysqli_query($conn, $sql);

  if (!$query) {
  echo "Please try again";
}
else {
  if ($query->num_rows > 0) {
  while ($row = $query->fetch_assoc())
    {
             
              echo $row['ToolID'];
              echo "</br>";
    }
  }
  else {
      echo "<p style=color:red;>No tools found</p>";
  }

}
  //SELECT ToolID FROM Tools AS T, Person AS P WHERE P.PersonID = 1000500001 AND T.checkedOutTo = P.PersonID;
}

?>
