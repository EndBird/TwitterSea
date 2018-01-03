<?php
session_start();
$dbname = "dbname=twitterpirate";
$username=$_SESSION['username'];
$db = pg_connect("$dbname");

$sql = "select profile from accounts where username='$username';";
$ret = pg_query($db, $sql);
if(!$ret) {
  echo pg_last_error($db);
  exit;
}
while($row = pg_fetch_row($ret)) {
echo $row[0];
}

?>