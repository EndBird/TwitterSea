<?php 
session_start();
if (isset($_SESSION["username"])==false) {

	echo "no";
	exit;
}
echo "yes";
exit();


?> 