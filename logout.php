<?php
	session_start();
	unset($_SESSION['netid']);
	header('Location: public_page.php');

?>