<?php
$op = $_POST['op'];
switch ( $op ) {
	case 'login':
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ( False == checklogin( $email, $password ) ){
			header("Location: login.php?login=Failed");
			break;
		} else {
			createlogincookie();
			header( "Location: homepage.php" );	
			break;	
		}
	case 'register':
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['newuser'];
		$email = $_POST['newemail'];
		$password = sha1($_POST['newpw']);
		adduser( $firstname, $lastname, $username, $email, $password );
		header( "Location: login.php?adduser=success" );
	case 'Log Out':
		logout();
		header( "Location: login.php" ); 
	default:
		die("error!");
		break;
}	
function checklogin( $email, $password ) {
	$dbc = connectToDB( "mccleajo" );
	$encodepw = sha1( $password );
	$result = performQuery( $dbc, 
		"select * FROM users where email='$email' and password='$encodepw'" );
	$matches = mysqli_num_rows( $result );
	mysqli_free_result( $result );
	disconnectFromDB( $dbc );
	return( $matches == 1 );
}
function connectToDB( $database ) {
	$dbc= @mysqli_connect( "localhost", "mccleajo", "pV2YzEEU", $database ) or
					die("Connect failed: ". mysqli_connect_error() );
	return ( $dbc );
}
function adduser($firstname, $lastname, $username, $email, $password){
	$dbc = connectToDB( "mccleajo" );
	$result = performQuery( $dbc, 
		"INSERT INTO users VALUES (DEFAULT, '$firstname', '$lastname', '$username', '$email', '$password', now())" );
	disconnectFromDB( $dbc );
}
function disconnectFromDB( $dbc ) {
	mysqli_close( $dbc );
}
function performQuery( $dbc, $query ){
	//echo "My query is >$query< <br />";	
	$result = mysqli_query( $dbc, $query ) or die( "bad query".mysqli_error( $dbc ) );
	return ( $result );
}
function createlogincookie(){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$userinfo = $email . "," . $password;
	$exptime = time() + 900;
	setcookie('login', $userinfo, $exptime);
}
function logout(){
	setcookie('login', 0, time()-3600);
}

?>