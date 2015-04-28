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
    echo "<br>Insert Text Book Info<br><br>";
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
		
		mysql_select_db('projectdb');
		$retval1 = mysql_query( $sql1, $conn );
		if(! $retval1)
		{
  			die('Could not update data: ' . mysql_error());
		}

		echo "Updated data successfully\n";
		mysql_close($conn);
	}
	else
	{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Professor Name:</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">Text Title:</td>
			<td><input name="title" type="text" id="title"></td>
		</tr>
		<tr>
			<td width="100">Author:</td>
			<td><input name="author" type="text" id="author"></td>
		</tr>
		<tr>
			<td width="100">Edition:</td>
			<td><input name="edition" type="text" id="edition"></td>
		</tr>
		<tr>
			<td width="100">ISBN#:</td>
			<td><input name="isbn" type="text" id="isbn"></td>
		</tr>
		<tr>
			<td width="100">Publisher:</td>
			<td><input name="publisher" type="text" id="publisher"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<input type="submit" name="submit" value="Submit">
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>