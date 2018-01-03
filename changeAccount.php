<?php 
session_start();
if (isset($_SESSION["username"])) {

$dbname = "dbname=twitterpirate";
$username = $_SESSION["username"];
$db = pg_connect($dbname);

if (isset($_POST["newUsername"])==True and $_POST["newUsername"] != "") {
    $newUsername = $_POST["newUsername"];
    $sql ="
      UPDATE Accounts SET username = '$newUsername' where username = '$username';
";
    //$sql =<<<EOF 
      //   UPDATE Accounts SET username = '$newUsername' where username = '$username';
//EOF;
	$ret = pg_query($db, $sql);
	if(!$ret) {
	      echo pg_last_error($db);
	      exit;
	   } 
	$username = $newUsername;
	$_SESSION["username"] = $username;
}

if (isset($_POST["newPass"])==True and $_POST["newPass"] != "") {
	$newPass = $_POST["newPass"];
	$sql =<<<EOF
      UPDATE Accounts SET password = '$newPass' where username = '$username';
EOF;
	//$sql =<<<EOF 
      //   UPDATE Accounts SET password = '$newPass' where username = '$username';
//EOF;
    $ret = pg_query($db, $sql);
	if(!$ret) {
	      echo pg_last_error($db);
	      exit;
	   }
}

   echo "Account changed successfully";

}
?>