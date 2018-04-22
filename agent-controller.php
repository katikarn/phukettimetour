<?php
	if( isset($_POST['submitAddAgent']) )
	{
		// echo " ok2<br>";
		//Variable from the user
        $agent_id = $_POST["agent_id"];
        $chkagent_status = $_POST["chkagent_status"];
        $txbagent_name = $_POST["txbagent_name"];
        $txbagent_name_acc = $_POST["txbagent_name_acc"];
        $txbagent_address = $_POST["txbagent_address"];
        $txbagent_license = $_POST["txbagent_license"];
        $lsbagent_section = $_POST["lsbagent_section"];
        $txbagent_username = $_POST["txbagent_username"];
        $txbagent_password = $_POST["txbagent_password"];
        $chkagent_pay_type = $_POST["chkagent_pay_type"];
        $txbagent_amount = $_POST["txbagent_amount"];
        $txbagent_creditterm = $_POST["txbagent_creditterm"];
        $chkagent_vat_type = $_POST["chkagent_vat_type"];
        $chkagent_price_type = $_POST["chkagent_price_type"];
        $txbagent_main_name = $_POST["txbagent_main_name"];
        $txbagent_main_tel = $_POST["txbagent_main_tel"];
        $txbagent_main_email = $_POST["txbagent_main_email"];
        $txbagent_main_line = $_POST["txbagent_main_line"];
        $txbagent_reserv_name = $_POST["txbagent_reserv_name"];
        $txbagent_reserv_tel = $_POST["txbagent_reserv_tel"];
        $txbagent_reserv_email = $_POST["txbagent_reserv_email"];
        $txbagent_reserv_line = $_POST["txbagent_reserv_line"];
        $txbagent_reserv_fax = $_POST["txbagent_reserv_fax"];
        $txbagent_account_name = $_POST["txbagent_account_name"];
        $txbagent_account_tel = $_POST["txbagent_account_tel"];
        $txbagent_account_email = $_POST["txbagent_account_email"];
        $txbagent_remark = $_POST["txbagent_remark"];
        $submitAddAgent = $_POST["submitAddAgent"];
		$LoginByUser = trim($_SESSION['LoginUser']);

        //////////// Attach File ////////////
		$Text_txbagent_file = $_POST["Text_txbagent_file"];
        $agent_txbagent_file = $_FILES["txbagent_file"]["name"];
		//echo "Input File : ".$_FILES["txbagent_file"]["name"]."<br>";
		//echo "Input Text_txbagent_file : ".$Text_txbagent_file."<br>";
		
		//////////// upload file ////////////
		$target_dir = "upload/agent/";
        //echo "Input File : ".$_FILES["txbagent_file"]["name"]."<br>";
        //echo "Input Text_contract_file : ".$Text_contract_file."<br>";
        $target_file = $target_dir . basename($_FILES["txbagent_file"]["name"]);
        $uploadOk = 1;
        $Status_txbagent_file = '';
		if($agent_txbagent_file != '' && $agent_txbagent_file != null){
			//////////// Check if file already exists //////////// 
			if (file_exists($target_file)) {
				$Status_txbagent_file .="Sorry, file already exists.";
				$uploadOk = 0;
			}
			//////////// Check if $uploadOk is set to 0 by an error //////////// 
			if ($uploadOk == 0) {
				$Status_txbagent_file .="Sorry, your file was not uploaded.";
			//////////// if everything is ok, try to upload file //////////// 
			} else {
				if (move_uploaded_file($_FILES["txbagent_file"]["tmp_name"], $target_file)) {
					$Status_txbagent_file .= "The file ". basename( $_FILES["txbagent_file"]["name"]). " has been uploaded.";
					$uploadOk = 2;
				} else {
					//echo "Sorry, there was an error uploading your file.";
					$Status_txbagent_file .= "Sorry, there was an error uploading your file.";
				}
            }
            echo "<script>alert('Include files : \\n".$Status_txbagent_file."');</script>";
        }
        
        if($_POST['submitAddAgent'] == 'Insert'){
            $sql = "INSERT INTO `agent` (`agent_status`, `agent_name`, `agent_name_acc`,
                                `agent_address`, `agent_license`, `agent_section`, `agent_file`, 
                                `agent_username`, `agent_password`, `agent_pay_type`, `agent_amount`, 
                                `agent_creditterm`, `agent_vat_type`, `agent_price_type`, `agent_main_name`, 
                                `agent_main_tel`, `agent_main_email`, `agent_main_line`, `agent_reserv_name`, 
                                `agent_reserv_tel`, `agent_reserv_email`, `agent_reserv_line`, `agent_reserv_fax`, 
                                `agent_account_name`, `agent_account_tel`, `agent_account_email`, 
                                `agent_remark`, `createdatetime`, `createby`, `updatedatetime`, `updateby`) 
                    VALUES ('$chkagent_status', '$txbagent_name', '$txbagent_name_acc',  
                                '$txbagent_address', '$txbagent_license', '$lsbagent_section', '$agent_txbagent_file', 
                                '$txbagent_username', '$txbagent_password', '$chkagent_pay_type', '$txbagent_amount', 
                                '$txbagent_creditterm', '$chkagent_vat_type', '$chkagent_price_type', '$txbagent_main_name', 
                                '$txbagent_main_tel', '$txbagent_main_email', '$txbagent_main_line', '$txbagent_reserv_name', 
                                '$txbagent_reserv_tel', '$txbagent_reserv_email', '$txbagent_reserv_line', '$txbagent_reserv_fax', 
                                '$txbagent_account_name', '$txbagent_account_tel', '$txbagent_account_email', 
                                '$txbagent_remark', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAddAgent'] == 'Update'){
            if($agent_txbagent_file == null && $Text_txbagent_file != '' ){
                $agent_txbagent_file = $Text_txbagent_file;
            }else if($agent_txbagent_file != '' && $Text_txbagent_file != '' 
                && $agent_txbagent_file != $Text_txbagent_file && $uploadOk == 2){
                unlink($target_dir.$Text_txbagent_file);
            }else if($uploadOk != 2){
                $agent_txbagent_file = $Text_txbagent_file;
            }
			$sql = "UPDATE `agent` SET 
                            `agent_status`='$chkagent_status', `agent_name`='$txbagent_name', `agent_name_acc`='$txbagent_name_acc', 
                            `agent_address`='$txbagent_address', `agent_license`='$txbagent_license', 
                            `agent_section`='$lsbagent_section', `agent_file`='$agent_txbagent_file', `agent_username`='$txbagent_username', 
                            `agent_password`='$txbagent_password', `agent_pay_type`='$chkagent_pay_type', `agent_amount`='$txbagent_amount', 
                            `agent_creditterm`='$txbagent_creditterm', `agent_vat_type`='$chkagent_vat_type', `agent_price_type`='$chkagent_price_type', 
                            `agent_main_name`='$txbagent_main_name', `agent_main_tel`='$txbagent_main_tel', `agent_main_email`='$txbagent_main_email', 
                            `agent_main_line`='$txbagent_main_line', `agent_reserv_name`='$txbagent_reserv_name', `agent_reserv_tel`='$txbagent_reserv_tel', 
                            `agent_reserv_email`='$txbagent_reserv_email', `agent_reserv_line`='$txbagent_reserv_line', `agent_reserv_fax`='$txbagent_reserv_fax', 
                            `agent_account_name`='$txbagent_account_name', `agent_account_tel`='$txbagent_account_tel', 
                            `agent_account_email`='$txbagent_account_email', `agent_remark`='$txbagent_remark', `updatedatetime`=NOW(), `updateby`='$LoginByUser'
					WHERE `agent_id` = '$agent_id'";	
		}
		//echo $sql."<br>";
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		// echo $result."<br>";

		if(!$result) {
			 //echo "<script>alert('Failed to added.This user is already used.!'); window.location='user-management.php'</script>";
			}else{
			 //echo "<script>alert('User successfully added!'); window.location='user-management.php'</script>";
		}
	}else{ 
	    // echo "not ok";
    }
        // Delete Action
        if (isset($_GET['hAction']))   {
            $sql = "DELETE FROM agent WHERE agent_id = '".$_GET['id']."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This agent is already used.!'); window.location='agent-management.php'</script>";
            }
        }
?>