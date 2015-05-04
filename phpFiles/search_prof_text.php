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
<title>Prof. Text Books</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Professor Textbook Information<br><br>";
	?>
	<?php
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

$prof = $_POST['prof'];
$code = $_POST['code'];

$sql1 = "SELECT instr_name, code, book_title, book_author, book_edition, book_isbn, book_publisher, semester, year " .
"FROM courseSectionLink " .
"WHERE instr_name = '$prof' AND code = '$code';" ;
$retval = mysql_query( $sql1, $conn );

if(! $retval)
{
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval) > 0) {
    echo "<br>Searching for textbooks used by '$prof'.<br><br>";
    // output data of each row
    echo "<table id = 't01' style = 'width:100%'> <caption>Textbooks</ caption><br><br>";
    
    echo "<tr>
                <td>Semester: </td>
                <td>Title: </td>
                <td>Author: </td>
				<td>Edition: </td>
				<td>ISBN: </td>
                <td>Publisher: </td>
            </tr>" ;
    
    while($row = mysql_fetch_array($retval)) {
        echo "<tr>
                <td> - " . $row["semester"] . " " . $row['year'] . "</td>
                <td> - " . $row["book_title"]. "</td>
                <td> - " . $row["book_author"]. "</td>
				<td> - " . $row["book_edition"]. "</td>
				<td> - " . $row["book_isbn"]. "</td>
                <td> - " . $row["book_publisher"]. "</td>
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
	<table width="700" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Professor Name</td>
			<td><input name="prof" type="text" id="prof"></td>
		</tr>
			<td width="100">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
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