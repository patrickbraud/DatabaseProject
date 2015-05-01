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
<title>Insert Professor</title>
</head>

<body>
<ul>
  	<li><a href="page_faculty_staff.php">Back</a></li>
	<br>
	<?php
    echo "<br>New Instructor Information<br><br>";
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

mysql_select_db('projectdb');

$name = $_POST['name'];
$dateHired = $_POST['dateHired'];
$instrType = $_POST['instrType'];
$tenure = $_POST['tenure'];
$title = $_POST['title'];

$sql1 = "INSERT INTO instructor(name, dateHired) ".
       "VALUES ('$name', '$dateHired')";
$retval1 = mysql_query( $sql1, $conn );
$query2 = "Insert into professor(name, title, tenure) ".
			"Values('$name','$title', '$tenure')";
$sql3 = "Insert into teacher(name, type) ".
			"Values('$name', '$instrType')";
if($instrType == 'Professor'){
	$retvalue2 = mysql_query( $query2, $conn );
}
else if ($instrType == 'GPTI' || $instrType == 'FTI'){
	$retvalue3 = mysql_query( $sql3, $conn );
}

if(! $retval1)
{
  die('Could not update data: ' . mysql_error());
}

echo "'$name' has been added as a new instructor\n";
mysql_close($conn);
}
else
{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="700" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="200">Date Hired (e.g. Fall 11)</td>
			<td><input name="dateHired" type="text" id="dateHired"></td>
		</tr>
		<tr>
			<td width="100">Position (Professor, GPTI, FTI)</td>
			<td><input name="instrType" type="text" id="instrType"></td>
		</tr>
		<tr>
			<td width="100">Tenure Status (yes or no)</td>
			<td><input name="tenure" type="text" id="tenure"></td>
		</tr>
		<tr>
			<td width="100">Title</td>
			<td><input name="title" type="text" id="title"></td>
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