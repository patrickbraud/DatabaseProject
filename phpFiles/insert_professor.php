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

$name = $_POST['name'];
$dateHired = $_POST['dateHired'];
$instrType = $_POST['instrType'];
$tenure = $_POST['tenure'];
$title = $_POST['title'];

$sql1 = "INSERT INTO instructor(name, dateHired) ".
       "VALUES ('$name', '$dateHired')";
	   
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
			<td width="100">Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">Date Hired</td>
			<td><input name="dateHired" type="text" id="dateHired"></td>
		</tr>
		<tr>
			<td >Position</td>
			<td><select name="instrType">
				  <option value="">Select...</option>
				  <option value="P">Professor</option>
				  <option value="G">GPTI</option>
				  <option value="F">FTI</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100">Tenure Status</td>
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