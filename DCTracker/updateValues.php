<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		require 'connection.php';
		update_values($_GET['table'],$_GET['set'],$_GET['where']);
	}
	function update_values($table,$set,$where){
		global $connect;
		
		$query='update '.$table.' set '.$set.' where '.$where;
		
		//echo $query;	
		
		$result = mysqli_query($connect,$query) or die (mysqli_error($connect));
		header('Content-Type: application/json');
		
		//echo $result;
		
		if($result){
			echo '{"updateResult":[{"result":"Update Successful..."}]}';
		}else{
			echo '{"updateResult":[{"result":"Update Failed..."}]}';
		}
		
		mysqli_close($connect);
	}
	function from_12_to_24($time){
		$hour = substr($time,0,2);
		$index = substr($time,6,2);
		if($index == "PM"){
			if($hour == 12){
				$hour = '12';
			}else{
				$hour += 12;
			}
		}else{
			if($hour == "12"){
				$hour = '00';
			}
		}
		return $hour.':'.substr($time,3,2).':00';
	}
?>