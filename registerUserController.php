<?php

	if( isset($_POST['submitAddUser']) )
	{
		// echo " ok2<br>";
		//Variable from the user	
		$status = $_POST["status"];
		$type = $_POST["type"];
		$usernameR = $_POST["username"];
		$passwordR = $_POST["password"];
		$email = $_POST["email"];
		$LoginByUser = trim($_SESSION['LoginUser']);
		// $request = $_POST["Remark"]." 00:00:00";

		// echo "status : ".$status."<br>";
		// echo "type : ".$type."<br>";
		// echo "username : ".$usernameR."<br>";
		// echo "password : ".$passwordR."<br>";
		// echo "email : ".$email."<br>";
		// //echo "request : ".$request."<br>";
		
		
		$sql = "INSERT INTO `user` (`userid`, `username`, `email`, `password`, `type`, `status`,
								`createdatetime`, `createby`, `updatedatetime`, `updateby`)
								VALUES (NULL,'$usernameR','$email', '$passwordR','$type',
								'$status',NOW(),'$LoginByUser',NOW(),'$LoginByUser')";
		// echo $sql."<br>";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		// echo $result."<br>";
		
		
		if(!$result) {
		// echo "there was an error";
		}else{
			// echo "<script>alert('Account successfully added!'); window.location='user-management.php'</script>";
		} 
		
		
	}else{ 
		// echo "not ok";
	}
?>