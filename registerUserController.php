<?php
	
	if( isset($_POST['submitAddUser']) )
	{
		// echo " ok2<br>";
		//Variable from the user
		if(isset($_POST["user_id"])){
			$user_id = $_POST["user_id"];
		}	
		
		$status = $_POST["status"];
		$type = $_POST["type"];
		$usernameR = $_POST["username"];
		$passwordR = $_POST["password"];
		$email = $_POST["email"];
		$remark = $_POST["remark"];
		$LoginByUser = trim($_SESSION['LoginUser']);
		// $request = $_POST["Remark"]." 00:00:00";
		
		// echo "status : ".$status."<br>";
		// echo "type : ".$type."<br>";
		// echo "username : ".$usernameR."<br>";
		// echo "password : ".$passwordR."<br>";
		// echo "email : ".$email."<br>";
		// //echo "request : ".$request."<br>";
		
		if($_POST['submitAddUser'] == 'Insert'){
			$sql = "INSERT INTO `user` (`userid`, `username`, `email`, `password`, `type`, `status`,`remark`,
			`createdatetime`, `createby`, `updatedatetime`, `updateby`)
			VALUES (NULL,'$usernameR','$email', '$passwordR','$type',
			'$status','$remark',NOW(),'$LoginByUser',NOW(),'$LoginByUser')";
			
		}else if($_POST['submitAddUser'] == 'Update'){
			$sql = "UPDATE `user` SET `username`='$usernameR',`email`='$email',
			`password`='$passwordR',`type`='$type',`status`='$status',`remark`='$remark',
			`updatedatetime`=NOW(),`updateby`='$LoginByUser' 
			WHERE `userid` = '$user_id'";
		}
		
		// echo $sql."<br>";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		 //echo $result."<br>";
		
		
		if(!$result) {
			 //echo "<script>alert('Error: Can not save Username is duplicate')</script>";
			}else{
			 // echo "<script>window.location='user-management.php'</script>";
		} 
		
		
		}else{ 
		// echo "not ok";
	}
	
?>