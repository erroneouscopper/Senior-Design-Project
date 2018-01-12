<?php

ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
/*
 *  ldap.php : LDAP test
 *
 *   Michael Doran, Systems Librarian
 *   University of Texas at Arlington
 * 
 *   Modify By Jonathan Le
 *   UTA FabLab GRA
 * 
 *   version: 0.2 beta (2017-09-06)
*/

//local function for testing & bypass
function AuthenticateUser($netid, $password) {
    $attribute = 'utaEmplID';
    $ldap_server = 'ldaps://ldap.cedar.uta.edu';
    $ldap_baseDN = 'cn=accounts,dc=uta,dc=edu';
    $ldap_bindDN = "uid=sns9212,cn=accounts,dc=uta,dc=edu";
    
    //switch case to return roles
    switch ($netid){
        case "learner":
            return "1000000002";
        case "community":
            return "1000000004";
        case "service":
            return "1000000007";
        case "staff":
            return "1000000008";
        case "super":
            return "1000000009";
        case "admin":
            return "1000000010";
        default:{
            try {
                // Connect
                echo "start";
                $connection = @ldap_connect($ldap_server);
                if (!$connection) {
                    throw new Exception(sprintf("Can't connect to '%s'.", $ldap_server), 0x5b);
                }
                else{

                    echo "connection";
                }
                // Bind 
                 echo "bind";
                if(!@ldap_bind($connection,$ldap_bindDN,$password)) {
                     echo $password;
                    throw new Exception(@ldap_error($connection), @ldap_errno($connection));
                }
                else {
                     header('Location: testFile.html');
                }
                // Search
                $result = @ldap_search($connection, $ldap_baseDN, "uid=" . $netid);
                if (!$result) {
                    throw new Exception(@ldap_error($connection), @ldap_errno($connection));
                }
                
                // Select first record in result (should only be one)
                $entry = @ldap_first_entry($connection, $result);
                @ldap_free_result($result);
                if (!$entry) {
                    throw new Exception(@ldap_error($connection), @ldap_errno($connection));
                }
                // Grab attribute value from record
                $uta_id = @ldap_get_values($connection, $entry, $attribute);
                if (!$uta_id) {
                    //throw new Exception(@ldap_error($connection), @ldap_errno($connection));
                    return $attribute .": ". ldap_error($connection);
                } else {
                        $value = $uta_id[0];
                    return $value;
                }
            } catch (Exception $e){
                return "$e";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<body>

<?php
AuthenticateUser("sns9212","AbcdefGh1");
?>

</body>
</html>