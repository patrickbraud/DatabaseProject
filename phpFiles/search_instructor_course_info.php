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
<title>Instructor Course Info</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Search Instructor Course Information<br><br>";
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
$n = $_POST['years'];
$today = getdate();
$year = $today["year"] - 2000 - $n;
if($year < 0){
	$year = $year + 100;
}

mysql_select_db('projectdb');

$sql1 = "SELECT code, title, courseSectionLink.semester, courseSectionLink.year, enrollment, info.room_num " .
		"FROM courseSectionLink, info " . 
		"WHERE courseSectionLink.year >= '$year' AND instr_name = '$name' AND courseSectionLink.id = info.id " .
		"Order By year DESC; ";
$retval = mysql_query( $sql1, $conn );

$sql2 = "Select courseSectionLink.code as cc, count(courseSectionLink.code) As times, avg(ta_hours) As avg_ta, avg(enrollment) As avg_enroll, isReq " . 
		"From courseSectionLink, assign, course " .
		"Where courseSectionLink.instr_name = '$name' AND courseSectionLink.year >= '$year' AND assign.crn = courseSectionLink.crn AND course.code = courseSectionLink.code " . 
		"Group By courseSectionLink.code " .
		"Order By courseSectionLink.code ASC; ";

$retval2 = mysql_query( $sql2, $conn );
$retval3 = mysql_query( $sql2, $conn );
if(! $retval)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval) > 0) {
    echo "<br>Searching for courses taught by '$name'.<br><br>";
    // output data of each row
    echo "<table id = 't01' style = 'width:50%'> <caption>Courses</ caption><br><br>";
    
    while($row = mysql_fetch_array($retval)) {
        echo "<tr>
                <td> - Code: " . $row["code"]. "</td>            
				<td> - Title: " . $row["title"]. "</td>
                <td> - Semester: " . $row["semester"]. " " . $row["year"]. "</td>
                <td> - Enrollment: " . $row["enrollment"]. "</td>
                <td> - Building: " . $row["room_num"]. "</td>
			</tr>" ;
    }
    echo "</table>";
} else {
    echo "<font color = 'red' >0 results\n";
}

if(! $retval2)
{
  die('Could not update data: ' . mysql_error());
}
echo "<br> Undergraduate Courses <br><br>";
if(mysql_num_rows($retval2) > 0) {
    // output data of each row
    echo "<table id = 't01' style = 'width:50%'><caption></ caption>";
    while($row = mysql_fetch_array($retval2)) {
		if($row["avg_ta"] == 0){
			$ratio = "N/A";
		}
		else{
			$ratio = $row["avg_ta"]/$row["avg_enroll"];
		}
		if($row["cc"][2] < 5){
        echo "<tr>
				<td> - Course: " . $row["cc"]. "</td>
				<td> - Times Offered: " . $row["times"]. "</td>
				<td> - TA Hours: " . $row["avg_ta"] . "</td>
				<td> - Enrollment: " . $row["avg_enroll"]. "</td>
				<td> - Ta Hours/Students Enrolled: " . $ratio . "</td>
				<td> - Required: " . $row["isReq"] . "</td>
            </tr>" ;
		}
    }
    echo "</table>";
} else {
    echo "<font color = 'red' >0 results\n";
}
if(! $retval3)
{
  die('Could not update data: ' . mysql_error());
}
echo "<br> Graduate Courses <br><br>";
if(mysql_num_rows($retval3) > 0) {
    // output data of each row
    echo "<table id = 't01' style = 'width:50%'><caption></ caption>";
    while($row = mysql_fetch_array($retval3)) {
		if($row["avg_ta"] == 0){
			$ratio = "N/A";
		}
		else{
			$ratio = $row["avg_ta"]/$row["avg_enroll"];
		}
		if($row["cc"][2] == 5){
        echo "<tr>
				<td> - Course: " . $row["cc"]. "</td>
				<td> - Times Offered: " . $row["times"]. "</td>
				<td> - TA Hours: " . $row["avg_ta"] . "</td>
				<td> - Enrollment: " . $row["avg_enroll"]. "</td>
				<td> - Ta Hours/Students Enrolled: " . $ratio . "</td>
				<td> - Required: " . $row["isReq"] . "</td>
            </tr>" ;
		}
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
			<td width="100">Prof. Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">n Years</td>
			<td><input name="years" type="text" id="years"></td>
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