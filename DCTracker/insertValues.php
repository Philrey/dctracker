<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		require 'connection.php';
		insertValues();
	}
	
	function insertValues(){
		global $connect;
		$table = $_GET['tName'];
		$columns = $_GET['cNames'];
		$values = $_GET['cValues'];
		
		$query='insert into '.$table.' ';
        $query.='('.$columns.') ';
        $query.='values ';
        $query.='('.$values.')';
		
		//echo $query;
		
		
		$result = mysqli_query($connect,$query) or die (mysqli_error($connect));
		
		if($result){
			echo '{"queryResult":[{"result":"true"}]}';
		}else{
			echo '{"queryResult":[{"result":"false"}]}';
		}
		header('Content-Type: application/json');
		
		mysqli_close($connect);
	}
?>