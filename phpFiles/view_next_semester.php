<html>
<head>
	<style>
		ul {
			list-style-type: none;
			margin: 1;
			padding: 0;
		}

		li {
			display: inline;
		}
	</style>
<title>Next Semester</title>
</head>

<body>
<ul>
  	<li><a href="page_professor.php">Back</a></li>
	<br>
	<?php
    echo "<br>Courses Assigned Next Semester<br><br>";
	?>
</ul>

<?php
	if(isset($_POST['update']))
	{
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
  			die('Could not connect: ' . mysql_error());
		}
		
		$name = $_POST['name'];
		$full_semester = $_POST['semester'];
		$year = $_POST['years'];

		switch($full_semester){
			case "Fall": 
				$next_semester = "Spring";
				$year = $year + 1;
				break;
			case "Spring":
				$next_semester = "Summer I";
				break;
			case "Summer I":
				$next_semester = "Summer II";
				break;
			case "Summer II":
				$next_semester = "Fall";
				 break;
			default:
				die("Invalid Semester");	 			
		}
		
		mysql_select_db('projectdb');
		
		$sql1 = "Select code, info.classTime, info.days, info.room_num " .
				"From courseSectionLink, info " . 
				"Where instr_name = '$name' AND courseSectionLink.id = info.id AND courseSectionLink.year = '$year' AND courseSectionLink.semester = '$next_semester'; ";
		$retval1 = mysql_query( $sql1, $conn );
		
		if(! $retval1)
		{
  			die('Could not update data: ' . mysql_error());
		}
		
		if (mysql_num_rows($retval1) > 0) {
    		// output data of each row
			echo "<table id = 't01' style = 'width:50%'> <caption>Next Semester Courses</ caption><br><br>";
    		
    		echo "<tr>
						<td>Code </td>
						<td>Time </td>
						<td>Room </td>
						<td>Semester </td>
					</tr>" ;
    		
    		while($row = mysql_fetch_array($retval1)){        		
        		echo "<tr>
						<td> - " . $row['code'] . "</td>
						<td> - ". $row['classTime'] . "</td>
						<td> - " . $row['room_num'] . "</td>
						<td> - " . $next_semester . " " . $year . "</td>
					</tr>" ;
			}
    echo "</table>";
		} else {
    		echo "Invalid Professor / Semester";
		}
		mysql_close($conn);
	}
	else
	{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="175">Professor Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="175">Current Semester (e.g. Fall, Summer I)</td>
			<td><input name="semester" type="text" id="semester"></td>
		</tr>
		<tr>
			<td width="175">Current Year (e.g. 14, 15)</td>
			<td><input name="years" type="text" id="years"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="update" type="submit" id="update" value="Search"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>