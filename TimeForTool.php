<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

//Set up a database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
  echo "Please try again";
}


if (isset( $_POST['order'] )) {
 $sql = 'SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools';
    switch( $_POST['order'] ){
        case 'toolType':
            $sql .= ' ORDER BY ToolType ASC';
            break;
        case 'availability':
            $sql .= ' WHERE checkedOutTo = 0';
            break;

    }
    $query = mysqli_query($conn, $sql); 
 }
 else if(isset( $_POST['searchSubmit'] )){
  $keyword = $_POST['search'];
  $sql = "SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools WHERE
(
    Name LIKE '%".$keyword."%'
)";

$query = mysqli_query($conn, $sql);

 }
 else {   

  $sql = "SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools;";
  $query = mysqli_query($conn, $sql);
}

if (!$query) {
  die ('SQL Error: ' . mysqli_error($conn));
}



?>
<html>
<head>
  <title>Displaying MySQL Data in HTML Table</title>
  
  <style type="text/css">
    body {
      font-size: 15px;
      color: #343d44;
      font-family: "segoe-ui", "open-sans", tahoma, arial;
      padding: 0;
      margin: 0;
    }
    table {
      margin: auto;
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      font-size: 12px;
    }

    h1 {
      margin: 25px auto 0;
      text-align: center;
      text-transform: uppercase;
      font-size: 17px;
    }

    table td {
      transition: all .5s;
    }
    
    /* Table */
    .data-table {
      border-collapse: collapse;
      font-size: 14px;
      min-width: 537px;
    }

    .data-table th, 
    .data-table td {
      border: 1px solid #e1edff;
      padding: 7px 17px;
    }
    .data-table caption {
      margin: 7px;
    }

    /* Table Header */
    .data-table thead th {
      background-color: #508abb;
      color: #FFFFFF;
      border-color: #6ea1cc !important;
      text-transform: uppercase;
    }

    /* Table Body */
    .data-table tbody td {
      color: #353535;
    }
    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),
    .data-table tbody td:last-child {
      text-align: right;
    }

    .data-table tbody tr:nth-child(odd) td {
      background-color: #f4fbff;
    }
    .data-table tbody tr:hover td {
      background-color: #ffffa2;
      border-color: #ffff0f;
    }

    /* Table Footer */
    .data-table tfoot th {
      background-color: #e5f5ff;
      text-align: right;
    }
    .data-table tfoot th:first-child {
      text-align: left;
    }
    .data-table tbody td:empty
    {
      background-color: #ffcccc;
    }
  </style>

</head>
<body>

<form name="sort" action="" method="post">
<select name="order">
   <option value="choose">Make A Selection</option>
   <option value="toolType">ToolType</option>
   <option value="availability">Availability</option>
</select>
<input type="submit" value=" - Sort - " />
</form>

<form action="" method="post">
        <input type="text" name="search" class='auto' />
        <input type="submit" name="searchSubmit" value="Search" />
</form>

  <h1>Table 1</h1>
  <table class="data-table">
    <caption class="title">Tools</caption>
    <thead>
      <tr>
        <th>Tool Name</th>
        <th>Tool Type</th>
        <th>Status</th>
        <th>Estimate Return</th>
        
      
      </tr>
    </thead>
    <tbody>
    <?php
   

    while ($row = $query->fetch_assoc())
    {
  
       echo "<tr>";

        $date1 = new DateTime();

        $date2 = new DateTime($row['CheckOutTime']);

        $diff = $date2->diff($date1);
        $minutes = $diff->days * 24 * 60;
        $minutes += $diff->h * 60;
        $minutes += $diff->i;

        //$hours = $diff->h;
       // $hours = $hours + ($diff->days*24);
        $message = "Overdue";
        $notCheckedOut = "Available";
        $loaned = "Loaned";
        $remainingTime = 180 - $minutes;
        $checked = $row['checkedOutTo'];
        $hypen = "-";
        date_default_timezone_set('America/Chicago');
       
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['ToolType']."</td>";

        if ($checked != 0) {
          echo "<td>".$loaned."</td>";
          if ($minutes >= 180){
            echo "<td> <span style=color:#F00;text-align:center;>".$message."</td>";
        }
          else {
            echo "<td>".$remainingTime."mins </td>";
          }
        }
        else {
          echo "<td>".$notCheckedOut."</td>";
          echo "<td>".$hypen."</td>";
        }

        if ($minutes == 30  && ($checked != 0)) {

          $to = 'singhaniashriya25@gmail.com';
          $subject = 'Test email'; 
          $message = "Hello World!\n\nThis is my first mail."; 
          $headers = "From: singhaniashriya25@gmail.com\r\nReply-To: singhaniashriya25@gmail.com";
          $mail_sent = @mail( $to, $subject, $message, $headers );
          echo $mail_sent ? "Mail sent" : "Mail failed";
          

        }
       
      echo "</tr>";
            
    }?>
    </tbody>
    
  </table>

  
</body>
</html>