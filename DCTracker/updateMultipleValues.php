<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		require 'connection.php';
		insertValues();
	}
	
	function insertValues(){
		global $connect;
		$table = $_GET['tName'];
		$columns = $_GET['cNames'];
		$duplicate = $_GET['dPlicate'];
		$values = $_GET['cValues'];
		
		$query='insert into '.$table.' ';
        $query.='('.$columns.') ';
        $query.='values ';
		
		//Separate multiple values
		$valueArr = explode("@@",$values);
		for($n=0;$n<sizeof($valueArr);$n++){
			$query.='('.$valueArr[$n].')';
			if($n != sizeof($valueArr)-1){
				$query.=',';
			}
		}
        
		$query.=' ON DUPLICATE KEY UPDATE '.$duplicate;
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