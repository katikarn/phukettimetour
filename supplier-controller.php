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
        //Attach File
        $Text_contract_file = $_POST["Text_contract_file"];
        $Text_other_file = $_POST["Text_other_file"];
        $supplier_contract_file = $_FILES["txbsupplier_contract_file"]["name"];
        $supplier_other_file = $_FILES["txbsupplier_other_file"]["name"];

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

        //////////// upload file
        $target_dir = "upload/supplier/";
        //echo "Input File : ".$supplier_contract_file."<br>";
        //echo "Input Text_contract_file : ".$Text_contract_file."<br>";
        $target_file = $target_dir . basename($_FILES["txbsupplier_contract_file"]["name"]);
        $target_fileOther = $target_dir . basename($_FILES["txbsupplier_other_file"]["name"]);
        $uploadOk = 1;
        $uploadOtherOk = 1;
        $Status_contract_FileUpload = '';
        $Status_Other_FileUpload = '';
        
		if($supplier_contract_file != '' && $supplier_contract_file != null){
		// Check if file already exists
			if (file_exists($target_file)) {
				//echo "Sorry, file already exists.";
				$Status_contract_FileUpload .="Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				//echo "Sorry, your file was not uploaded.";
				$Status_contract_FileUpload .="Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["txbsupplier_contract_file"]["tmp_name"], $target_file)) {
					//echo "The file ". basename( $_FILES["txbsupplier_contract_file"]["name"]). " has been uploaded.";
					$Status_contract_FileUpload .= "The file ". basename( $_FILES["txbsupplier_contract_file"]["name"]). " has been uploaded.";
					$uploadOk = 2;
				} else {
					//echo "Sorry, there was an error uploading your file.";
					$Status_contract_FileUpload .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$Status_contract_FileUpload .="No have upload.";
		}
        if($supplier_other_file != '' && $supplier_other_file != null){
		// Check if file already exists
			if ($supplier_other_file != '' && file_exists($target_fileOther)) {
				//echo "Sorry, file already exists.";
				$Status_Other_FileUpload .= "Sorry, file already exists.";
				$uploadOtherOk = 0;
			}
	 
			
			if ($uploadOtherOk == 0) { 
				//echo "Sorry, your file was not uploaded.";
				$Status_Other_FileUpload .= "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["txbsupplier_other_file"]["tmp_name"], $target_file)) {
					//echo "The file ". basename( $_FILES["txbsupplier_other_file"]["name"]). " has been uploaded.";
					$Status_Other_FileUpload .= "The file ". basename( $_FILES["txbsupplier_other_file"]["name"]). " has been uploaded.";
					$uploadOtherOk = 2;
				} else {
					//echo "Sorry, there was an error uploading your file.";
					$Status_Other_FileUpload .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$Status_Other_FileUpload .="No have upload.";
		}
		
        if($supplier_contract_file != '' || $supplier_other_file != ''){
            echo "<script>alert('Contract Files : \\n".$Status_contract_FileUpload."\\nOther File : \\n".$Status_Other_FileUpload."');</script>";
        }
        
        $save = false;
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
            if($supplier_contract_file == null && $Text_contract_file != '' ){
                $supplier_contract_file = $Text_contract_file;
            }else if($supplier_contract_file != '' && $Text_contract_file != '' 
                && $supplier_contract_file != $Text_contract_file && $uploadOk == 2){
                //unlink($target_dir+$Text_contract_file);
                unlink($target_dir.$Text_contract_file);
            }else if($uploadOk != 2){
                $supplier_contract_file = $Text_contract_file;
            }
            
            if($supplier_other_file == null && $Text_other_file != ''){
                $supplier_other_file = $Text_other_file;
            }else if($supplier_other_file != '' && $Text_other_file != '' 
                    && $supplier_other_file != $Text_other_file && $uploadOtherOk == 2){
                //unlink($target_dir+$Text_contract_file);
                unlink($target_dir.$Text_other_file);
            }else if($uploadOtherOk != 2){
                $supplier_other_file = $Text_other_file;
            }
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
        //echo $sql;
        if ($sql<>"")   {
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if($_POST["submitAddSupplier"] == "Insert"){
                //header("location: supplier-management.php");
            }
        }
    }
    if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM supplier WHERE supplier_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='supplier-management.php'</script>";
        }
    }
?>