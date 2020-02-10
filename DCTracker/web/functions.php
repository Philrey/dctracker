<?php


    //Connect to Database//
    $conn=null;
    define('access_token','pk.eyJ1IjoicGhpbHJleTAxMyIsImEiOiJjazNheTdvaGwwZDFoM21sZDY3cmxqOGJkIn0.jV1jlGhyDlBYv08KbKp6eg');
    define('hostname','localhost');
	define('username','root');
	define('password','');
	define('dbName','dctracker_db');

    function connect_to_database($host_name,$user_name,$pass,$db_name,$open_db){
        $conn = mysqli_connect($host_name,$user_name,$pass,$db_name);
        if($open_db==true){
            
            if(mysqli_errno($conn)){
                die("Could not connnect to database. <br/>");
            }else{
                return $conn;
            }
        }else{
            echo "Database Closed <br/>";
            mysqli_close($conn);
        }
    }
    //Crud Operation
    // C = add
    function add_to($table,$columns,$values){
        
        $conn=connect_to_database('localhost',username,password,dbName,true);
        $query='insert into '.$table.' ';
        $query.='('.$columns.') ';
        $query.='values ';
        $query.='('.$values.')';
		
		//echo $query;
		
        $result=mysqli_query($conn,$query);
        if(!$result){
            return FALSE;
        }
        //4. Release Data From Result
        //mysqli_free_result($result);
        //5. Close Connection
        mysqli_close($conn);
        return TRUE;
    }
    //R = Return a query
    function return_valuesWeb($select,$from,$where,$table_number){ 
        $conn = connect_to_database('localhost',username,password,dbName,true);
        $query="select ".$select." from ".$from." ".$where;
		
		//echo $query;
        
        
		$result = mysqli_query($conn,$query);
        if(!$result){
            die("Query Failed");
        }else {
            $cLine = array();
            //3. Use Returned Rows //
            while($row = mysqli_fetch_assoc($result)){
                switch($table_number){
                    case 1:{
                        $cLine [] = array($row['id'],$row['taxiName'],$row['plateNumber'],$row['userLatitude'],$row['userLongitude'],$row['userName'],$row['userPass'],$row['lastOnline']);
                        break;
                    }case 2:{
                        $cLine [] = array($row['id'],$row['placeName'],$row['placeType'],$row['placeCoordinates']);
                        break;
                    }
                }
            }
            //4. Release Data From Result
            mysqli_free_result($result);
            //5. Close Connection
            mysqli_close($conn);
            
            return $cLine;
        }

    }
    //Update
    function update_values($table,$set,$where){
        $query='update '.$table.' set '.$set.' where '.$where;
        $conn = connect_to_database('localhost',username,password,dbName,true);
        $result = mysqli_query($conn,$query);
		
		//echo $query;
		
        mysqli_close($conn);
        return $result;
    }
    //Delete
    function delete_values($from,$where){
        $query = 'delete from '.$from.' where '.$where.';';
        
		//echo $query;
		
		$conn = connect_to_database('localhost',username,password,dbName,true);
        $result = mysqli_query($conn,$query);

        mysqli_close($conn);
        return $result;
    }

    //Translate Values
    function return_month($value){
        switch ($value) {
            case 1:
                return 'January';
            case 2:
                return 'February';
            case 3:
                return 'March';
            case 4:
                return 'April';
            case 5:
                return 'May';
            case 6:
                return 'June';
            case 7:
                return 'July';
            case 8:
                return 'August';
            case 9:
                return 'September';
            case 10:
                return 'October';
            case 11:
                return 'November';
            case 12:
                return 'December';
        }
    }
	
	function getDateNow(){
		$conn = connect_to_database('localhost',username,password,dbName,true);
        $query="select substr(now(),1,10) as dateNow";
        //echo $query;
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("Query Failed");
        }else {
            $cLine = array();
            //3. Use Returned Rows //
            while($row = mysqli_fetch_assoc($result)){
                 $cLine []=array($row['dateNow']);
            }
        }
        //4. Release Data From Result
        mysqli_free_result($result);
        //5. Close Connection
        mysqli_close($conn);
            
        return $cLine[0][0];
    }
	
	function encrypt($plaintext, $salt){
		$result="";
		for($n=0;$n<strlen($plaintext);$n++){
			$result.=$plaintext[$n].$salt;
		}
		$encoded_64 = base64_encode($result);
		return $encoded_64;
    }
	function decrypt($crypttext, $salt){
		$decoded_64=base64_decode($crypttext);
		$result="";
		$desalt = explode($salt,$decoded_64);
		for($n=0;$n<sizeof($desalt);$n++){
			$result.=$desalt[$n];
		}
		return $result;
    }
    function redirectPage($url,$delay){
        echo '<meta http-equiv="refresh" content="'.$delay.'; URL='.$url.'">
			<meta name="keywords" content="automatic redirection">';
    }
    function getErrorMessage($error_code){
        $toReturn = '<h3 id ="error">';
        switch ($error_code) {
            case 1:
                $toReturn.='Incorrect User Name or Password';break;
            default:
                # code...
                break;
        }
        $toReturn.='</h3>';
        return $toReturn;
    }
    function clearSesstions(){
        session_unset();
        session_destroy();
        
    }
    function convertToGeojson($row){
        // Expedted input: Lng!!Lat!!@@Lng!!Lat!!@@
        // Expected output: [ Lat,Lng ],[Lat,Lng]

        
        $tempPoints = explode('@@',$row);
        $temp = '';
        for($n=0;$n<sizeof($tempPoints)-1;$n++){
            
            $tempLngLat = explode('!!',$tempPoints[$n]);
            $temp.='[';
            $temp.=$tempLngLat[1].','.$tempLngLat[0];
            $temp.=']';
            if($n != sizeof($tempPoints)-2){
                $temp.=',';
            }
        }        

        return $temp;
    }
?>