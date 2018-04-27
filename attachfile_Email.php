<?php
	include("constant.php");

	if( isset($_POST['SendMailBooking']) )
	{
		echo "<script>console.log('idAgent sent Email". $_POST['SendMailBooking'] ."');</script>";
		// $email = $_POST["email"];
		// echo "<script>alert('". $email ."');</script>";

		$to = 'katikarn@gmail.com'; // note the comma

		// Subject
		$subject = 'Mail - Phuket Time Tour';

		// Message
		$message = "
		<html>
		<body>
		    <table style='width: 600px;'>
			<tbody>
				<tr>
			        <td> Hi there,
			        </td>    
		    	</tr>
		    	<tr>
		        	<td>
		        		<div style='margin: 20px;padding: 10px;border-radius: 7px;'>
							<div style='background-color: #eee;'> 
								<div style='text-align: center;background: #474544;'>
									<img src='".$urlLogo."/logo.png' alt='SmartAdmin'>
								</div>
								<div style='padding: 20px'>
									<p>Click link below for reset password if you don't want to reset password don't action</p>
			        				<div style='margin-left:  auto; margin-right:  auto; width: 45%; background-color: #FF9800; text-align:  center;
	    								padding:  10px; border-radius: 5px;'>
	    								<a href='http://localhost/WebTour/PHP_HTML_seedProject/index.php' style='text-decoration: none;font-weight: bold; color: #FFF;'>Click here for reset Password</a>
	    							</div>		
								</div>
		        				
		    				</div>
		    			</div>
		        	</td>    
		    	</tr>
			    <tr>
			        <td>Phuket Time Tour</td>    
			    </tr>
			</tbody>
			</table>
		</body></html>";

         //// attach file
        $filename = 'fileTest.txt';
    	$path = $path_folder_PDF;
    	$file = $path . $filename;    

    	$content = file_get_contents($file);
    	$content = chunk_split(base64_encode($content));

    	$separator = md5(time());
    	$eol = "\r\n";

    	$body = "--" . $separator . $eol;
	    $body .= "Content-Type: text/html; charset=UTF-8" . $eol;
	    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
	    $body .= $message . $eol;
    	
    	$body .= "--" . $separator . $eol;
	    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
	    $body .= "Content-Transfer-Encoding: base64" . $eol;
	    $body .= "Content-Disposition: attachment" . $eol;
	    $body .= $content . $eol;
	    $body .= "--" . $separator . "--";  

        $headers = "From: Phuket Time Tour" . $sender . $eol;
    	$headers .= "MIME-Version: 1.0" . $eol;
    	$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    	$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    	$headers .= "This is a MIME encoded message." . $eol;

		// Mail it
		$flgSend = @mail($to, $subject, $body, $headers);
		if($flgSend){
			echo "<script>alert('Email send Complete');</script>";
		}else{
			echo "<script>alert('Error: Email can not send');</script>";
		}

	}
	
?>