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
    echo "<br>Assign TA<br><br>";
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
$hours = $_POST['hours'];
$crn = $_POST['crn'];

$sql = "UPDATE assign ".
       "SET ta_name = '$name', ta_hours = '$hours' ".
	   "WHERE assign.crn = '$crn'; ";
$sql2 = "Select has.code, section.section_num\n".
		"From has, section\n".
		"Where section.crn = '$crn' and has.crn = '$crn'; ";

mysql_select_db('projectdb');
$retval = mysql_query( $sql, $conn );
$result = mysql_query( $sql2, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
if (mysql_num_rows($result) > 0) {
    // output data of each row
    while($row = mysql_fetch_array($result)){
        echo "TA has been added to " . $row['code'] . " Section " . $row['section_num'] . "<br>";
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
			<td width="100">Section CRN</td>
			<td><input name="crn" type="text" id="crn"></td>
		</tr>
		<tr>
			<td width="100">Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">Hours</td>
			<td><input name="hours" type="text" id="hours"></td>
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