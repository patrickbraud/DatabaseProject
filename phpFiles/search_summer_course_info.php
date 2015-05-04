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
<title>Summer Course Info</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Summer Course Info for Last \"n\" Years<br><br>";
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

$n = $_POST['years'];
$today = getdate();
$year = $today["year"] - 2000 - $n;
if($year < 0){
	$year = $year + 100;
}

$sql1 = "SELECT code, instr_name, enrollment " .
		"FROM courseSectionLink " .
		"Where year >= '$year' AND (semester = 'Summer I' OR semester = 'Summer II'); ";
$retval = mysql_query( $sql1, $conn );

if(! $retval)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval) > 0) {
    // output data of each row
    echo "<table id = 't01' style = 'width:25%'> <caption>Summer Courses</ caption><br><br>";

    while($row = mysql_fetch_array($retval)) {
		echo "<tr>
				<td> - Course Code: " . $row['code']. "</td>
				<td> - Instructor: " . $row['instr_name']. "</td>
				<td> - Enrollment: " . $row['enrollment']. "</td>
			</tr>" ;
    }
    echo "</table>";
} else {
    echo "<font color = 'red' >0 results\n";
}
mysql_close($conn);
}
else
{
?>


<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="60">n Years</td>
			<td><input name="years" type="text" id="years"></td>
		</tr>
		<tr>
			<td width="60"> </td>
			<td><input name="update" type="submit" id="update" value="Search"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>