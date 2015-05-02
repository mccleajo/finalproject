<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Welcome to BMWLand</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">
     <style>
     	#map-canvas {
        width: 500px;
        height: 400px;
        }

        body { background: url(755102-bmw-wallpaper.jpg) no-repeat center center fixed; background-size: center; background-repeat: no-repeat; font-family: helvetica;}

     </style>
</head>
<body>

<script src="https://maps.googleapis.com/maps/api/js"></script>

<?php

include 'bmwpics.php';


// $results = finddealerships("310 Corlies Avenue, Pelham, NY 10803");	
// $dealerships = $results[0];
// foreach ( $dealerships as $dealership ) {
// 	echo $dealership;
	?><!--  <br>  --><?php
// }


if ( !isset ( $_COOKIE['login'] ) ) {
	?> <h3> User not logged in! </h3> 
	<a href="login.php">
		<input class ='mybutton' type="button" value="Return to Login" />
	</a> <?php
	die();
}


if ( isset ( $_POST['locations'] ) ) {
		locationform();
	}
	if ( isset ($_POST['submitloc'] ) ) {
		?> <div id="map-canvas"></div><?php
		include 'map.php';
		locationform();
	}


if ( isset ( $_POST['history'] ) ) {
		bmwpics();
	}


	if ( isset ( $_POST['events'] ) ) {
		eventsform();
	}
	

displayform();

?>

</body>
</html>

<?php

function displayform(){

?>


	
		<form method="post">
			<input class = 'mybutton' type='submit' name='locations' value='Find BMW Locations'><br>
			<input class = 'mybutton' type='submit' name='history' value='BMW Models'><br>
			<input class = 'mybutton' type='submit' name='posts' value='Posts'><br>
			<input class = 'mybutton' type='submit' name='events' value='Events'><br>
			
		</form>
		<form method="post" action="dboperation.php">
			<input class = 'mybutton' type='submit' name='op' value='Log Out'><br>
		</form>

		
<?php

}

function locationform(){

?>


	<legend>Search BMW Locations</legend><br>
		<form method="post">
			<input type='text' name='address' id='address'><br>
			<input class = 'mybutton' type='submit' name='submitloc'><br><br><br><br><br>
		</form>


<?php

}

function eventsform(){

?>
	<TABLE bgcolor="#0099cc" BORDER=10 CELLSPACING=10 CELLPADDING=10> 
<TR>
<TD COLSPAN="7" ALIGN=center><B>BMW Land's Monthly Event Calendar</B></TD> 
</TR>
<TR> 
<TD COLSPAN="7" ALIGN=center><I>May 2015</I></TD>
</TR>
<TR> 
<TD ALIGN=center>Sun</TD>
<TD ALIGN=center>Mon</TD>
<TD ALIGN=center>Tue</TD>
<TD ALIGN=center>Wed</TD>
<TD ALIGN=center>Thu</TD>
<TD ALIGN=center>Fri</TD>
<TD ALIGN=center>Sat</TD>
</TR>
<TR> 
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/instructor-training-school-watkins-glen"><b>1</b></A></TD>
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/instructor-training-school-watkins-glen"><b>2</b></A></TD>
</TR>
<TR> 
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/instructor-training-school-watkins-glen"><b>3</b></A></TD>
<TD ALIGN=center>4</TD>
<TD ALIGN=center>5</TD>
<TD ALIGN=center>6</TD>
<TD ALIGN=center>7</TD>
<TD ALIGN=center>8</TD>
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/49586"><b>9</b></A></TD>  
</TR>
<TR> 
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/pitt-race-performance-driver-education"><b>10</b></A></TD>   
<TD ALIGN=center>11</TD> 
<TD ALIGN=center>12</TD>
<TD ALIGN=center>13</TD>
<TD ALIGN=center>14</TD>
<TD ALIGN=center>15</TD>
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/43211"><b>16</b></A></TD>    
</TR>
<TR> 
<TD ALIGN=center>17</TD>
<TD ALIGN=center>18</TD>
<TD ALIGN=center>19</TD>
<TD ALIGN=center>20</TD>
<TD ALIGN=center>21</TD>
<TD ALIGN=center>22</TD>
<TD ALIGN=center>23</TD>
</TR>
<TR> 
<TD ALIGN=center>24</TD>
<TD ALIGN=center>25</TD>
<TD ALIGN=center>26</TD>
<TD ALIGN=center>27</TD>
<TD ALIGN=center><A HREF="https://www.bmwcca.org/event/50411"><b>28</b></A></TD>   
<TD ALIGN=center>29</TD>
<TD ALIGN=center>30</TD>
</TR>
<TR> 
<TD ALIGN=center>31</TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>
<TD ALIGN=center></TD>



</TR>
</TABLE><br><br>

<?php
}

?>



