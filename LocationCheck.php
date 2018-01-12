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
  
   $dt = $_POST['uta_id'];
   $box = $_POST['box'];
   $drawer = $_POST['draw'];

$qr = $conn->query("Select LocationCheck('".$dt."', '".$box."', '".$drawer."')");
$sql = "SELECT ToolID FROM Tools WHERE ToolID ='". $dt . "'";
$query = mysqli_query($conn, $sql);

if( !$qr)
  die(mysqli_error($conn));


if ($query->num_rows > 0) {
  
   echo "<tr>";
        while ($row = $qr->fetch_assoc())
    {
  
       echo "<tr>";

          foreach($row as $value)
          {
              echo "<td>".$value."</td>";
          }

      echo "</tr>";
            
    }

    echo "<tr>";

}
else {

      echo "<p style=color:red;>Invalid ID</p>";
 }



}
   

?>
