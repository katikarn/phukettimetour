<?php
	// Your PHP code here
	// Create connection to mysql
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "webtour";
	
	//Make Connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	mysqli_set_charset($conn, "utf8");
	//Check Connection
	if(!$conn){
		die("Connection Failed. ". mysqli_connect_error());
	}
	else {
		echo("Connection Succes<br>");
	}

	if( isset($_POST['submitAddUser']) )
	{
		echo " ok2<br>";
		//Variable from the user	
		$status = $_POST["status"];
		$type = $_POST["type"];
		$usernameR = $_POST["username"];
		$passwordR = $_POST["password"];
		$email = $_POST["email"];
		// $request = $_POST["Remark"]." 00:00:00";

		echo "status : ".$status."<br>";
		echo "type : ".$type."<br>";
		echo "username : ".$usernameR."<br>";
		echo "password : ".$passwordR."<br>";
		echo "email : ".$email."<br>";
		//echo "request : ".$request."<br>";
		
		//$name = $firstname." ".$lastname;
		//echo "name : ".$name."<br>";
		
		$sql = "INSERT INTO `user` (`userid`, `username`, `email`, `password`, `type`, `status`,
								`createdatetime`, `createby`, `updatedatetime`, `updateby`)
								VALUES (NULL,'$usernameR','$email', '$passwordR','$type',
								'$status',NOW(),NOW(),NOW(),'$usernameR')";
		echo $sql."<br>";
		$result = mysqli_query($conn ,$sql);
		echo $result."<br>";
		
		
		if(!$result) echo "there was an error";
		else echo "Everything ok.";
		
		
	}else{ 
		echo "not ok";
	}
?>