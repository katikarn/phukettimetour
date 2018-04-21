<?php
	if (isset($_REQUEST['booking_detail_id']))
	{
		// Reject
		$id = $_REQUEST['booking_detail_id'];
		$LoginByUser = trim($_SESSION['LoginUser']);
		$txbbooking_detail_reject_reason=$_REQUEST['txbbooking_detail_reject_reason'];

		$sql = "UPDATE booking_detail SET booking_detail_status='R', booking_detail_reject_reason='$txbbooking_detail_reject_reason',
		updatedatetime=NOW(), updateby='$LoginByUser'	WHERE booking_detail_id = '$id'";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
	}elseif ( isset($_REQUEST['booking_detail_id2']))
	{
		// Confirm
		$id = $_REQUEST['booking_detail_id2'];
		$LoginByUser = trim($_SESSION['LoginUser']);
		$txbbooking_detail_confirm=$_REQUEST['txbbooking_detail_confirm'];

		$sql = "UPDATE booking_detail SET booking_detail_status='C', booking_detail_confirm='$txbbooking_detail_confirm', 
		updatedatetime=NOW(), updateby='$LoginByUser'	WHERE booking_detail_id = '$id'";
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		$sql = "UPDATE booking SET booking_status='C' WHERE booking_id=(SELECT booking_id from 
		booking_detail WHERE booking_detail_id='$id') and 0=(SELECT count(booking_id) AS cN FROM 
		booking_detail WHERE booking_id=(SELECT booking_id from 
		booking_detail WHERE booking_detail_id='$id') and booking_detail_status='N')";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
	}
?>