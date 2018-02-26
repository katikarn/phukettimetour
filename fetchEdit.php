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
	
	if(isset($_POST["supplier_id"]))  
	{  
		$query = "SELECT * FROM `supplier` WHERE `supplierid` = '".$_POST["supplier_id"]."'";  
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	} 
	
	if(isset($_POST["agent_id"]))  
	{  
		$query = "SELECT * FROM `agent` WHERE `agentid` = '".$_POST["agent_id"]."'";  
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}
?>
