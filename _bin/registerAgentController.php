<?php
	
	if( isset($_POST['submitAddAgent']) )
	{
		// echo " ok2<br>";
		//Variable from the user	
		$status = $_POST["status"];
		$agentName = $_POST["agentName"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$maxCredit = floatval($_POST["maxCredit"]);
		//$creditTerm = intval($_POST["creditTerm"]);
		$priceType = $_POST["priceType"];
		$varType = $_POST["varType"];
		$email = $_POST["email"];
		$conatactName = $_POST["conatactName"];
		$tel = $_POST["tel"];
		$address = $_POST["address"];
		$note = $_POST["note"];
		$agent_id = $_POST["agent_id"];
		$submitAddAgent = $_POST["submitAddAgent"];
		$LoginByUser = trim($_SESSION['LoginUser']);
		// $request = $_POST["Remark"]." 00:00:00";
		
		// echo "status : ".$status."<br>";
		// echo "type : ".$type."<br>";
		// echo "username : ".$usernameR."<br>";
		// echo "password : ".$passwordR."<br>";
		// echo "email : ".$email."<br>";
		// //echo "request : ".$request."<br>";
		
		if($_POST['submitAddAgent'] == 'Insert'){
			$sql = "INSERT INTO `agent` 
					(`agentid`, `username`, `email`, `password`,
					`agentname`, `agentaddress`, `agentcontactname`,
					`agentcontacttel`, `maximumcredit`,
					
					`pricetype`, `vattype`, `status`, `note`,
					`createdatetime`, `createby`, `updatedatetime`,
					`updateby`)
			VALUES (NULL,'$username','$email', '$password',
					'$agentName','$address','$conatactName',
					'$tel','$maxCredit',
					'$priceType','$varType','$status','$note',
					NOW(),'$LoginByUser',NOW(),'$LoginByUser')";
			
		}else if($_POST['submitAddAgent'] == 'Update'){
			$sql = "UPDATE `agent` SET 
					`username`='$username',`email`='$email',`password`='$password',
					`agentname`='$agentName',`agentaddress`='$address',`agentcontactname`='$conatactName',
					`agentcontacttel`='$tel',`maximumcredit`='$maxCredit',
					`priceType`='$priceType',`vattype`='$varType',`status`='$status',`note`='$note',
					`updatedatetime`=NOW(),`updateby`='$LoginByUser' 
					WHERE `agentid` = '$agent_id'";
					
		}
		
		 //echo $sql."<br>";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		// echo $result."<br>";
		
		
		if(!$result) {
			 //echo "<script>alert('Failed to added.This user is already used.!'); window.location='user-management.php'</script>";
			}else{
			 //echo "<script>alert('User successfully added!'); window.location='user-management.php'</script>";
		} 
		
		
		}else{ 
		// echo "not ok";
	}
	
?>