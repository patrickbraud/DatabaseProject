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
    echo "<br>Add a New Section<br><br>";
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

$semester = $_POST['semester'];
$section_num = $_POST['section_num'];
$crn = rand(10000, 99999);
$code = $_POST['code'];

$instr_name = $_POST['instr_name'];

$class_time = $_POST['class_time'];
$days = $_POST['days'];
$room_num = $_POST['room_num'];
$info_id = 1;

$cap = $_POST['cap'];
$enroll = $_POST['enroll'];

mysql_select_db('projectdb');

$sql1 = "Insert into section ".
		"Values('$crn', '$enroll', '$cap', '$section_num'); ";
$result1 = mysql_query( $sql1, $conn );

$sql2 = "Insert into has ". 
		"Values('$crn', '$code'); " ;
$result2 = mysql_query( $sql2, $conn );

$sql3 = "Select max(id)" . 
		"From info;" ;
$result3 = mysql_query( $sql3, $conn );
if($result3){
	$row = mysql_fetch_row($result3);
	$info_id = $row[0] +1;
}

$sql4 = "Insert into info ". 
		"Values('$info_id', '$room_num', '$class_time', '$days', '$semester'); ";
$result4 = mysql_query( $sql4, $conn );

$sql5 = "Insert into assign ". 
		"Values('$crn', '$instr_name', null, null, null, null,'$info_id'); ";
$result5 = mysql_query( $sql5, $conn );

if(! $result1 )
{
  die('Could not update data: ' . mysql_error());
}
else {
    echo "A new section of " . $code . " has been added with CRN " . $crn ."<br>";
}
mysql_close($conn);
}
else
{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Semester</td>
			<td><input name="semester" type="text" id="semester"></td>
		</tr>
		<tr>
			<td width="100">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="150">Section Number</td>
			<td><input name="section_num" type="text" id="section_num"></td>
		</tr>
		<tr>
			<td width="100">Instructor Name</td>
			<td><input name="instr_name" type="text" id="instr_name"></td>
		</tr>
		<tr>
			<td width="100">Class Time</td>
			<td><input name="class_time" type="text" id="class_time"></td>
		</tr>
		<tr>
			<td width="100">Days</td>
			<td><input name="days" type="text" id="days"></td>
		</tr>
		<tr>
			<td width="100">Room Number</td>
			<td><input name="room_num" type="text" id="room_num"></td>
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