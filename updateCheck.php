<?php
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
          echo "Updated Successfully <br>";
        }
        else {
                echo "Error updating record: " . $conn->error . "<br>";
         }
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Tab will show FabLab icon (shortcut icon) -->
        <link rel="shortcut icon" href="http://fablab.uta.edu/sites/default/files/FabLab_Favicon.png" type="image/png">
        <title>Update tool | UTA Fablab</title>
    </head>
    
    
    <body>
        
        <div class="div-form">
            <form id="updateToolform" method="post" >

                <?php

                if(isset($_POST['SubmitButton'])){ 
                    $tool = $_POST['uta_id'];

                    $sql = 'SELECT * FROM Tools';
                    $query = mysqli_query($conn, $sql);
                    $flag = 0;
                    while ($col = $query->fetch_assoc()){
                        if ($col['ToolID'] == $tool){  
                ?>

                <label>Tool ID: </label><input class="input-box" type="text" name="ToolID" value="<?php echo $tool; ?>" readonly ><br>
                <label>Name: </label><input class="input-box" type="text" name="name" value="<?php echo $col['Name']; ?>"><br>
                <label>Tool Type: </label><input class="input-box" type="text" name="toolType" value="<?php echo $col['ToolType']; ?>"><br>
                <label>Num Of Pieces: </label><input class="input-box" type="text" name="number" value="<?php echo $col['NumOfPieces']; ?>"><br>
                <label>Box: </label><input class="input-box" type="text" name="box" value="<?php echo $col['Box']; ?>"><br>
                <label>Drawer: </label><input class="input-box" type="text" name="drawer" value="<?php echo $col['Drawer']; ?>"><br>
                <input type="submit" value="Submit" name="Send" class="last-button"> 

                <?php   $flag = 1; }
                    }
                    if ($flag == 0) {
                        echo "Invalid ID";
                    }
                }

                ?>

            </form>
            
        </div>


    </body>
</html>
    
    
    
    
    

    
    
<style type="text/css">
    body {
        font-size: 15px;
        color: #343d44;
        font-family: verdana, sans-serif;
        padding: 0;
        margin: 0;
    }
    
    #reportForm2{
        color: #08538d;
        font-weight: 600;
    }
    
    
    .div-form{
        padding: 20px 12px 10px 20px;
        font: 20px verdana, sans-serif;
        margin-top: 50px;
        margin-left: 50px;
    }
    
    
    .div-form input[type=submit], .div-form input[type=button]{
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
    
    .div-form input[type=submit]:hover, .div-form input[type=button]:hover{
        background: black;
        color: #fff;
    }
    
    
    label{
        display:inline-block;
        width: 200px;
    }
    
    
    .last-button{
        margin-left: 200px;
    }
    
    .input-box{
        width: 250px;  
    }
    
    
    
  </style>