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
<title>Load Distribution</title>
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
		
		$exploded = explode(" ", $full_semester);
		$arr_size = count($exploded);
		
		$semester = $exploded[0];
		if($arr_size == 2){
			$year = (int)$exploded[1];
		}
		else{
			$year = (int)$exploded[2];
			$summer_term = $exploded[1];
		}
		
		switch($semester){
			case "Fall": 
				$next_semester = "Spring";
				break;
			case "Spring":
				$next_semester = "Summer I";
				break;
			case "Summer":
				if($summer_term == "I"){
					$next_semester = "Summer II";
				}
				else if($summer_term == "II"){
					$next_semester = "Fall";
				 }
				 break;
			default:
				die("Invalid Semester");	 			
		}
		
		$year = (int)$year + 1;
		$next_full_semester = "$next_semester $year";
		
		echo $next_full_semester . "<br><br>";		
		
		$sql1 = "SELECT code " . 
				"FROM has " . 
				"WHERE has.crn = (SELECT assign.crn " . 
								 "FROM info, assign " . 
								 "WHERE info.id = assign.info_id " . 
								 	   "AND info.semester = '$next_full_semester')";
		
		$sql2 = "SELECT name " .
				"FROM professor " . 
				"WHERE name = '$name'";
				
		mysql_select_db('projectdb');
		$retval1 = mysql_query( $sql1, $conn );
		$result = mysql_query( $sql2, $conn);
		if(! $retval1)
		{
  			die('Could not update data: ' . mysql_error());
		}
		
		
		if (mysql_num_rows($result) > 0 && $retval1 != 0) {
    		// output data of each row
    		while($row = mysql_fetch_array($retval1)){
        		echo $row['code'] . "<br>";
			}
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
			<td width="120">Professor Name:</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="120">Current Semester (e.g. Fall 15, Summer I 16):</td>
			<td><input name="semester" type="text" id="semester"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="update" type="submit" id="update" value="Add"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>