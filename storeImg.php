<?php
session_start();
if (isset($_POST["url"]) == True) {
    $dbname = "dbname=twitterpirate";
    $username=$_SESSION['username'];
    $db = pg_connect("$dbname");
    $url=$_POST["url"];

    $sql ="
         UPDATE Accounts SET profile='$url' WHERE username = '$username';
";
    $ret = pg_query($db, $sql);
	  if(!$ret) {
      echo pg_last_error($db);
      exit;
    }
    echo "Image profile saved";

}



?> 