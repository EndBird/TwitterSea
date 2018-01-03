<?php 
 if (isset($_POST['username']) && isset($_POST['psswd'])) {
   $dbname      = "dbname = twitterpirate";
   $username=$_POST['username'];
   $psswd=password_hash($_POST['psswd'], PASSWORD_BCRYPT);
   $url = $_POST['url'];
   $db = pg_connect( "$dbname");

   $sql =<<<EOF
      SELECT * FROM Accounts 
      WHERE lower(username) = lower('$username');
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   while($row = pg_fetch_row($ret)) {
        //echo "$row[0] not valid";
      echo "account name taken";
      exit;
   }
   $sql =<<<EOF
      INSERT into Accounts (username, password, profile) 
      values('$username','$psswd','$url');
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   session_start();
   $_SESSION["username"] = $username;
   
   echo "Account has been made";

   //echo "Operation done successfully\n";
   pg_close($db);
 }



?>