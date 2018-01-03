<?php 
if (isset($_POST["nextpic"])) {
	$dbname ="dbname=twitterpirate";
	$db=pg_connect("$dbname");	
	$id=$_POST["nextpic"]+1; // ids in database is index by 1 while nextpic is index by 0
	//so we increment
	$sql=<<<EOF
	  select likes from wordclouds where id = $id;
EOF;

    $ret = pg_query($db, $sql);
	if(!$ret) {
      echo pg_last_error($db);
      exit;
    }
    while($row = pg_fetch_row($ret)) {
    	$updatedlikes = $row[0]+1;

    }
	$sql=<<<EOF
	  update wordclouds set likes = $updatedlikes  where id=$id;
EOF;
	
	$ret = pg_query($db, $sql);
	if(!$ret) {
      echo pg_last_error($db);
      exit;
    }
    echo "";

}





?>