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
<title>Course Info</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Course Info for the Last \"n\" Years<br><br>";
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

$code = $_POST['course'];
$n = $_POST['n'];
$today = getdate();
$year = $today["year"] - 2000 - $n;
if($year < 0){
	$year = $year + 100;
}

$sql1 = "SELECT code, title, section_num, instr_name, enrollment, semester, year ".
		"FROM courseSectionLink " .
		"WHERE code = '$code' AND year >= '$year' " .
		"Group By year DESC;";
$retval1 = mysql_query( $sql1, $conn );

if(! $retval1)
{
  die('Could not access data: ' . mysql_error());
}
if(mysql_num_rows($retval1) > 0) {
    echo "<br>Searching for Course '$code' .<br><br>";
    // output data of each row
    echo "<table id = 't01' style = 'width:50%'> <caption>Course Information </ caption><br><br>";
    
    while($row = mysql_fetch_array($retval1)) {
        echo "<tr>
                <td> - Code: " . $row["code"]. "</td>
				<td> - Title: " . $row["title"]. "</td>
				<td> - Instructor: " . $row["instr_name"]. "</td>         
                <td> - Enrollment: " . $row["enrollment"]. "</td>
				<td> - Semester: " . $row["semester"]. "</td>
                <td> - Year: " . $row["year"]. "</td>
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
			<td width="100">Course</td>
			<td><input name="course" type="text" id="course"></td>
		</tr>
		<tr>
			<td width="100">n Years</td>
			<td><input name="n" type="text" id="n"></td>
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