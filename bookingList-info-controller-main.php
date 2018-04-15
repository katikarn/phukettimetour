<?php
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");

	if( isset($_POST["id"]) )	{
        //Variable from the user
        $id = $_POST["id"];
        $lsbagent_id = $_POST["lsbagent_id"];
        $txbbooking_name = $_POST["txbbooking_name"];
        $txbbooking_pax = $_POST["txbbooking_pax"];
        $txbbooking_nat = $_POST["txbbooking_nat"];
        $txbbooking_tel = $_POST["txbbooking_tel"];
        $txbbooking_line = $_POST["txbbooking_line"];
        $txbbooking_remark = $_POST["txbbooking_remark"];
        $chkbooking_status = $_POST["chkbooking_status"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($id<>"") {
			$sql = "UPDATE booking SET agent_id='$lsbagent_id', booking_name='$txbbooking_name', booking_pax='$txbbooking_pax', 
            booking_nat='$txbbooking_nat', booking_tel='$txbbooking_tel', booking_line='$txbbooking_line',
            booking_remark='$txbbooking_remark', booking_status='$chkbooking_status', updatedatetime=NOW(), updateby='$LoginByUser'";
            $sql = $sql." WHERE booking_id = '".$_POST["id"]."'";
            //DB
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            $id = $_POST["id"];
		}else{                       
			$sql = "INSERT INTO booking (agent_id, booking_name, booking_pax, booking_nat,
            booking_tel, booking_line, booking_remark, booking_status, createdatetime, createby, updatedatetime, updateby
            ) VALUES ('$lsbagent_id', '$txbbooking_name', '$txbbooking_pax', '$txbbooking_nat',
            '$txbbooking_tel', '$txbbooking_line', '$txbbooking_remark', '$chkbooking_status', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
            //DB
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            $result = mysqli_query($_SESSION['conn'] ,"SELECT max(booking_id) as m_id FROM booking");
            $row = mysqli_fetch_assoc($result);
            $id = $row['m_id'];
        }
        header("location: bookingList-info.php?id=$id");
    }
?>