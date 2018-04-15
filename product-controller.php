<?php
	if( isset($_POST["submitAddProduct"]) )	{
        if(isset($_POST["product_id"])) {
			$product_id = $_POST["product_id"];
        }
        //Variable from the user
        $supplier_id = $_POST["lsbsupplier_id"];
        $product_status = $_POST["chkproduct_status"];
        $product_name = $_POST["txbproduct_name"];
        $product_desc = $_POST["txbproduct_desc"];
        $product_detail = $_POST["txbproduct_detail"];
        $product_file1 = $_POST["txbproduct_file1"];
        $product_file2 = $_POST["txbproduct_file2"];
        $product_file3 = $_POST["txbproduct_file3"];
        $product_confirm_class = $_POST["chkproduct_confirm_class"];
        $product_seat = $_POST["chkproduct_seat"];
        $product_for = $_POST["chkproduct_for"];
        $product_showtime = $_POST["txbproduct_showtime"];
        $product_endtime = $_POST["txbproduct_endtime"];
        $product_duration = $_POST["txbproduct_duration"];
        $product_car_type = $_POST["lsbproduct_car_type"];
        $product_meal_type = $_POST["lsbproduct_meal_type"];
        $product_cost_price = $_POST["txbproduct_cost_price"];
        $product_normal_price = $_POST["txbproduct_normal_price"];
        $product_oversea_price = $_POST["txbproduct_oversea_price"];
        $product_price_l1 = $_POST["txbproduct_price_l1"];
        $product_price_l2 = $_POST["txbproduct_price_l2"];
        $product_remark = $_POST["txbproduct_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST["submitAddProduct"] == 'Insert')  {
			$sql = "INSERT INTO `product` (`supplier_id`, `product_status`, `product_name`, `product_desc`, 
            `product_detail`, `product_file1`, `product_file2`, `product_file3`, `product_confirm_class`, 
            `product_seat`, `product_for`, `product_showtime`, `product_endtime`, `product_duration`, `product_car_type`, 
            `product_meal_type`, `product_cost_price`, `product_normal_price`, `product_oversea_price`, 
            `product_price_l1`, `product_price_l2`, `product_remark`, `createdatetime`, `createby`, `updatedatetime`, 
            `updateby`) VALUES ('$supplier_id', '$product_status', '$product_name', '$product_desc',
            '$product_detail', '$product_file1', '$product_file2', '$product_file3', '$product_confirm_class', 
            '$product_seat', '$product_for', '$product_showtime', '$product_endtime', '$product_duration', '$product_car_type', 
            '$product_meal_type', '$product_cost_price', '$product_normal_price', '$product_oversea_price', 
            '$product_price_l1', '$product_price_l2', '$product_remark', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST["submitAddProduct"] == 'Update')  {
			$sql = "UPDATE `product` SET `supplier_id`='$supplier_id', `product_status`='$product_status', 
            `product_name`='$product_name', `product_desc`='$product_desc', `product_detail`='$product_detail',
            `product_file1`='$product_file1', `product_file2`='$product_file2', `product_file3`='$product_file3', 
            `product_confirm_class`='$product_confirm_class', `product_seat`='$product_seat', `product_for`='$product_for', 
            `product_showtime`='$product_showtime', `product_endtime`='$product_endtime', `product_duration`='$product_duration', 
            `product_car_type`='$product_car_type', `product_meal_type`='$product_meal_type', `product_cost_price`='$product_cost_price', 
            `product_normal_price`='$product_normal_price', `product_oversea_price`='$product_oversea_price', `product_price_l1`='$product_price_l1', 
            `product_price_l2`='$product_price_l2', `product_remark`='$product_remark', `updatedatetime`=NOW(), `updateby`='$LoginByUser'
			WHERE `product_id` = '$product_id'";
		}else {
            $sql = "";
        }
        if ($sql<>"")   {
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if($_POST["submitAddProduct"] == 'Insert') {
                header("location: product-setup.php");
            }
		    //echo "result : ".$result."<br>";
		    if(!$result) {
			    //echo "<script>alert('Failed to added.This user is already used.!'); window.location='supplier-management.php'</script>";
		    }else{
			    //echo "<script>alert('User successfully added!'); window.location='supplier-management.php'</script>";
            }
        }
	}else{
		// echo "not ok";
	}
?>