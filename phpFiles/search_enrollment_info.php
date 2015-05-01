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
<title>Search Enrollment</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Enrollment Info for Last \"n\" Years<br><br>";
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

$years = $_POST['years'];

$sql1 = "SELECT code, sum(enrollment) AS total, semester " .
		"From courseSectionLink " .
		"Group By code;" ;
$retval1 = mysql_query( $sql1, $conn );

if(! $retval1)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval1) > 0) {
    // output data of each row
    echo "<table id = 't01' style = 'width:100%'> <caption>Enrollment by Course</ caption><br><br>";
    
    while($row = mysql_fetch_array($retval1)) {
		if($row["semester"][2] != 'u'){
        echo "<tr>
                <td> - Course: " . $row["code"]. "</td>
                <td> - Total Enrollment: " . $row["total"]. "</td>
            </tr>" ;
		}
    }
    echo "</table>";
} else {
    echo "<font color = 'red' >0 results\n";
}
$sql2 = "SELECT code, enrollment " .
		"From courseSectionLink ";
$retval2 = mysql_query( $sql2, $conn );

if(! $retval2)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval2) > 0) {
    // output data of each row
    echo "<table id = 't01' style = 'width:100%'> <caption><br><br>Course Level Enrollment</ caption><br><br>";
    
    while($row = mysql_fetch_array($retval2)) {
		if($row["semester"][2] != 'u'){
        echo "<tr>
                <td> - Course: " . $row["code"]. "</td>
                <td> - Course Level: " . $row["code"][2]*1000 . "</td>
            </tr>" ;
		}
    }
    echo "</table>";
} else {
    echo "<font color = 'red' >0 results\n";
}
}
else{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="60">n Years</td>
			<td><input name="years" type="text" id="years"></td>
		</tr>
		<tr>
			<td width="60"> </td>
			<td><input name="update" type="submit" id="update" value="Add"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>