<?php 
	$dbname = "dbname=twitterpirate";
	$db= pg_connect("$dbname");
  $index=$_GET['index'];
	$sql =<<<EOF
      select cloudcontent, id, date from WordClouds where id>= $index-1 and id<=$index+3 ORDER BY id ASC;
EOF;
	$ret = pg_query($db, $sql);
	if(!$ret) {
      echo pg_last_error($db);
      exit;
    }
    $idandclouds;
    $id;
    $clouds=array();
    $date;
    $i=0;
   	while($row = pg_fetch_row($ret)) {
   		$clouds[$i]=$row[0];
   		$id[$i]=$row[1];
      $date[$i] = $row[2];
   		$i=$i+1;

   	}
    if ($i == 0) {
      echo "none";
      exit; 
    }
   	$idandclouds[0]=json_encode($clouds);
   	$idandclouds[1]=json_encode($id);
    $idandclouds[2]=json_encode($date);
    $idandclouds[3]=$i;
   	echo json_encode($idandclouds);




?>