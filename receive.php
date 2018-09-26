<?php 
	require('server.php');
	
	if(isset($_GET['value'])){
	$req =  $_GET['value'];
	$query_3="UPDATE activity SET public = '0' WHERE id ='".$req."';";
	$result_3=mysqli_query($conn, $query_3);
}

	if(isset($_GET['value1'])){

	$req1 =  $_GET['value1'];
	$query_4="UPDATE activity SET public = '1' WHERE id ='".$req1."';";
	$result_4=mysqli_query($conn, $query_4);
}
	
?>