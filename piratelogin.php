<?php 
if (isset($_GET['username']) && isset($_GET['psswd'])) {
   $dbname      = "dbname = twitterpirate";
   $username=$_GET['username'];
   $psswd=$_GET['psswd'];
   $db = pg_connect( "$dbname");
   //$sql =<<<EOF SELECT * FROM appuser WHERE username=$_GET['username']; EOF;
   $sql =<<<EOF
      SELECT password FROM Accounts 
      WHERE lower(username) = lower('$username');
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   
   while($row = pg_fetch_row($ret)) {
   	  
      	 //session_start(); 
      	 //$_SESSION["verified"] = true;
      	 //header("Location: main.html");
         if (password_verify($psswd, $row[0])) {
   		session_start();

   		$_SESSION["username"] = $username; //convert session variable to a universal variable to work with multiple users. 
   		exit();
         }
   }
   echo "not valid";
   //echo "Operation done successfully\n";
  
 }


 pg_close($db);




?>