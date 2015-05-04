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
<title>Lookup Professor Preferences</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Professor Preferences<br><br>";
	?>
</ul>
<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="150">Select a Professor</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td> </td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="add" type="submit" id="add" value="Submit"></td>
		</tr>
	</table>
</form>

<?php
if(isset($_POST['add'])){
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db('projectdb');
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}

	$name = $_POST['name'];
	
	$sql1 = "Select * " .
			"From prof_pref " .
			"Where name = '$name'; ";

	$retval1 = mysql_query( $sql1, $conn );
	if(! $retval1 ){
	  die('Could not update data: ' . mysql_error());
	}
	if(mysql_num_rows($retval1) > 0){
		echo "<table id = 't01' style = 'width:20%'><br><caption>Current Preferences for $name</ caption><br><br>";
		echo "<tr>
				<td align='center'>Course: </td>
				<td align='center'>Preference: </td>
			</tr>" ;
		while($row = mysql_fetch_array($retval1)){
			echo "<tr>
					<td align='center'>" . $row["code"] . "</td>
					<td align='center'>" . $row["pref"]. "</td>
				</tr>" ;
		}
	} else {
		echo "<font color = 'red' >0 results\n";
	}
	mysql_close($conn);
}
?>
</body>
</html>