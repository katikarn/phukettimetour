<?php  
 //fetch.php  
 include("inc/connectionToMysql.php");
 if(isset($_POST["user_id"]))  
	{  
		$query = "SELECT * FROM `user` WHERE `userid` = '".$_POST["user_id"]."'";  
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}  
 ?>
 