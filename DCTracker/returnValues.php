<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		require 'connection.php';
		return_values($_GET['select'],$_GET['from'],$_GET['where']);
	}
	function return_values($select,$from,$where){
		global $connect;
		
		$query="select ".$select." from ".$from." ".$where;
		$temp = array();
		//echo $query;
		
		$result = mysqli_query($connect,$query) or die (mysqli_error($connect));
		$rowCount = mysqli_num_rows($result);
			
			
		$temp = array();
		if($rowCount > 0){
			while($row = mysqli_fetch_assoc($result)){
				$temp [] = $row;
			}
		}
		
		
		header('Content-Type: application/json');
		echo json_encode(array("result"=>$temp	));
		mysqli_close($connect);
	}
?>