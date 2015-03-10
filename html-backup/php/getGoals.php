<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include_once("config.php");
	include_once("functions.php");

	$goalsQuery = 'SELECT * FROM task WHERE addedBy is null;';

	$result = queryDb($conn, $goalsQuery);

	$output = "[";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($output != "[") {$output .= ",";}
	    $output .= '{"taskID":"'  . $rs["id"] . '",';
	    $output .= '"taskDescription":"'   . $rs["description"]. '",';
	    $output .= '"taskPoints":"'. $rs["points"]. '"}'; 
	}
	$output .="]";

	echo(utf8_encode($output));
	// $returnstring = '';
	// for ( $i = 0; $i < 20; $i++ ) {
	// 	$returnstring .= '<div class="col-xs-4 col-sm-2 col-md-2 goalButton" id='.$i.'><p class="center">Panta en burk</p></div>';
	// }
	// echo($returnstring);
?>