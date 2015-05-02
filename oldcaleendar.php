function eventsform($month, $day, $year){

?>
	<TABLE bgcolor="#0099cc" BORDER=10 CELLSPACING=10 CELLPADDING=10> 
<TR>
<TD COLSPAN="7" ALIGN=center><B>BMW Land's Monthly Event Calendar</B></TD> 
</TR>
<TR> 
<TD COLSPAN="7" ALIGN=center><I>
	<?php date_default_timezone_set('UTC'); 
		$month = date("F");
		$year = date("Y");
		echo "$month $year";?></I></TD>
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

<input type="submit" name="lastmonth" value="lastmonth">Last Month</button>

<?php
}

function lastmonth(){
	mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
}


if (isset($_POST['lastmonth'])) { 
   echo "lastmonth has been pressed"; 
   lastmonth();
}  

?>