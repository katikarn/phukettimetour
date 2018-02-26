<?php
	
	if( isset($_POST['submitAddSupplier']) )
	{
		// echo " ok2<br>";
		//Variable from the user	
		$status = $_POST["status"];
		$type = $_POST["type"];
		$PayType = $_POST["PayType"];
		$s_Destination = $_POST["s_Destination"];
		$s_Name = $_POST["s_Name"];
		$s_Detail = $_POST["s_Detail"];
		$s_Address = $_POST["s_Address"];
		$s_Tel = $_POST["s_Tel"];
		$s_MaximumCredit = floatval($_POST["s_MaximumCredit"]);
		//$s_DepositAmount = $_POST["s_DepositAmount"];
		$s_Bookingcontact = $_POST["s_Bookingcontact"];
		$s_Bookingtel = $_POST["s_Bookingtel"];
		$s_Bookingemail = $_POST["s_Bookingemail"];
		$s_Accountcontact = $_POST["s_Accountcontact"];
		$s_Accounttel = $_POST["s_Accounttel"];
		$s_Accountemail = $_POST["s_Accountemail"];
		$s_Closeinformation = $_POST["s_Closeinformation"];
		$s_Note = $_POST["s_Note"];
		$supplier_id = $_POST["supplier_id"];
		$LoginByUser = trim($_SESSION['LoginUser']);
		
		
		// $request = $_POST["Remark"]." 00:00:00";
		
		// echo "status : ".$status."<br>";
		// echo "type : ".$type."<br>";
		// echo "username : ".$usernameR."<br>";
		// echo "password : ".$passwordR."<br>";
		// echo "email : ".$email."<br>";
		// //echo "request : ".$request."<br>";
		
		if($_POST['submitAddSupplier'] == 'Insert'){
			$sql = "INSERT INTO `supplier` ( `supplierid`, `name`, `type`, `detail`,
										`destination`, `address`, `tel`, `bookingcontact`,
										`bookingtel`, `bookingemail`, `accountcontact`, `accounttel`,
										`accountemail`, `paytype`, `maximumcredit`,
										`status`, `closeinformation`, `note`, `createdatetime`,
									`createby`, `updatedatetime`, `updateby`)
										VALUES (NULL,'$s_Name','$type', '$s_Detail',
										'$s_Destination','$s_Address','$s_Tel','$s_Bookingcontact',
										'$s_Bookingtel','$s_Bookingemail','$s_Accountcontact','$s_Accounttel',
										'$s_Accountemail','$PayType','$s_MaximumCredit',
										'$status','$s_Closeinformation','$s_Note',NOW(),
										'$LoginByUser',NOW(),'$LoginByUser')";
			
		}else if($_POST['submitAddSupplier'] == 'Update'){
			$sql = "UPDATE `supplier` 
					SET `name`='$s_Name' ,`type`='$type', `detail`='$s_Detail',
										`destination`='$s_Destination', `address`='$s_Address', `tel`='$s_Tel', `bookingcontact`='$s_Bookingcontact',
										`bookingtel`='$s_Bookingtel', `bookingemail`='$s_Bookingemail', `accountcontact`='$s_Accountcontact', `accounttel`='$s_Accounttel',
										`accountemail`='$s_Accountemail', `paytype`='$PayType', `maximumcredit`='$s_MaximumCredit',
										`status`='$status', `closeinformation`='$s_Closeinformation', `note`='$s_Note',
										`updatedatetime`=NOW(), `updateby`='$LoginByUser' 
			
					WHERE `supplierid` = '$supplier_id'";
		}
		
		 //echo $sql."<br>";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		 //echo "result : ".$result."<br>";
		
		
		if(!$result) {
			//echo "<script>alert('Failed to added.This user is already used.!'); window.location='supplier-management.php'</script>";
			}else{
			//echo "<script>alert('User successfully added!'); window.location='supplier-management.php'</script>";
		} 
		
		
		}else{ 
		// echo "not ok";
	}
	
?>