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
		$query = "SELECT * FROM `supplier` WHERE `supplier_id` = '".$_POST["supplier_id"]."'";  
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}
	
	if(isset($_POST["agent_id"]))  
	{  
		$query = "SELECT * FROM `agent` WHERE `agent_id` = '".$_POST["agent_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["product_id"]))  
	{  
		$query = "SELECT * FROM `product` WHERE `product_id` = '".$_POST["product_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}

	if(isset($_POST["booking_id"]))  
	{  
		$query = "SELECT * FROM `booking` WHERE `booking_id` = '".$_POST["booking_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}

	if(isset($_POST["booking_detail_id"]))  
	{  
		$query = 	"SELECT * FROM booking_detail, product, supplier WHERE 
					booking_detail.product_id = product.product_id and
					product.supplier_id = supplier.supplier_id and
					booking_detail.booking_detail_id = '".$_POST["booking_detail_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}
?>
