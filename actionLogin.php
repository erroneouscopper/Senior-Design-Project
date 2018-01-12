 <?php
 			session_start();
            if (isset($_POST['op']) && !empty($_POST['name']) && !empty($_POST['pass'])) {
				
				$ds=ldap_connect("ldaps://ldap.cedar.uta.edu"); 
				$netid = $_POST['name'];
				$password = $_POST['pass'];
				$ldap_bindDN = "uid=".$netid.",cn=accounts,dc=uta,dc=edu"; // must be a valid LDAP server!
				
				if ($ds) { 
				   echo "Binding ..."; 
				   $r=ldap_bind($ds,$ldap_bindDN,$password);    
				   if ($r) {
				   		echo "Donee";
				   		$_SESSION['netid'] = $netid;
				   		
	    				header('Location: testFile.php');
				   }
				   else{
				   		header('Location: staff_login.html?status=Invalid%20UserName%20or%20Password!');

				   }

				  
				   /*$sr=ldap_search($ds, "cn=accounts,dc=uta,dc=edu", "uid=pbt6280");  
				   echo "Search result is " . $sr . "<br />";
*/
				  
				   ldap_close($ds);

				} else {
				   echo "<h4>Unable to connect</h4>";
				}
				
			
            }
         ?>