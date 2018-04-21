<?php
	if( isset($_GET["hAction"]) )	{
        if(isset($_GET["booking_detail_id"])) {
            $booking_detail_id = $_GET["booking_detail_id"];
        }

        // Delete
        if ($_GET['hAction']=="Delete") {
            $sql = "DELETE FROM  booking_detail WHERE booking_detail_id = '".$booking_detail_id."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This booking detail is already used.!'); window.location='bookingList-info.php'</script>";
            }else{
                header("location: bookingList.php");
            }
        }else{
            $booking_id = $_GET["booking_id"];
            $lsbsupplier_id = $_GET["lsbsupplier_id"];
            $lsbproduct_id = $_GET["lsbproduct_id"];
            $txbbooking_detail_qty = $_GET["txbbooking_detail_qty"];
            $txbbooking_detail_price = $_GET["txbbooking_detail_price"];
            $txbbooking_detail_vat = $_GET["txbbooking_detail_vat"];
            $txbbooking_detail_total_amount = $_GET["txbbooking_detail_total_amount"];
            $txbbooking_detail_date = $_GET["txbbooking_detail_date"];
            $txbbooking_detail_time = $_GET["txbbooking_detail_time"];
            $txbbooking_detail_note = $_GET["txbbooking_detail_note"];
            $chkbooking_detail_status = $_GET["chkbooking_detail_status"];
            $LoginByUser = trim($_SESSION['LoginUser']);
            // Insert
            if($_GET["hAction"] == 'Insert')  {
                $sql = "INSERT INTO `booking_detail` (`booking_detail_status`, `booking_detail_note`, 
                `booking_detail_date`, `booking_detail_time`, `booking_detail_price`, `booking_detail_vat`, 
                `booking_detail_qty`, `booking_detail_total_amount`, `product_id`, `booking_id`,
                `createdatetime`, `createby`, `updatedatetime`, `updateby`) VALUES ('$chkbooking_detail_status', '$txbbooking_detail_note', 
                '$txbbooking_detail_date', '$txbbooking_detail_time', '$txbbooking_detail_price', '$txbbooking_detail_vat', 
                '$txbbooking_detail_qty', '$txbbooking_detail_total_amount', '$lsbproduct_id', '$booking_id', 
                'NOW()', '$LoginByUser', 'NOW()', '$LoginByUser')";
            }else if($_GET["hAction"] == 'Update')  {
                // Update
                $sql = "UPDATE `booking_detail` SET `booking_detail_status`='$chkbooking_detail_status', `booking_detail_note`='$txbbooking_detail_note', 
                `booking_detail_date`='$txbbooking_detail_date', `booking_detail_time`='$txbbooking_detail_time', `booking_detail_price`='$txbbooking_detail_price',
                `booking_detail_vat`='$txbbooking_detail_vat', `booking_detail_qty`='$txbbooking_detail_qty', `booking_detail_total_amount`='$txbbooking_detail_total_amount', 
                `product_id`='$lsbproduct_id', `updatedatetime`=NOW(), `updateby`='$LoginByUser'
                WHERE `booking_detail_id` = '$booking_detail_id'";
            }else {
                $sql = "";
            }
            echo $sql;
            if ($sql<>"")   {
                $result = mysqli_query($_SESSION['conn'] ,$sql);
                header("location: bookingList-info.php?id=$booking_id");
            }
        }
    }
?>