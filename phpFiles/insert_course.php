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
    echo "<br>New Section Information<br><br>";
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

$instrName = $_POST['name'];
$code = $_POST['code'];
$time = $_POST['time'];
$days = $_POST['days'];
$roomNum = $_POST['room'];
$building = $_POST['building'];
$capacity = $_POST['cap'];
$enrollment = $_POST['enroll'];
$sectionNum = $_POST['section'];

$sql1 = "Select id ".
       "From info ".
	   "Where classTime = '$time' AND days = '$days' AND room_num = '$roomNum' AND building = '$building' ";
	   
mysql_select_db('projectdb');
$retval2 = mysql_query( $sql1, $conn );
if(! $retval2 )
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
			<td width="100">Instructor Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="100">Time</td>
			<td><input name="time" type="text" id="time"></td>
		</tr>
		<tr>
			<td width="100">Days</td>
			<td><input name="days" type="text" id="days"></td>
		</tr>
		<tr>
			<td width="100">Room Number</td>
			<td><input name="room" type="text" id="room"></td>
		</tr>
		<tr>
			<td width="100">Building</td>
			<td><input name="building" type="text" id="building"></td>
		</tr>
		<tr>
			<td width="100">Capacity</td>
			<td><input name="cap" type="text" id="cap"></td>
		</tr>
		<tr>
			<td width="100">Enrollment</td>
			<td><input name="enroll" type="text" id="enroll"></td>
		</tr>
		<tr>
			<td width="100">Section Number</td>
			<td><input name="section" type="text" id="section"></td>
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