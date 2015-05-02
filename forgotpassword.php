<?php

function checkemail($email){
	$query="SELECT * FROM users WHERE email='$email'";
	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$dbemail = $row['email'];
	if ( $email == $dbemail ){
		return true;
	}
	else{
		return false;
	}
}

function createpassword() {// start with an empty password
	$password="";
	
	//define possible characters
	$possible="23456789abcdefghjklmnpwrstuvwxyz";
	
	$password="";
	$length=8;
	
	for ($i=1; $i<=$length; $i++){
		$pick=rand(0, strlen($possible)-1);
		
		// pick a random character from the possible characters
		$passchar=substr($possible, $pick, 1);
		
		$password .= $passchar;
	}
	return $password;
}
    	
function updatepassword($email){
	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
	$newpw = createpassword();
	$shapw = sha1($newpw);
    $query = "UPDATE users SET password='$shapw' WHERE email='$email'";
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));
	sendemail($email, $newpw);
}

function sendemail($email, $password){
	$subject = "New E-Mail!";
	$message = "Your New Password is: $password ";
	mail($email, $subject, $message);
}

?>