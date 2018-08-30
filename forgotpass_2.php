<?php include 'connection.php'; ?>
<?php include 'sendmail_2.php'; ?>
<?php 
	$user_mail=htmlspecialchars($_REQUEST['email']);
	echo $user_mail;
	$sql="SELECT * FROM login WHERE Email='$user_mail' ";
	$result= $conn->query($sql);
	//var_dump($result);
	//print_r($result);
	if($result->num_rows >0)
	{
		while($row=$result->fetch_assoc()){			
			$user_mail=$row['Email'];
			$username=$row['Username'];
			//$mail->send();
			try{
				$mail->addAddress($user_mail,$username);
				$reseturl=encoded_string($username,$user_mail);
				$mail->Body="<h1>Your Password RESET LINK</h1><br><a href='$reseturl'>Reset Link</a>";
				$mail->send();
				echo 'Message has been sent';
			}catch (Exception $e) {
				echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			}
		}
	}	
	else
		echo "INVALID EMAIL ID";	
?>
<?php
	function encoded_string($username,$email){
		$timestamp=time();
		//$url="time=$timestamp&username=$username&email=$email";
		$encoded ="localhost/assignment1/resetpage.php?t=".base64_encode($timestamp)."&uname=".base64_encode($username);
		return $encoded;
	}
?>