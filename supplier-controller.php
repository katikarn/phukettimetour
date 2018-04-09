<?php
	if(isset($_POST["submitAddSupplier"]))	{
		if(isset($_POST["supplier_id"])){
			$supplier_id = $_POST["supplier_id"];
		}	
        //Variable from the user	
        $supplier_status = $_POST["rdosupplier_status"];
        $supplier_type = $_POST["lsbsupplier_type"];
        $supplier_destination = $_POST["lsbsupplier_destination"];
        $supplier_name = $_POST["txbsupplier_name"];
        $supplier_name_acc = $_POST["txbsupplier_name_acc"];
        $supplier_address = $_POST["txbsupplier_address"];
        $supplier_tel = $_POST["txbsupplier_tel"];
        $supplier_website = $_POST["txbsupplier_website"];
        $supplier_googlemap = $_POST["txbsupplier_googlemap"];
        $supplier_contract_file = $_POST["txbsupplier_contract_file"];
        $supplier_other_file = $_POST["txbsupplier_other_file"];
        $supplier_paytype = $_POST["lsbsupplier_paytype"];
        $supplier_max_credit = $_POST["txbsupplier_max_credit"];
        $supplier_credit_term = $_POST["txbsupplier_credit_term"];
        $supplier_sales_name = $_POST["txbsupplier_sales_name"];
        $supplier_sales_tel = $_POST["txbsupplier_sales_tel"];	
        $supplier_sales_email = $_POST["txbsupplier_sales_email"];
        $supplier_sales_line = $_POST["txbsupplier_sales_line"];
        $supplier_reserv_name = $_POST["txbsupplier_reserv_name"];
        $supplier_reserv_tel = $_POST["txbsupplier_reserv_tel"];
        $supplier_reserv_email = $_POST["txbsupplier_reserv_email"];
        $supplier_reserv_line = $_POST["txbsupplier_reserv_line"];
        $supplier_reserv_fax = $_POST["txbsupplier_reserv_fax"];
        $supplier_reserv_main = $_POST["lsbsupplier_reserv_main"];
        $supplier_account_name = $_POST["txbsupplier_account_name"];
        $supplier_account_tel = $_POST["txbsupplier_account_tel"];
        $supplier_account_email = $_POST["txbsupplier_account_email"];
        $supplier_remark = $_POST["txbsupplier_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST["submitAddSupplier"] == "Insert"){
			$sql = "INSERT INTO `supplier` (`supplier_status`, `supplier_type`, 
                                            `supplier_destination`, `supplier_name`, `supplier_name_acc`, 
                                            `supplier_address`, `supplier_tel`, `supplier_website`, `supplier_googlemap`, 
                                            `supplier_contract_file`, `supplier_other_file`, `supplier_paytype`, `supplier_max_credit`, 
                                            `supplier_credit_term`, `supplier_sales_name`, `supplier_sales_tel`, 
                                            `supplier_sales_email`, `supplier_sales_line`, `supplier_reserv_name`, 
                                            `supplier_reserv_tel`, `supplier_reserv_email`, `supplier_reserv_line`, 
                                            `supplier_reserv_fax`, `supplier_reserv_main`, `supplier_account_name`, 
                                            `supplier_account_tel`, `supplier_account_email`, `supplier_remark`, 
                                            `createdatetime`, `createby`, `updatedatetime`, `updateby`) 
                                    VALUES ('$supplier_status','$supplier_type',
                                            '$supplier_destination', '$supplier_name', '$supplier_name_acc', 
                                            '$supplier_address', '$supplier_tel', '$supplier_website', '$supplier_googlemap', 
                                            '$supplier_contract_file', '$supplier_other_file', '$supplier_paytype', '$supplier_max_credit', 
                                            '$supplier_credit_term', '$supplier_sales_name', '$supplier_sales_tel', 
                                            '$supplier_sales_email', '$supplier_sales_line', '$supplier_reserv_name', 
                                            '$supplier_reserv_tel', '$supplier_reserv_email', '$supplier_reserv_line', 
                                            '$supplier_reserv_fax', '$supplier_reserv_main', '$supplier_account_name', 
                                            '$supplier_account_tel', '$supplier_account_email', '$supplier_remark', 
                                            NOW(),'$LoginByUser',NOW(),'$LoginByUser')";			
		}else if($_POST['submitAddSupplier'] == "Update"){
			$sql = "UPDATE `supplier` 
					SET `supplier_status`='$supplier_status' ,`supplier_type`='$supplier_type',
                        `supplier_destination`='$supplier_destination', `supplier_name`='$supplier_name', `supplier_name_acc`='$supplier_name_acc', 
                        `supplier_address`='$supplier_address', `supplier_tel`='$supplier_tel', `supplier_website`='$supplier_website', `supplier_googlemap`='$supplier_googlemap', 
                        `supplier_contract_file`='$supplier_contract_file', `supplier_other_file`='$supplier_other_file', `supplier_paytype`='$supplier_paytype', `supplier_max_credit`='$supplier_max_credit', 
                        `supplier_credit_term`='$supplier_credit_term', `supplier_sales_name`='$supplier_sales_name', `supplier_sales_tel`='$supplier_sales_tel',
                        `supplier_sales_email`='$supplier_sales_email', `supplier_sales_line`='$supplier_sales_line', `supplier_reserv_name`='$supplier_reserv_name',
                        `supplier_reserv_tel`='$supplier_reserv_tel', `supplier_reserv_email`='$supplier_reserv_email', `supplier_reserv_line`='$supplier_reserv_line', 
                        `supplier_reserv_fax`='$supplier_reserv_fax', `supplier_reserv_main`='$supplier_reserv_main', `supplier_account_name`='$supplier_account_name', 
                        `supplier_account_tel`='$supplier_account_tel', `supplier_account_email`='$supplier_account_email', `supplier_remark`='$supplier_remark',
                        `updatedatetime`=NOW(), `updateby`='$LoginByUser'
					WHERE `supplier_id` = '$supplier_id'";
		}else {
            $sql = "";
        }
        if ($sql<>"")   {
		    $result = mysqli_query($_SESSION['conn'] ,$sql);
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