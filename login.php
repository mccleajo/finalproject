<?php
if ( isset ( $_COOKIE['login'] ) ) {
	$exptime = time() + 30;
	setcookie('login', $_COOKIE['login'], $exptime);
	header("Location: homepage.php?");	
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>BMWLand</title>
     <script type = "text/javascript" src = "javascript.js"> </script>

     <link rel="stylesheet" type="text/css" href="projectstyle.css">

     <style type = "text/css">
     body { background: url(lock_bmw.jpg) no-repeat center center fixed; background-size: contain; background-repeat: no-repeat; font-family: helvetica;}
     </style>

</head>
<body>

<?php
 
include 'forgotpassword.php';
if ( isset ( $_POST['newpw'] ) ) {
	if ( True == checkemail( $_POST['email'] ) ){
 		updatepassword( $_POST['email'] );
 		?> <h3>A new password has been e-mailed to you!</h3> <?php
 		displayform();
 	}
 	else{
 		?> <h2> E-Mail Address Not Found </h2> <?php
 		forgotpasswordform();
 	}
 }
else if ( isset ( $_POST['newacc'] ) ) {
	newaccountform();	
} 
else if ( isset ( $_POST['forgotpw'] ) ) {
	forgotpasswordform();
}
else if ( isset ( $_GET['login'] ) ) {
	if ( "Failed" == $_GET['login'] ){
		?> <h2> E-Mail and Password combination do not match! </h2><?php
		displayform();
	}
}
else if ( isset ( $_GET['adduser'] ) ) {
	if ( "success" == $_GET['adduser'] ){
		?> <h3>User successfully added! <?php
		displayform();
	}
} else {
	displayform();	
}



?>
</body>
</html>

<?php 

function displayform(){

?>

	<legend>Welcome to BMW Land.</legend><br>
		<form method="post" action="dboperation.php" onsubmit="return validatelogin();">
			E-Mail Address:<br><input type='text' name='email' id='email'><span id="emailerror"></span><br>
			Password:<br><input type='password' name='password' id='password'><span id="passworderror"></span><br>
			<br><input class ='mybutton' type='submit' name='login' value='Login'><br>
			<input type='hidden' name='op' value='login'><br><br>
		</form>
		<form method="post">
			<input class ='mybutton' type='submit' name='newacc' value='Register a New Account'><br><br>
		</form>
		<form method="post">
			<input class ='mybutton' type='submit' name='forgotpw' value='Forgot Password?'>
		</form>
	
<?php
}

function newaccountform(){

?>
	<legend>Fill in your information below:</legend>
		<form method="post" action="dboperation.php" onsubmit="return validatenewuser();">
	<table>
    <tr>
        <td><label for="firstname">First name:</label></td>
        <td><input type="text" name="firstname" id="firstname"/></td>
        <td><span id="firstnameerror"></span></td>
    </tr>
    <tr>
        <td><label for="lastname">Last name:</label></td>
        <td><input type="text" name="lastname" id="lastname"/></td>
        <td><span id="lastnameerror"></span></td>
    </tr>
        <tr>
        <td><label for="newuser">Username:</label></td>
        <td><input type="text" name="newuser" id="newuser"/></td>
        <td><span id="usernameerror"></span></td>
    </tr>
    <tr>
        <td><label for="newemail">Email:</label></td>
        <td><input type="text" name="newemail" id="newemail"/></td>
        <td><span id="emailerror"></span></td>
    </tr>
    <tr>
        <td><label for="newpw">Password:</label></td>
        <td><input type="password" name="newpw" id="newpw"/></td>
        <td><span id="passworderror"></span></td>
    </tr>
    <tr>
        <td><label for="newpw2">Confirm Password:</label></td>
        <td><input type="password" name="newpw2" id="newpw2"/></td>
        <td><span id="password2error"></span></td>
    </tr>
    </table>
			<input class ='mybutton' type='submit' name='register' value='Register'>
			<input type='hidden' name='op' value='register'><br><br>
			<a href="login.php">
				<input class ='mybutton' type="button" value="Return to Login" />
			</a>
		</form>
	
			
<?php

}

function forgotpasswordform(){

?>
		<legend>Forgot your password?</legend><br>
		<form method="post" onsubmit="return validateforgotpassword();">
			Enter your e-mail address:<br><input type='text' name='email' id='email'><span id='forgotemailerror'></span><br>
			<br><input class ='mybutton' type='submit' name ='newpw' value='Get New Password!'><br><br>
			<a href="login.php">
				<input class ='mybutton' type="button" value="Return to Login" />
			</a>
		</form>
	
<?php
}
?>

