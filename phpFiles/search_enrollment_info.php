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

$n = $_POST['years'];
$today = getdate();
$year = $today["year"] - 2000 - $n;
if($year < 0){
	$year = $year + 100;
}

$counter = 0;
$level_enroll = [];
while($counter < 5){
	$level_enroll[$counter] = 0;
	$counter++;
}
$counter = 0;

$sql1 = "SELECT code, sum(enrollment) AS total, semester " .
		"From courseSectionLink " .
		"Where year >= '$year' AND (semester = 'Spring' OR semester = 'Fall')" .
		"Group By code;" ;
$retval1 = mysql_query( $sql1, $conn );

if(! $retval1)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval1) > 0) {
    // output data of each row
    echo "<table id = 't01' style = 'width:20%'> <caption>Enrollment by Course</ caption><br><br>";
    $reg_sem[] = [mysql_num_rows($retval1)];
    
    echo "<tr>
			<td>Course: </td>
			<td>Total Enrollment: </td>
		</tr>" ;
    
    while($row = mysql_fetch_array($retval1)) {
		// keep a copy of all these courses for level calculation
		$reg_sem[$counter] = $row;
		$counter = $counter + 1;
		// output individual course enrollment in a table
		echo "<tr>
			<td> - " . $row["code"]. "</td>
			<td> - " . $row["total"]. "</td>
		</tr>" ;
    }
    echo "</table>";
	// Add the totals of level enrollment in a new array
	for($j = 0; $j < $counter; $j ++){
		$level = (($reg_sem[$j]["code"][2])-1);
		$level_enroll[$level] += $reg_sem[$j]["total"];	
	}
	// output the level course enrollment in a table
	echo "<table id = 't01' style = 'width:20%'><br><caption>Enrollment by Course Level</ caption><br><br>";
	
	echo "<tr>
                <td>Course Level: </td>
                <td>Total Enrollment:</td>
            </tr>" ;
	
	for($k = 0; $k < 5; $k ++){
		$level = ($k + 1) * 1000;
		echo "<tr>
                <td> - " . $level . "</td>
                <td> - " . $level_enroll[$k]. "</td>
            </tr>" ;
	}
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
			<td><input name="update" type="submit" id="update" value="Submit"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>