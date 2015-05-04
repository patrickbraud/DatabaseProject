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

$sql1 = "SELECT code, title, courseSectionLink.semester, courseSectionLink.year, enrollment, info.room_num " .
		"FROM courseSectionLink, info " . 
		"WHERE courseSectionLink.year >= '$year' AND instr_name = '$name' AND courseSectionLink.id = info.id; ";
	   

mysql_select_db('projectdb');
$retval = mysql_query( $sql1, $conn );
if(! $retval)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval) > 0) {
    
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
    echo "<font color = 'red' >0 results for '$str'<br>";
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