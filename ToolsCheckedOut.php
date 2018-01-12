<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	echo "Please try again";	
}



 $sql = "SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools WHERE checkedOutTo != 0;";
  $query = mysqli_query($conn, $sql);
if (!$query) {
  echo "Please try again";
}



?>
<html>
<head>
    
  <title>Employee Page</title>
  
</head>
     
<body>
  
  <table class="data-table" border="0" cellpadding="10" cellspacing="1" width="800" align="center" >
    <caption class="title">Tools</caption>
    
      
      <tbody> 
                <?php

                if (!$query) {
                  echo "<tr>";
                  echo "<td>Something went wrong! Please try again</td>";
                  echo "</tr>";
                }
                else{ ?>
       <thead>
                <tr>
                    <th>Tool Name</th>
                    <th>Checked out to</th>
                    <th>Estimated Return</th>
                </tr>
            </thead>

                  <?php

                   if ($query->num_rows > 0){ 
                        while ($row = $query->fetch_assoc()){

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
                          echo "<td>".$row['checkedOutTo']."</td>";

                          if ($checked != 0) {
                            //echo "<td>".$loaned."</td>";
                            if ($minutes >= 180){
                              echo "<td> <span style=color:#F00;text-align:center;>".$message."</td>";
                          }
                            else {
                              echo "<td>".$remainingTime."mins </td>";
                            }
                          }
                          else {
                            //echo "<td>".$notCheckedOut."</td>";
                            echo "<td>".$hypen."</td>";
                          }


                        echo "</tr>";
                      }
                  }
                  else{
                    $message = "No tools checked out yet";
                    echo "<center><td>".$message."</td></center>";
                  }

                }



                
                ?>
                
            </tbody>
    </table>
    </body>
</html>







<style type="text/css">
    body {
      font-size: 15px;
      color: black;
      font-family: verdana, sans-serif;
      padding: 0;
      margin: 0;
    }
    
    table {
        margin: auto;
        margin-top: 0px;
        margin-bottom: 10px;
        margin-left: 0px;
        
        padding-right: 0px;
        
        font-family: verdana, sans-serif;
        font-size: 12px;
        text-align: center;
    
    }

  

    table td {
      transition: all .5s;
    }
    
    /* Table */
    .data-table {
      border-collapse: collapse;
      font-size: 12px;
      min-width: 300px;
        text-align: center;
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
        font-size: 14px;
      background-color: lightslategrey;
      color: skyblue;
      border-color: white!important;
      text-transform: uppercase;
    }

    /* Table Body */
    .data-table tbody td {
      color: white;
        background-color: grey;
    }
    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),
    .data-table tbody td:last-child {
      text-align: center;
    }

    .data-table tbody tr:nth-child(odd) td {
      background-color: grey;
    }
   

    /* Table Footer */
    .data-table tfoot th {
      background-color: grey;
      text-align: center;
    }
    .data-table tfoot th:first-child {
      text-align: center;
    }
    
    
    .data-table tbody td:empty{
      background-color: grey;
    }
    
    
  </style>