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
    echo "<br>Insert Teaching Load Distribution<br><br>";
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
		$distr = $_POST['load_distr'];
		
		$sql1 = "UPDATE professor " .
				"SET load_distr = '$distr' " . 
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
        		echo "Load distribution has been set for $name<br>";
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
			<td width="100">Prof. Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="250">Load Distr. (e.g. Fall, Spring, NA)</td>
			<td><input name="load_distr" type="text" id="load_distr"></td>
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