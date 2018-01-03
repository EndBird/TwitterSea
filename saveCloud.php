<?php 
session_start();

if (isset($_POST['tosave'])==true) {
	$dbname = "dbname=twitterpirate";
	$username=$_SESSION['username'];
	$db = pg_connect( "$dbname");
	$che = trim($_POST['tosave'], '"');
	$tosave = <<<EOT
	 $che
EOT;
  $date = $_POST['date'];
	$sql =<<<EOF
      select count(*) from WordClouds;
EOF;
	$ret = pg_query($db, $sql);
	if(!$ret) {
      echo pg_last_error($db);
      exit;
    }
    while($row = pg_fetch_row($ret)) {

    	$id = $row[0]+1;
    }
    
	$sql =<<<EOF
      INSERT into WordClouds (username, cloudcontent, id, likes, date) 
      values('$username',  $$$tosave$$, $id, 0, $$$date$$);
EOF;
	$ret = pg_query($db, $sql);
    if(!$ret) {
      echo pg_last_error($db);
      exit;
    } 
    echo "ok";
    pg_close($db);

}

?>