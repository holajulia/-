<?php 
	function query($query){
		$_mysql_host = "localhost";
		$_mysql_user = "petrova";
		$_mysql_password = "lRkh7ExW";
		$_mysql_database = "petrova";

		$_mysqli=mysqli_connect($_mysql_host,$_mysql_user,$_mysql_password,$_mysql_database) or mysqli_connect_error();
		if(gettype($_mysqli)!='object'){
			print $_mysqli;
			return false;
		}

		$_result=mysqli_query($_mysqli,$query);

		if(gettype($_result)=='boolean'){
			if($_error=mysqli_error($_mysqli)!=''){
				print $_error;
				return false;
			}
			mysqli_close($_mysqli);
			return $_result;
		}

		// $_result=mysqli_fetch_all($_result,MYSQLI_ASSOC);
		$_result_assoc=[];
		while($row=mysqli_fetch_assoc($_result)){
			array_push($_result_assoc,$row);
		}
		mysqli_close($_mysqli);
		return $_result_assoc;
	}	
?>