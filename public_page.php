<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
  echo "Please try again";
}

if (isset( $_POST['order'] )) {
     $sql = 'SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools';
     $input = $_POST['order'];
     if ($input == 'availability') {
        $sql .= ' WHERE checkedOutTo = 0';
     }
     else {

        $sql = "SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools WHERE
    (
        ToolType LIKE '%".$input."%'
    )";

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

  $sql = "SELECT Name, checkedOutTo, CheckOutTime, ToolType FROM Tools WHERE checkedOutTo != 0;";
  $query = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <meta http-equiv="refresh" content="30"> -->
        <!-- Tab will show FabLab icon (shortcut icon) -->
        <link rel="shortcut icon" href="http://fablab.uta.edu/sites/default/files/FabLab_Favicon.png" type="image/png">
        <!-- Title name of website on the tab -->
        <title>Public Page | UTA Fablab</title>
        
        <link type="text/css" rel="stylesheet" href="style1.css" media="all" />
        <link type="text/css" rel="stylesheet" href="style4.css" media="all" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
       function autoRefresh_div()
       {
            $("#result").load("scriptLoad.php");// a function which will load data from other file after x seconds
        }
       
        setInterval('autoRefresh_div()', 30000); // refresh div after 5 secs
        </script>
              
          </head>
    
    
    
    
    <body class="html not-front not-logged-in no-sidebars page-user">
        <div id="skip-link">
            <a href="#main-content" class="element-invisible element-focusable">Skip to main content</a>
        </div>
        
        <section class="main-container container-fluid">
            <div class="col-sm-offset-2 col-sm-10 col-xs-offset-1" id="internal-page-push">   
            </div>
            
            <div id="uta-logo">
                <div id="uta-logo-img">
                    <a href="http://www.uta.edu/">
                        <img src="/scanners/UTAlogo.png" alt="The University of Texas at Arlington" /></a>
                </div>
            </div>
            
            
            <header id="navbar" role="banner" class="navbar container-fluid navbar-default">
                <div class="container-fluid">
                
                    <div class="navbar-header">
                        <a class="logo navbar-btn pull-left" href="/" title="Home">
                            <img src="http://fablab.uta.edu/sites/default/files/FLlogo_260.png" alt="Home">
                        </a>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
          <!-- .btn-navbar is used as the toggle for collapsed navbar content -->



                <div class="navbar-collapse collapse">
                    <nav role="navigation">
                        <ul class="menu nav navbar-nav">

                                <form class="select-box" name="sort" action="" method="post">
                                    <select id="soflow" name="order" onchange="this.form.submit()" >
                                        <option class="dropdown-menu" value="choose">Browse</option>
                                        <optgroup label="Tool Type">
                                            <?php
                                            $sqlo = 'SELECT T_type FROM ToolType;';
                                            $queryo = mysqli_query($conn, $sqlo);
                                            while ($row = $queryo->fetch_assoc())
                                            {
                                              echo '<option value="'.$row['T_type'].'">'.$row['T_type'].'</option>';

                                            }
                                            ?>
                                      </optgroup>
                                      <optgroup label="Availability">
                                       <option class="last leaf" value="availability">Tools Available</option>
                                    </optgroup>
                                    </select>
                                    
                                </form>
                            
                        </ul>
                        
                        
                        
                        <ul class="menu nav navbar-nav">
                            <form class="search-form" action="" method="post">
                                <input class="search-box-input" type="text" name="search"  placeholder="Search by keyword">
                                <button class="search-box-button" name="searchSubmit">&#128269;</button>
                            </form>
                        </ul>


                        <ul class="menu nav navbar-nav secondary">
                            <li class="last leaf"><a href="/scanners/staff_login.html">Staff Login</a></li>
                        </ul>
                    </nav>
                    </div>
                </div>
            </header>
            
            
          <div id="result">
            
            <table class="data-table" border="0" cellpadding="10" cellspacing="1" width="800" align="center">
                    
      
                
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
                <th>Tool Type</th>
                <th>Status</th>
                <th>Estimate Return</th>
              </tr>
            </thead>

            <?php
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

                    if ($remainingTime == 155  && ($checked != 0)) {

                      $to = 'singhaniashriya25@gmail.com';
                      $subject = 'Test email'; 
                      $message = "Hello World!\n\nThis is my first mail."; 
                      $headers = "From: singhaniashriya25@gmail.com\r\nReply-To: singhaniashriya25@gmail.com";
                      $mail_sent = @mail( $to, $subject, $message, $headers );
                      echo $mail_sent ? "Mail sent" : "Mail failed";


                    }

                  echo "</tr>";
                }
                }


                
                ?>
                
            </tbody>
        </table>

        </div>
            
            
            
            
        </section>
    </body>
</html>







<style>
    
    .search-form{
        margin-top: 8px;
        margin-bottom: 2px;
        margin-left: 50px;
        margin-right: auto;
        height: 7px;
        display: inline-flex;
        font-size: 15px;
    }
    
    
    .search-box-input{
        font-size: inherit;
    }
    
    .search-box-button{
        margin-top: 4.45px;
        margin-bottom: 0px;
        margin-right: auto;
        height: 32px;
        font-size: 15px;
        
        font-size: inherit;
        /* padding: 0 0.50em; */
        border-left: 0;
        outline: 0;
        font-weight: bold;
        cursor: pointer;
    }
    
    input[type=text]{
        padding: 10px 15px;
        
        margin-top: 5px;
        line-height: 15px;

        outline: none;
        width: 150px;
        height: inherit;
        -webkit-transition: width 0.7s ease-in-out;
        -moz-transition: width 0.7s ease-in-out;
        -ms-transition: width 0.7s ease-in-out;
        -o-transition: width 0.7s ease-in-out;
        transition: width 0.7s ease-in-out;
    }
    
    input[type=text]:focus{
        width: 300px; 
    }
    
    
    button{
    }
    
    
</style>








<style>
    
    select#soflow{
        -webkit-appearance: button;
       -webkit-border-radius: 2px;
       -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
       -webkit-padding-end: 20px;
       -webkit-padding-start: 2px;
       -webkit-user-select: none;
        background-image: url(http://i62.tinypic.com/15xvbd5.png), 
        -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
       background-position: 97% center;
       background-repeat: no-repeat;
       border: 1px solid #AAA;
       color: #555;
       font-size: inherit;
       margin: 5px;
       overflow: hidden;
       padding: 5px 10px;
       text-overflow: ellipsis;
       white-space: nowrap;
       width: 150px;
}
    
    .select-box{
        margin-top: 8px;
        margin-bottom: 2px;
        margin-left: 40px;
        margin-right: auto;
        height: 25px;
        /* display: inline-flex; */
        font-size: 15px;
        line-height: 20px;
    }




</style>







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
        margin-top: 200px;
        margin-bottom: 50px;
        font-family: verdana, sans-serif;
        font-size: 12px;
        text-align: center; 
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
      font-size: 13px;
      min-width: 537px;
    }

    .data-table th, .data-table td {
        border: 1px solid #e1edff;
        padding: 7px 17px;
        text-align: center;
    }

    .data-table caption {
      margin: 7px;
    }

    /* Table Header */
    .data-table thead th {
        font-size: 18px;
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

    .data-table tbody td:empty {
      background-color: grey;
    }

</style>
        