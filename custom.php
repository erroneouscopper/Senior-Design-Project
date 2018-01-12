<?php
$db_host = '165.227.80.123'; // Server Name
$db_user = 'seniorDesign'; // Username
$db_pass = 'pop__Pop12'; // Password
$db_name = 'ToolDatabase'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	echo "Please try again";	
}

?>
<!DOCTYPE html>
<html>
<head>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="style1.css" media="all" />
        <link type="text/css" rel="stylesheet" href="style4.css" media="all" />


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    
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
        padding: 0px 0px 0px 0px;
        font: 20px verdana, sans-serif;
        margin-top: 0px;
        margin-left: 20px;
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
<body>
<tbody>

  <div class="div-form">
  	<h2>Output</h2>
  	<?php

if(isset($_POST['SubmitButton'])){ 
	  $table = $_POST['from'];
    $param1 =$_COOKIE['id'];
    
	
  if (isset( $_POST['order'] ) && $_POST['order'] == 'WHERE') {
     $param2 = $_POST['where'];
     $op = $_POST['operator'];
     $param3 =$_POST['arg'];
     if (isset( $_POST['operator'] ) && $_POST['extra'] == '') {
      switch( $_POST['operator'] ){
          case '=':
             $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '".mysqli_real_escape_string($conn, $param3)."'";
              break;
          case 'LIKE':
              $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '%".mysqli_real_escape_string($conn, $param3)."%'";
              break;
          case 'NOT LIKE':
              $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '%".mysqli_real_escape_string($conn, $param3)."%'";
              break;

      }
      $query = mysqli_query($conn, $sql); 
   }
   else {
   	if(isset( $_POST['operator'] ) && $_POST['extra'] != '') {
   	$extra = $_POST['extra'];
   	$nextOper = $_POST['newop'];
   	$nextArg = $_POST['myInput'];
   	$where2 = $_POST['where2'];
   	switch( $_POST['operator'] ){
          case '=':
             if ($nextOper == '=') {
             $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '".mysqli_real_escape_string($conn, $param3)."'".mysqli_real_escape_string($conn, $extra)." ".mysqli_real_escape_string($conn, $where2)."  ".mysqli_real_escape_string($conn, $nextOper)."'".mysqli_real_escape_string($conn, $nextArg)."'";
         }
         else {

         	 $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '".mysqli_real_escape_string($conn, $param3)."'".mysqli_real_escape_string($conn, $extra)." ".mysqli_real_escape_string($conn, $where2)."  ".mysqli_real_escape_string($conn, $nextOper)." '%".mysqli_real_escape_string($conn, $nextArg)."%'";

         }
              break;
         
          case 'LIKE':
          	if ($nextOper == '=') {
              $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '%".mysqli_real_escape_string($conn, $param3)."%' ".mysqli_real_escape_string($conn, $extra)." ".mysqli_real_escape_string($conn, $where2)."  ".mysqli_real_escape_string($conn, $nextOper)."'".mysqli_real_escape_string($conn, $nextArg)."'";
          }
          else {
          	 $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '%".mysqli_real_escape_string($conn, $param3)."%' ".mysqli_real_escape_string($conn, $extra)." ".mysqli_real_escape_string($conn, $where2)."  ".mysqli_real_escape_string($conn, $nextOper)." '%".mysqli_real_escape_string($conn, $nextArg)."%'";

          }
              break;
          
          case 'NOT LIKE':
              if ($nextOper == '=') {
              $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '%".mysqli_real_escape_string($conn, $param3)."%' ".mysqli_real_escape_string($conn, $extra)." ".mysqli_real_escape_string($conn, $where2)."  ".mysqli_real_escape_string($conn, $nextOper)."'".mysqli_real_escape_string($conn, $nextArg)."'";
          }
          else {
          	 $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." WHERE ".mysqli_real_escape_string($conn, $param2)." ".mysqli_real_escape_string($conn, $op)." '%".mysqli_real_escape_string($conn, $param3)."%' ".mysqli_real_escape_string($conn, $extra)." ".mysqli_real_escape_string($conn, $where2)."  ".mysqli_real_escape_string($conn, $nextOper)." '%".mysqli_real_escape_string($conn, $nextArg)."%'";

          }
              break;
      }
      $query = mysqli_query($conn, $sql); 
     }
   }
  }
  else {
    $arg = $_POST['orderInput'];
   
    $sql = "SELECT ".mysqli_real_escape_string($conn, $param1)." FROM ".mysqli_real_escape_string($conn, $table)." ORDER BY ".mysqli_real_escape_string($conn, $arg)." ASC";

   $query = mysqli_query($conn, $sql); 
  }



if (!$query) {
	echo "Incorrect query";
  //die ('SQL Error: ' . mysqli_error($conn));
}
else { ?>
  
<?php
  $myArray = explode(',', $param1);
  if ($query->num_rows > 0 && sizeof($myArray) > 1) {
  	
  while ($row = $query->fetch_assoc())
    {
      
          foreach($row as $value)
          {
               
              echo $value."</br>";
              
          }
   
    }
  }
  else {
        while ($row = $query->fetch_assoc())
    {
            
            echo $row[$param1]."</br>"; 
            
    }
  }
  }

}


  	?>
    
  </div>
  </tbody>
</body>
</html>