<?php
	//Start session
	//Check whether the session variable SESS_MEMBER_ID is present or not

	if(!isset($_SESSION['LoginUserID']) || (trim($_SESSION['LoginUser']) == '')) {
		//header("location: login.php");

	}
?>