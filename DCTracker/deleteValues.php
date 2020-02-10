<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		require 'connection.php';
		return_values($_GET['from'],$_GET['where']);
	}
	function return_values($from,$where){
		global $connect;
		
		$query = "DELETE FROM ".$from." WHERE ".$where;
		$result =  mysqli_query($connect,$query) or die (mysqli_error($connect));
		
		header('Content-Type: application/json');
		//echo $result;
		if($result){
			echo '{"isDeleted":[{"status":"true"}]}';
		}else{
			echo '{"isDeleted":[{"status":"false"}]}';
		}
		mysqli_close($connect);
	}
?>