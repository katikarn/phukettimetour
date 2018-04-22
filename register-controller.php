<?php
    include("inc/connectionToMysql.php");
    
	if( isset($_POST['hAction']) )
	{
        $txbagent_name = $_POST['txbagent_name'];
        $txbagent_name_acc = $_POST['txbagent_name_acc'];
        $txbagent_main_name = $_POST['txbagent_main_name'];
        $txbagent_mail_tel = $_POST['txbagent_mail_tel'];
        $txbagent_main_email = $_POST['txbagent_main_email'];

        $sql = "INSERT INTO agent (agent_status, agent_name, agent_name_acc, 
                                agent_main_name, agent_main_tel, agent_main_email, createdatetime, createby, updatedatetime, updateby) 
                    VALUES ('I', '$txbagent_name', '$txbagent_name_acc', 
                                '$txbagent_main_name', '$txbagent_mail_tel', '$txbagent_main_email', NOW(), '', NOW(), '')";
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			    echo "<script>alert('Failed to register.!'); window.location='register.php'</script>";
			}else{
                echo "<script>alert('Register successfully, Please waiting email approve !'); window.location='register.php'</script>";
        }
    }
?>