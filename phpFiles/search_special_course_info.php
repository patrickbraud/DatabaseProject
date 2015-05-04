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
<title>Special Course Info</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Special Course Info for the Last \"n\" Years<br><br>";
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
		
		$code = $_POST['code'];
		$n = $_POST['years'];
		
		$today = getdate();
		$year = $today["year"] - 2000 - $n;
		if($year < 0){
			$year = $year + 100;
		}
		
		mysql_select_db('projectdb');
		
		$sql1 = "Select title, instr_name, semester, year, enrollment  " .
				"From courseSectionLink " . 
				"Where code = '$code' AND year >= '$year'";
		$retval1 = mysql_query( $sql1, $conn );
		
		if(! $retval1)
		{
  			die('Could not update data: ' . mysql_error());
		}
		
		if (mysql_num_rows($retval1) > 0) {
    		// output data of each row
			echo "<table id = 't01' style = 'width:50%'> <caption>" . $code . " Sections</ caption><br><br>";
    		while($row = mysql_fetch_array($retval1)){        		
        		echo "<tr>
						<td> Title - " . $row['title'] . "</td>
						<td> Instructor - ". $row['instr_name'] . "</td>
						<td> Offer Date - " . $row['semester'] . " " . $row['year'] . "</td>
						<td> Enrollment - " . $row['enrollment'] . "</td>
					</tr>" ;
			}
    echo "</table>";
		} else {
    		echo "Invalid Course";
		}
		mysql_close($conn);
	}
	else
	{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="100">n Years</td>
			<td><input name="years" type="text" id="years"></td>
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