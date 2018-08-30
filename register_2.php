<?php include 'navbar.php' ?>
<?php include 'connection_chat.php' ?>
<?php include 'sendmail_2.php'; ?>
<?php
	if(!empty($_REQUEST["type"]))
		$q=$_REQUEST["type"];
	else
		$q="";
?>
<?php 
	
	$username=$_REQUEST['name'];
	$mobile=$_REQUEST['mobile'];
	$user_mail=htmlspecialchars($_REQUEST['email']);
	if($q == "send"){		
		try{
			$mail->addAddress($user_mail,$username);
			$reseturl=encoded_string($user_mail,$username,$mobile);
			$code=rand(1000,10000);
			$mail->Body="<h1>Click on this link to verify your email After Verification your default password will be: user </h1><br><br> Your code :<strong> $code </strong><br><a href='$reseturl'>Reset Link</a>";
			$mail->send();				
			$sql="INSERT INTO `verification`(`Email`, `Code`) VALUES ('$user_mail',$code)";
			$sql2="INSERT INTO `users`(`Username`, `Mobile`, `Email`, `Password`, `Online`, `Verified`) VALUES ($username,$mobile,$user_mail,'demo',0,0)";
			$result=$conn->query($sql2);
			$result=$conn->query($sql);
			echo 'THANK YOU Verification mail has been sent';
		}catch (Exception $e) {
			echo 'Error: '.$mail->ErrorInfo;
		}
		
	}
	
?>
<?php
	function encoded_string($user_mail,$username,$mobile){
		$timestamp=time();
		//$encoded ="localhost/assignment1/register_3.php?t=".time()."&uname=".base64_encode($username)."&umail=".base64_encode($user_mail)."&mobile=".base64_encode($mobile);
		//$encoded ="localhost/assignment1/register_3.php?t=".base64_encode($timestamp)."&uname=".base64_encode($username)."&umail=".base64_encode($user_mail)."&mobile=".base64_encode($mobile);
		$encoded ="localhost/assignment1/register_3.php?t=".urlencode($timestamp)."&uname=".urlencode($username)."&umail=".urlencode($user_mail)."&mobile=".urlencode($mobile);
		//$encoded ="localhost/assignment1/register_2.php?uname=$username";
		return $encoded;
	}
?>
