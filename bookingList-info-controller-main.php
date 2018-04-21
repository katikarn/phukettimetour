<?php
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");

    if (isset($_GET["hAction"])) {
        if ($_GET["hAction"]=="Del")    {
            $id = $_GET["id"];
            $sql = "DELETE FROM booking WHERE booking_id='$id'";
            //DB
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            header("location: bookingList.php");
        }
    }else{
        if(isset($_REQUEST["id"]))	{
            //Variable from the user
            $id = $_REQUEST["id"];
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
                $sql = "SELECT * FROM booking_detail WHERE booking_id='$id' and booking_detail_status<>'C'";
                $result = mysqli_query($_SESSION['conn'] ,$sql);
                if(mysqli_num_rows($result) > 0){
                    $chkbooking_status='N';
                }

                $sql = "UPDATE booking SET agent_id='$lsbagent_id', booking_name='$txbbooking_name', booking_pax='$txbbooking_pax', 
                booking_nat='$txbbooking_nat', booking_tel='$txbbooking_tel', booking_line='$txbbooking_line',
                booking_remark='$txbbooking_remark', booking_status='$chkbooking_status', updatedatetime=NOW(), updateby='$LoginByUser'";
                $sql = $sql." WHERE booking_id = '".$id."'";
                //DB
                $result = mysqli_query($_SESSION['conn'] ,$sql);
            }else{                       
                $sql = "INSERT INTO booking (agent_id, booking_name, booking_pax, booking_nat,
                booking_tel, booking_line, booking_remark, booking_status, createdatetime, createby, updatedatetime, updateby
                ) VALUES ('$lsbagent_id', '$txbbooking_name', '$txbbooking_pax', '$txbbooking_nat',
                '$txbbooking_tel', '$txbbooking_line', '$txbbooking_remark', 'N', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
                //DB
                $result = mysqli_query($_SESSION['conn'] ,$sql);
                $result = mysqli_query($_SESSION['conn'] ,"SELECT max(booking_id) as m_id FROM booking");
                $row = mysqli_fetch_assoc($result);
                $id=$row['m_id'];
            }
            header("location: bookingList-info.php?id=$id");
        }
    }
?>