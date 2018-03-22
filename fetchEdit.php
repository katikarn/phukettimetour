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
	
	if(isset($_POST["productid"]))  
	{  
		$query = "SELECT 
		`product`.`productid` 		AS `pId`,
		`product`.`status`  		AS `pStatus`,
		`product`.`name` 			AS `pName`,
		`supplier`.`name` 			AS `sName`,
		`product`.`product_type` 	AS `pProduct_type`,
		`product`.`detail` 			AS `pDetail`,
		`product`.`confirm_class` 	AS `pConfirm_class`,
		`product`.`costprice` 		AS `pCostprice`,
		`product`.`normalprice` 	AS `pNormalPrice`,
		`product`.`salesprice1` 	AS `pSalesPrice1`,
		`product`.`salesprice2` 	AS `pSalesPrice2`,
		`product`.`t_seattype` 		AS `pT_seattype`,
		`product`.`t_tickettype` 	AS `pT_tickettype`,
		`product`.`t_showtime` 		AS `pT_showtime`,
		`product`.`d_freepickup` 	AS `pD_freepickup`,
		`product`.`d_min` 			AS `pD_min`,
		`product`.`d_max` 			AS `pD_max`,
		`product`.`d_detail` 		AS `pD_detail`,
		`product`.`c_cartype` 		AS `pC_cartype`,
		`product`.`c_maximumseat` 	AS `pC_maximumseat`
		FROM `product`,`supplier` WHERE `product`.`productid` = '".$_POST["productid"]."' and `supplier`.`supplierid` = `product`.`supplierid`";  
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}
?>
