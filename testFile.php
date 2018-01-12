<?php
session_start();
if (!isset($_SESSION['netid']) )
{
header('Location: staff_login.html');
}
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
  echo "Please try again"; 
}

if(isset($_POST['Send'])){ 
  $table = 'Tools';
    $param1 = $_POST['ToolID'];
    $param2 = $_POST['name'];
    $param3 = $_POST['toolType'];
    $param4 = $_POST['number'];
    $param5 = $_POST['box'];
    $param6 = $_POST['drawer'];

    $sql = "UPDATE Tools Set Name = '" . $param2 . "', ToolType = '" . $param3 . "', NumOfPieces = '" . $param4 . "', Box= '" . $param5 . "', Drawer = '" . $param6 . "'  WHERE  ToolID ='". $param1 . "'";
   


        if ($conn->query($sql) == TRUE) {
          echo "";
        }
        else {
                echo "";
         }
}
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        
        <meta charset="UTF-8">
        <!-- Tab will show FabLab icon (shortcut icon) -->
        <link rel="shortcut icon" href="http://fablab.uta.edu/sites/default/files/FabLab_Favicon.png" type="image/png">
        
        <!-- Title name of website on the tab -->
        <title>Employee Homepage | UTA Fablab</title>
        <link type="text/css" rel="stylesheet" href="style1.css" media="all" />
        <link type="text/css" rel="stylesheet" href="style4.css" media="all" />

        <script>
            function addElement(value)
            {
                if(value == 'OR' || value == 'AND')
                {
                  $('#otherType').append('<select id = where2 name = where2 style="display:hidden"> <option>Please select</option>  <?php
                        $sql = 'DESCRIBE Tools;';
                        $query = mysqli_query($conn, $sql);
                        while ($row = $query->fetch_assoc())
                        {
                          echo '<option value="'.$row['Field'].'">'.$row['Field'].'</option>';

                        }
                        ?> </select><br><br>');

                  $('#otherType').append('<select id ="operator" name =newop> <option>Please select</option> <option value="=">=</option> <option value="LIKE">LIKE %...%</option> <option value="NOT LIKE">NOT LIKE</option> </select></br></br>');


                  $('#otherType').append('<input id="myInput" name=myInput type="text" /></br>');
                   }
                else {
                  $('#myInput').remove();
                  $('#where2').remove();
                  $('#newop').remove();


                }
            }

            function addOrder(value){

              if(value == 'WHERE') {
                $('#divUpload').show();
                $('#orderInput').remove();
              }
              else {
                $('#divUpload').hide();
                $('#orderType').append('<input id="orderInput" name=orderInput type="text" /></br>');
              }


            }

            function GetInventory()
                   {
                     var InvForm = document.forms.InventoryList;
                     var id = "";

                     var x = 0;

                     for (x=1;x<InvForm.id.length;x++)
                     {
                        if (InvForm.id[x].selected)
                        {
                          if (id == ""){
                            id = InvForm.id[x].value;

                          }
                          else {
                            id = id + "," + InvForm.id[x].value;

                          }
                         //alert(InvForm.SelBranch[x].value);

                        }
                     }
                    document.cookie = "id="+id; 

                   }
        </script>
        
    </head> 
  
    
    <body class="html not-front not-logged-in no-sidebars page-user"> 
        
        <script>
            $(document).ready(function(){
                $("#insertPersonDataForm").hide();
            $("#insertToolDataForm").hide();
            //$("#checkOutForm2").hide();
            $("#turninform").hide();
            $("#reportForm1").hide();
            $("#reportForm2").hide();
            $("#reportForm3").hide();
            $("#updateForm").hide();
            $("#InventoryList").hide();
            

                $('#insertPersonDataForm').ajaxForm({
                    success: function( html ) {
                         $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);
                    }
                }); 
              $('#insertToolDataForm').ajaxForm({
              success: function( html ) {
                 $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);
              }
            }); 
              $('#reportForm1').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);

              }
            }); 
              $('#reportForm2').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);

              }
            }); 
              $('#reportForm3').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);

              }
            }); 
            $('#updateForm').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);

              }
            }); 
              $('#checkOutForm2').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);
                //$("#checkOutForm2").hide();
              }
            }); 
            $('#InventoryList').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);
                //$("#checkOutForm2").hide();
              }
            }); 
                 $('#turninform').ajaxForm({
              success: function( html ) {
                $('#tableViewer').empty();
                $('#output').empty();
                $("#output").append(html);

              }
            }); 


            });  

            function viewAllRecords() {
               $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
              $("#turninform").hide();
              $("#reportForm1").hide();
              $("#reportForm2").hide();
               $("#updateForm").hide();
              $("#reportForm3").hide();
              $("#InventoryList").show();

            //window.open("custom.php",'_blank'); 
          }
          function toolcheckedout() {
            $.ajax({url: "ToolsCheckedOut.php"}).done(function( html ) {
              $('#tableViewer').empty();
              $('#output').empty();
              $("#checkOutForm2").hide();
              $("#turninform").hide();
               $("#reportForm1").hide();
               $("#reportForm2").hide();
                $("#InventoryList").hide();
               $("#reportForm3").hide();
               $("#InventoryList").hide();
               $("#insertPersonDataForm").hide();
                $("#updateForm").hide();
              $("#tableViewer").append(html);
            });
          }
          function insertPersonRecord() {
              $('#tableViewer').empty();
               $('#output').empty();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
              $("#turninform").hide();
               $("#reportForm1").hide();
               $("#reportForm2").hide();
               $("#reportForm3").hide();
               $("#InventoryList").hide();
                $("#updateForm").hide();
                    $("#insertPersonDataForm").show();
          }
          function insertToolRecord() {
              $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#turninform").hide();
              $("#checkOutForm2").hide();
               $("#reportForm1").hide();
               $("#reportForm2").hide();
               $("#InventoryList").hide();
               $("#reportForm3").hide();
                $("#updateForm").hide();
                    $("#insertToolDataForm").show();
          }
          function checkOutRecord() {
              $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#turninform").hide();
               $("#reportForm1").hide();
               $("#reportForm2").hide();
               $("#reportForm3").hide();
               $("#InventoryList").hide();
                $("#updateForm").hide();
                    $("#checkOutForm2").show();

          }
          function turnInRecord() {
            $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
              $("#reportForm1").hide();
              $("#reportForm2").hide();
              $("#reportForm3").hide();
              $("#InventoryList").hide();
               $("#updateForm").hide();
                  $("#turninform").show();

          }
          function toolPerson() {
            $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
               $("#turninform").hide();
               $("#reportForm2").hide();
               $("#reportForm3").hide();
                $("#updateForm").hide();
                $("#InventoryList").hide();
                  $("#reportForm1").show();

          }
          function toolStatus(){
            $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
               $("#turninform").hide();
              $("#reportForm1").hide();
              $("#reportForm3").hide();
               $("#updateForm").hide();
               $("#InventoryList").hide();
                  $("#reportForm2").show();

          }
          function update(){
            $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
               $("#turninform").hide();
              $("#reportForm1").hide();
              $("#reportForm3").hide();
              $("#InventoryList").hide();
              $("#reportForm2").hide();
              $("#updateForm").show();

          }
           function locationCheck(){
            $('#tableViewer').empty();
              $('#output').empty();
              $("#insertPersonDataForm").hide();
              $("#insertToolDataForm").hide();
              $("#checkOutForm2").hide();
              $("#InventoryList").hide();
              $("#turninform").hide();
              $("#reportForm1").hide();
              $("#reportForm2").hide();
               $("#updateForm").hide();
              $("#reportForm3").show();

          }
        
           function report() {
              $('#tableViewer').empty();
              $("#insertToolDataForm").hide();
              $("#deleteDataForm").hide();
                    $("#dropdown").show();
          }

          
        
        </script>
        
        
        
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
                        
                    </div>
          <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    
                    
                    <div class="navbar-collapse collapse">
                        <nav role="navigation">
                            
                            <ul class="menu nav navbar-nav">
                                <form class="select-box" name="sort" action="" method="post">
                                </form>
                            </ul>
                            
                            <ul class="menu nav navbar-nav">
                                <form class="search-form" action="" method="post">
                                </form>
                            </ul>
                            
                            <ul class="menu nav navbar-nav secondary">
                                <li class="last leaf"><a href="/scanners/logout.php">Log out</a></li>
                            </ul>
                        </nav>
                    </div>
                    
                    
                    
                </div>
            </header>
        </section>
          
        
        <div id="top_viewer">
            
            <div id="nav">
                <b><center style="background-color:#eeeeee; border-bottom:solid; line-height: 40px">Navigation</center></b>
                
                <table id="nav_table">
                    <tr>
                        <td><a href=# onclick="viewAllRecords()" class="navigation-options">Custom Query</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="insertPersonRecord()" class="navigation-options">Insert a Employee/Customer</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="insertToolRecord()" class="navigation-options">Insert a Tool</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="checkOutRecord()" class="navigation-options">Check out a Tool</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="turnInRecord()" class="navigation-options">Turn In a Tool</a></td>
                    </tr>
                    
                    
                    <tr>
                        <td><a href=# onclick="toolPerson()" class="navigation-options">Tool a Person Has</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="toolcheckedout()" class="navigation-options">Tools Checked out</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="toolStatus()" class="navigation-options">Tools Status</a></td>
                    </tr>
                    
                    <tr>
                        <td><a href=# onclick="locationCheck()" class="navigation-options">Location Check for Tool</a></td>
                    </tr>

                    <tr>
                        <td><a href=# onclick="update()" class="navigation-options">Update a Tool</a></td>
                    </tr>
                
                </table>
            
            </div>
            
            
            
            <div id="output"></div>
            
            
            <div class="forms">
                
                <form id="insertPersonDataForm" action="insert.php" method="post" >
                    <label>UTA ID: </label><input type="text" name="uta_id" class="input-box">
                    <br/>
                    <label>Person Type: </label><select id = titles name = person_type>
                    <option>Please select</option>
                    <option value="Employee">Employee</option>
                    <option value="Customer">Customer</option>
                         
                          </select>
                    <br/><br>
                    <input type="submit" value="Submit" class="last-button">
                </form>
                
                <form id="insertToolDataForm" action="insertTool.php" method="post" >
                    <label>Tool ID: </label><input type="text" name="toolid"><br>
                    <label>Name: </label><input type="text" name="name"><br>
                    <label>Tool Type: </label><select id = titles name = toolType>
                    <option>Please select</option>
                          <?php
                          $sql = 'SELECT * FROM ToolType;';
                          $query = mysqli_query($conn, $sql);
                          while ($row = $query->fetch_assoc())
                          {
                            echo '<option value="'.$row['T_type'].'">'.$row['T_type'].'</option>';
                              
                          }
                          ?>
                          </select><br>
                    <label>Num Of Pieces: </label><input type="text" name="number"><br>
                    <label>Box: </label><input type="text" name="box"><br>
                    <label>Drawer: </label><input type="text" name="drawer"><br>
                    <label>Notes: </label><input type="text" name="notes"><br><br>
                    <input type="submit" value="Submit" class="last-button">
                </form>
                
                <form id="checkOutForm2" method="post" action="CheckOut.php" >
                    <label>Tool ID: </label><input type="text" name="ToolID"><br>
                    <label>UTA ID: </label><input type="text" name="uta_id"><br><br>
                    <input type="submit" value="Submit" name="SubmitButton" class="last-button">
                </form>
                
                <form id="turninform" method="post" action="TurnIn.php">
                    <label>Tool ID: </label><input type="text" name="ToolID"><br>
                    <label>UTA ID: </label><input type="text" name="uta_id"><br><br>
                    <input type="submit" value="Submit" name="SubmitButton" class="last-button">
                </form>
                
                <form id="reportForm1" method="post" action="ToolAPersonHas.php">
                    <label>UTA ID: </label><input type="text" name="uta_id"><br><br>
                    <input type="submit" name="SubmitButton" value="Execute" class="last-button" />
                </form>
                
                <form id="reportForm2" method="post" action="ToolStatus.php">
                    <label>Tool ID: </label><input type="text" name="uta_id"><br><br>
                    <input type="submit" name="SubmitButton" value="Execute" class="last-button" />
                </form>

                
                <form style="margin-left: 500px; margin-top: auto;" id="InventoryList" name="InventoryList" method="post" action="custom.php">
                    <h2>SELECT</h2>
                    <select id = titles name = id multiple="multiple">
                        <option value=toolid> Please select </option>
                            <?php
                            $sql = 'DESCRIBE Tools;';
                            $query = mysqli_query($conn, $sql);
                            while ($row = $query->fetch_assoc())
                            {
                              echo '<option value="'.$row['Field'].'">'.$row['Field'].'</option>';

                            }
                            $sql = 'DESCRIBE Person;';
                            $query = mysqli_query($conn, $sql);
                            while ($row = $query->fetch_assoc())
                            {
                              echo '<option value="'.$row['Field'].'">'.$row['Field'].'</option>';

                            }
                            ?>
                    </select>
                    
                    <h2>FROM</h2>
                    <select id = titles name = from>
                        <option>Please select</option>
                            <?php
                            $sql = 'SHOW TABLES';
                            $query = mysqli_query($conn, $sql);
                            while ($row = $query->fetch_assoc())
                            {
                               foreach($row as $value)
                          {
                              echo '<option value="'.$value.'">'.$value.'</option>';
                          }


                            }
                            ?>
                    </select>
                    
                    <select id ="order" name =order onchange="addOrder(this.value)">
                        <option value="">Please select</option>
                        <option value="WHERE">WHERE</option>
                        <option value="ORDER BY">ORDER BY</option>
                    </select><br><br>   
                    
                    <div id="orderType"></div>
                    
                    <div id="divUpload" style="display:none">     

                    <h2>WHERE</h2>
                        <select id = titles name = where>
                            <option>Please select</option>
                                <?php
                                $sql = 'DESCRIBE Tools;';
                                $query = mysqli_query($conn, $sql);
                                while ($row = $query->fetch_assoc())
                                {
                                  echo '<option value="'.$row['Field'].'">'.$row['Field'].'</option>';

                                }
                                ?>
                        </select>
                        <br><br>
                        
                        <select id ="operator" name =operator>
                            <option>Please select</option>
                            <option value="=">=</option>
                            <option value="LIKE">LIKE %...%</option>
                            <option value="NOT LIKE">NOT LIKE</option>
                        </select>
                        
                        
                        <input type="text" name="arg"><br><br>
                        
                        <select id ="extra" name =extra onchange="addElement(this.value)">
                            <option value="">Please select</option>
                            <option value="AND">AND</option>
                            <option value="OR">OR</option>
                        </select>
                        <br><br>


                    </div>

                    <div id="otherType"></div>
                    
                    
                    <input type="submit" value="Submit" name="SubmitButton" onclick="GetInventory();">
                </form>
                
                

                <form id="updateForm" method="post" action="updateCheck.php">
                    <label>Tool ID: </label><input type="text" name="uta_id"><br><br>
                    <input type="submit" name="SubmitButton" value="Execute" class="last-button" />
                </form>
                
                <form id="reportForm3" method="post" action="LocationCheck.php">
                    <label>Tool ID: </label><input type="text" name="uta_id"><br>
                    <label>Box: </label><input type="text" name="box"><br>
                    <label>Drawer: </label><input type="text" name="draw"><br><br>
                    <input type="submit" name="SubmitButton" value="Execute" class="last-button" />
                </form>
            
            </div>
            
            
        
            
            <div id="tableViewer"></div>
      </body>
</html>
    
    
    

    
    
    
    
 
    

    
<style>
    
    #header {
        text-decoration: none;
        background-color:blue;
        color:white;
        text-align:center;
        padding:5px;}

    
    #title {
        text-decoration: none;
        background-color:#eeeeee;
        border-bottom:solid;

    }

    
    #nav {
        margin-top: 0px;
        margin-left: 25px;
        margin-right: 150px;
        line-height: 35px;
        background-color:#eeeeee;
        height:auto;
        width: 20%;
        float: left; 
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
        text-decoration: none;
        
    }
    
    #nav_table {
        line-height:inherit;
    }
    
    
    #output {
        background-color:#eeeeee;
        padding-left:8px;
        overflow:auto;
        max-height:179px;}

    
    #top_viewer {
        width:100%;
        display:inline-block;
        margin-top: 0px;
        text-decoration: none;
    }

    #tableViewer {
        text-decoration: none;
        text-align:center;}

    
    .tables {
        text-decoration: none;
        width:100%;
        border:2;}

    
    .tables th {
        text-decoration: none;
        text-align: center;}

    
    table.tables td {
        text-align:center;
        text-decoration: none;
    }

    
    table.tables tr:nth-child(even) {
        background-color: #eee;}

    
    table.tables tr:nth-child(odd) {
        background-color:#C2D6FF;}

    
    table.tables th	{
        background-color: blue;
        color: white;}

/*
    .navbar {
        overflow: hidden;
        background-color: #333;
        font-family: verdana, sans-serif;
        text-decoration: none;
    }


    .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;}
    
    
    */


    .dropdown {
        float: left;
        overflow: hidden;}
    
    
    .dropdown .dropbtn {
        font-size: 16px;    
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        text-decoration: none;
    }
    
    .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: inherit;
    }


    .dropdown-content {
        text-decoration: none;
        display: none;
        position: relative;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;}


    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;}


    .dropdown-content a:hover {
        background-color: #ddd;
        text-shadow: -.25px -.25px 0 black, 
                .25px .25px black;
    }


    .dropdown:hover .dropdown-content {
        display: block;
    }
    
    
    .navigation-options{
        text-decoration: none;
    }
    
    
    #insertPersonDataForm, #insertToolDataForm, #checkOutForm2, #turninform, #reportForm1, #reportForm2, #reportForm3{
        color: #08538d;
        font-weight: 600;
        
    }
    
    
    
    .forms{
        padding: 20px 12px 10px 20px;
        font: 20px verdana, sans-serif;
        margin-top: 50px;
        margin-left: 50px;
    }
    
    
    .forms input[type=submit], .forms input[type=button]{
        border: none;
        padding: 8px 12px 8px 12px;
        background: grey;
        color: #fff;
        box-shadow: 1px 1px 4px #DADADA;
        -moz-box-shadow: 1px 1px 4px #DADADA;
        -webkit-box-shadow: 1px 1px 4px #DADADA;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        
    }
    
    .forms input[type=submit]:hover, .forms input[type=button]:hover{
        background: black;
        color: #fff;
    }
    
    
    .input-box{
        width: 250px;  
    }
    
    
    
    label{
        display:inline-block;
        width: 200px;
    }
    
    
    .last-button{
        margin-left: 200px;
    }
    
        

    
    
</style>