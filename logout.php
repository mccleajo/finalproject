<?php
logout();
header("Location: login.php");
function logout(){
	setcookie('login', 0, time()-3600);
}
?>