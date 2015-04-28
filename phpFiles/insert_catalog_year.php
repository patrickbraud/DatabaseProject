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
<title>Update a Record in MySQL Database</title>
</head>

<body>
<ul>
  	<li><a href="page_faculty_staff.php">Back</a></li>
	<br>
	<?php
    echo "<br>Search by Catalog Year<br><br>";
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

$year = $_POST['year'];

$sql = "Select code, title ".
		"From course ".
		"Where year = '$year'";

mysql_select_db('projectdb');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
if (mysql_num_rows($retval) > 0) {
    // output data of each row
    while($row = mysql_fetch_array($retval)){
        echo "Course: " . $row['title'] . " " . $row['code'] . "<br>";
	}
} else {
    echo "0 results";
}
mysql_close($conn);
}
else
{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Catalog Year (e.g. 13-14)</td>
			<td><input name="year" type="text" id="year"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td> </td>
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