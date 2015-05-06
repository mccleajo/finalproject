<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Posts</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">

     <style>
	 select, option {font-size: 150%;}
	 </style>
     <script type = "text/javascript" src = "javascript.js"> </script>
<body>

<div class="container">
<header>
    <div class="nav">
      <ul>
        <li><a href="homepage.php">Home</a></li>
        <li><a href="locations.php">Locations</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a class="active" href="posts.php">Posts</a></li>
        <li><a href="findprices.php">Prices</a></li>
        <li><a href="logout.php">Log Out</a></li>
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
	displayposts($_POST['Searchbar']);

}

else if ( isset ( $_POST['email'] ) ) {
	$id = $_POST['id'];
	$email = $_COOKIE['login'];
	displaymailform($id, $email);

}

else if ( isset ( $_POST['submit'] ) ) {
	insertPost();
	?> <h2> Post successfully added </h2> <?php
	displayposts('');
}
else if ( isset ( $_POST['Searchbar'])){
	displayposts($_POST['Searchbar']);

}
else{
?>
	
<?php

	displayposts('');
}
?>



</body>
</html>

<?php

function displayposts($Searchbar){

?>
	<h2>Here are posts from BMWLand users!</h2>

	<form method="post">
  		<input type = "text" name ="Searchbar" id = "Searchbar" value = "<?php if(isset($_POST['Searchbar'])) {echo $_POST['Searchbar'];}?>"/>
  		<input class="mybutton" name="Search" id="Search" value= "Search" type="submit"/>
  	</form>

	<form method='post'>
		<input class ='mybutton' type='submit' name = 'addpost' value='Add a Post'>
	</form>
	
<?php

	

	$query="SELECT * FROM posts WHERE
		ID LIKE '%$Searchbar%' OR
		title LIKE '%$Searchbar%' OR
		created_by LIKE '%$Searchbar%' OR
		content LIKE '%$Searchbar%' OR
		date LIKE '%$Searchbar%' OR
		post_type LIKE '%$Searchbar%'";

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

	<br><form method='post'>
		<table>
			<tr>
				<td bgcolor='#E0E0E0' style="width:'500'"> 
					 <?php echo "<b>$title</b><br>"; ?><br>
					 <?php echo "<b>Posted by:</b> $created_by <br><b>Action:</b> $post_type"; ?><br>
					 <?php echo "<b>Content:</b> $content"; ?> <br> 	
					 <input type='hidden' name='id' value="<?php echo $id; ?>" />				 
				</td>
			</tr>
		</table>
		
<?php 

		if ( True == $button ) {	
		?>	
		<input class ='mybutton' type='submit' value='Contact' name="email" />	
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
		<input class ='mybutton' type='submit' name='sendmail' value='Send mail!'>
		<input type='hidden' name='id' value='<?php echo $id ?>'>
	</form>
		
<?php

}

function displayInsertPostForm(){
?>

	<h2>Add a Post</h2>
		<form method="post" onsubmit="return validatepost();"> 
		<table>
    		<tr>
				<td><label for="title">Title:</label></td>
				<td><input type='text' name='title' id='title'></td>
				<td><span id="titleerror"></span><br></td>
			</tr>
			<tr>
				<td><label for="post_type">Type:</label></td>
				<td><select name="post_type" id='post_type'>
					<option value="Selling">Selling</option>
					<option value="Buying">Buying</option>
					<option value="Trading">Trading</option>
					<option value="Event">Event</option>
					<option value="Other">Other</option>
				</select></td>
				<td><span id="posttypeerror"></span><br></td>
			</tr>
		</table>
			<br>Content: <span id="contenterror"></span><br>
			<input type='text' name='content' id='content' style="text-align: left;padding:  0.4em;padding-bottom:190px;width: 400px;height: 10px;"><br>
			<input class ='mybutton' type='submit' name ='submit' value='Post'>
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