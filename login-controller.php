<?PHP
	if(isset($_POST['submitSignIn'])){
		$usernameU = trim($_POST['username']);
		$passwordU = trim($_POST['password']);

		$sql = "SELECT `userid`, `username`, `email`, `password`, `type`,
				`status`, `createdatetime`, `createby`, `updatedatetime`, `updateby` 
				FROM `user` 
				WHERE `username` = '$usernameU' AND `password` = '$passwordU'";
	$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(mysqli_num_rows($result) > 0){
			//show data for each row
			while($row = mysqli_fetch_assoc($result)){

				$_SESSION["LoginUserID"] = $row["userid"];
				$_SESSION["LoginUser"] = $row["username"];
				if(isset($_SESSION['LoginUserID']) || (trim($_SESSION['LoginUser']) != '')) {
					//echo "LoginUserID ".$_SESSION["LoginUserID"]. "<br>";
				    //echo "LoginUser ".$_SESSION["LoginUser"]. "<br>";
				}
				
				/*echo"ID:" .$row['userid'] . "<br>
				|Name:" .$row['username'] .  "<br>
				|password:" .$row['password'] .  "<br>
				|email:" .$row['email'] .  "<br>
				|type:" .$row['type'] .  "<br>
				|status:" .$row['status'] .  "<br>
				;";*/
				//echo '<script>window.location = "index.php";</script>';
				//echo '<script>window.location = "inc/nav.php";</script>';
				header('Location: index.php');
				exit();
			}
		}else{
			session_write_close();
			echo "<script>alert('Username or Password incorrect'); window.location='login.php'</script>";
			//header("location: login.php");
			//exit();
		}
		
	}else{
			//echo "isset false.";
	};
	ob_end_flush();
?>