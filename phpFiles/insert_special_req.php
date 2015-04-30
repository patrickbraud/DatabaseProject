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
    echo "<br>Insert Special Requests<br><br>";
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
		$code = $_POST['code'];
		$title = $_POST['title'];
		$justif = $_POST['justification'];
		
		$sql1 = "UPDATE professor " .
				"SET request_code = '$code', request_title = '$title' " .
				", request_justif = '$justif' " . 
				"WHERE name = '$name'";
				
		$sql2 = "SELECT name " . 
				"FROM professor " . 
				"WHERE name = '$name'";
		
		mysql_select_db('projectdb');
		$retval1 = mysql_query( $sql1, $conn );
		$result = mysql_query( $sql2, $conn );
		if(! $retval1)
		{
  			die('Could not update data: ' . mysql_error());
		}

		if (mysql_num_rows($result) > 0 && $retval1 != 0) {
    		// output data of each row
    		while($row = mysql_fetch_array($result)){
        		echo "Special request has been set for $name<br>";
			}
		} else {
    		echo "No professor named $name";
		}
		
		mysql_close($conn);
	}
	else
	{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Prof Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="100">Course Title</td>
			<td><input name="title" type="text" id="title"></td>
		</tr>
		<tr>
			<td width="100">Justification</td>
			<td><input name="justification" type="text" id="justification"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td> </td>
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