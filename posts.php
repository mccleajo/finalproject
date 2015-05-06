<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Posts</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">
     
<body>

<div class="container">
<header>
    <div class="nav">
      <ul>
        <li><a  class="active" href="homepage.php">Home</a></li>
        <li><a href="locations.php">Locations</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="findprices.php">Prices</a></li>
        <li><a href="login.php">Log Out</a></li>
      </ul>
    </div>
</header>
</div>


<?php



if ( isset ( $_POST['addpost'] ) ){
	displayInsertPostForm();
}

else if ( isset ( $_POST['sendmail'] ) ) {

	$to = findemail( $_POST['id'] );
	$title = $_POST['title'];
	$body = $_POST['content'];
	$from = 'From: ' . $_COOKIE['login'];
	mail($to, $title, $body, $from);
	?> <h2> E-Mail Successfully Sent </h2> <?php
	displayposts();

}

else if ( isset ( $_POST['email'] ) ) {
	$id = $_POST['id'];
	$email = $_COOKIE['login'];
	displaymailform($id, $email);

}

else if ( isset ( $_POST['submit'] ) ) {
	insertPost();
}
else{
?>
	<h2>Here are posts from BMWLand users!</h2>
<?php
	displayposts();
}
?>



</body>
</html>

<?php

function displayposts(){

?>
	<form method='post'>
		<input type='submit' name = 'addpost' value='Add a Post'>
	</form>
	
<?php

	$query="SELECT * FROM posts";
	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));
	$rows = mysqli_num_rows($result); 
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id = $row['ID'];
		$title = $row['title'];
		$created_by = $row['created_by'];
		$content = $row['content'];
		$date = $row['date'];
		$post_type = $row['post_type'];
		
		showpost($id, $title, $created_by, $content, $date, $post_type);
		
	}
	

	
	
}

function showpost($id, $title, $created_by, $content, $date, $post_type, $button = True){

?>

	<form method='post'>
		<table>
			<tr>
				<td style="width:'500'"> 
					 <?php echo "$title $date"; ?><br>
					 <?php echo "$created_by $post_type"; ?><br>
					 <?php echo "$content"; ?> <br> 	
					 <input type='hidden' name='id' value="<?php echo $id; ?>" />				 
				</td>
			</tr>
		</table>
		
<?php 

		if ( True == $button ) {	
		?>	
		<input type='submit' value='E-Mail this user!' name="email" />	
		<?php
		}
		?>
	</form>

<?php	

}


function displaymailform($id, $email){

	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
    $query = "SELECT * FROM posts WHERE ID='$id'";
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$id = $row['ID'];
	recreatePost($id);
	
?>

	<form method="post">
		Title: <input type='text' name='title' id='title'><br>	
		<input type='text' name='content' id='content' style="text-align: left;padding:  0.4em;padding-bottom:190px;width: 400px;height: 10px;"><br>
		<input type='submit' name='sendmail' value='Send mail!'>
		<input type='hidden' name='id' value='<?php echo $id ?>'>
	</form>
		
<?php

}

function displayInsertPostForm(){
?>

	<fieldset><legend>Add a Post</legend>
		<form method="post" onsubmit="return validate();"> 
			Title<input type='text' name='title' id='title'><span id="titleerror"></span><br>
			Type: 
			<select name="post_type" id='post_type'>
				<option value="Selling">Selling</option>
				<option value="Buying">Buying</option>
				<option value="Trading">Trading</option>
				<option value="Event">Event</option>
				<option value="Other">Other</option>
			</select><span id="posttypeerror"></span><br>
			Content: <span id="contentterror"></span><br>
			<input type='text' name='content' id='content' style="text-align: left;padding:  0.4em;padding-bottom:190px;width: 400px;height: 10px;"><br>
			<input type='submit' name ='submit' value='Add'>
		</form>
	</fieldset>
	
<?php
}

function insertPost(){

	$created_by = mysql_real_escape_string($_COOKIE['login']);
	$title = mysql_real_escape_string($_POST['title']);
	$content = mysql_real_escape_string($_POST['content']);
	$post_type = mysql_real_escape_string($_POST['post_type']);
	
	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
    $query = "INSERT INTO posts (title, created_by, content, date, post_type)
			  VALUES ('$title', '$created_by', '$content', CURDATE(), '$post_type')"; 
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));	


}

function recreatePost($id){

	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
    $query = "SELECT * FROM posts WHERE ID='$id'";
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$dbid = $row['ID'];
	$title = $row['title'];
	$created_by = $row['created_by'];
	$content = $row['content'];
	$date = $row['date'];
	$post_type = $row['post_type'];
	
	showpost($dbid, $title, $created_by, $content, $date, $post_type, False);

}

function findemail($id){

	$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR                           
    	die("message".mysqli_connect_error());
    $query = "SELECT * FROM posts WHERE ID='$id'";
    $result = mysqli_query($dbc,$query) OR  
    	die('Invalid query: $query '. mysqli_error($dbc));	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$created_by = $row['created_by'];
	return $created_by;

}
