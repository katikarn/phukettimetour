<?php
	
	if( isset($_POST['submitAddProduct']) )
	{
		 echo " ok2<br>";
		//Variable from the user	
		$productid = $_POST["productid"];
		$status = $_POST["status"];
		$productName = $_POST["productName"];
		$productSupplier = $_POST["productSupplier"];
		$Type = $_POST["Type"];
		$Detail = $_POST["Detail"];
		$ConfirmClass = $_POST["ConfirmClass"];
		$CostPrice = $_POST["CostPrice"];
		$NormalPrice = $_POST["NormalPrice"];
		$SalesPrice1 = $_POST["SalesPrice1"];
		$SalesPrice2 = $_POST["SalesPrice2"];
		$SeatType = $_POST["SeatType"];
		$TicketType = $_POST["TicketType"];
		$ShowTime = $_POST["ShowTime"];
		$Freepickup = $_POST["Freepickup"];
		$Min = $_POST["Min"];
		$Max = $_POST["Max"];
		$d_detail = $_POST["d_detail"];
		$CarTypeText = $_POST["CarTypeText"];
		$MaxSeat = $_POST["MaxSeat"];
		
		$submitAddProduct = $_POST["submitAddProduct"];
		$LoginByUser = trim($_SESSION['LoginUser']);
		// $request = $_POST["Remark"]." 00:00:00";
		
		// echo "status : ".$status."<br>";
		// echo "type : ".$type."<br>";
		// echo "username : ".$usernameR."<br>";
		// echo "password : ".$passwordR."<br>";
		// echo "email : ".$email."<br>";
		// //echo "request : ".$request."<br>";
		$sql_supplier = "SELECT `supplierid`, `name`, `type`,`tel`,`status` FROM `supplier` WHERE `name`= '$productSupplier'";
		$result_supplier = mysqli_query($conn ,$sql_supplier);
		echo $sql_supplier."<br>";
		if(mysqli_num_rows($result_supplier) > 0){
		//show data for each row
			while($row = mysqli_fetch_assoc($result_supplier)){
				$productSupplier = $row['supplierid'];
				echo $productSupplier ."<br>";
			}
			echo $_POST["submitAddProduct"] ."<br>";
			if($_POST["submitAddProduct"] == 'Insert'){
				$sql = "INSERT INTO `product` (
				`productid`, `supplierid`, `name`, `detail`, `status`,
				`product_type`, `confirm_class`, `t_seattype`, `t_tickettype`, `t_showtime`, `d_freepickup`,
				`d_min`, `d_max`, `d_detail`, `c_cartype`, `c_maximumseat`, `costprice`, `normalprice`,
				`salesprice1`, `salesprice2`, `note`, `createdatetime`, `createby`, `updatedatetime`, `updateby`)
				VALUES (
				NULL, '$productSupplier', '$productName', '$Detail', '$status',
				'$Type', '$ConfirmClass', '$SeatType', '$TicketType', '$ShowTime', '$Freepickup',
				'$Min', '$Max','$d_detail', '$CarTypeText', '$MaxSeat', '$CostPrice', '$NormalPrice',
				'$SalesPrice1', '$SalesPrice2', '', NOW(),'$LoginByUser', 'NOW()', '$LoginByUser');";
				echo $sql."<br>";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			echo $result."<br>";
			if(!$result) {
					echo "<script>alert('Failed to added.'); window.location='product-setup.php'</script>";
				}else{
					echo "<script>alert('Added Product successfully!'); window.location='product-setup.php'</script>";
			}
			}else if($_POST["submitAddProduct"] == 'Update'){
				$sql = "UPDATE `product` SET `supplierid`='$productSupplier',
				`name`='$productName',`detail`='$Detail',`status`='$status',`product_type`='$Type'
				,`confirm_class`='$ConfirmClass',`t_seattype`='$SeatType',`t_tickettype`='$TicketType'
				,`t_showtime`='$ShowTime',`d_freepickup`='$Freepickup',`d_min`='$Min',`d_max`='$Max'
				,`d_detail`='$d_detail',`c_cartype`='$CarTypeText',`c_maximumseat`='$MaxSeat'
				,`costprice`='$CostPrice',`normalprice`='$NormalPrice',`salesprice1`='$SalesPrice1'
				,`salesprice2`='$SalesPrice2',`updatedatetime`=NOW(),`updateby`='$LoginByUser'
				WHERE `productid` = '$productid'";
				//echo $sql."<br>";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			//echo $result."<br>";
			if(!$result) {
					echo "<script>alert('Failed to Update.'); window.location='product-setup.php'</script>";
				}else{
					echo "<script>alert('Update Product successfully!'); window.location='product-setup.php'</script>";
			}
			}
		
			 
		}else{
			echo "<script>alert('Failed to Add/Update. Supplier Name is incorrect!'); window.location='product-setup.php'</script>";
		}
		
		
		
		
		
		
		}else{ 
		 //echo "not ok";
	}
	
?>