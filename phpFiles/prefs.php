<?php
session_start();
?>
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
<title>Insert Preferences</title>
</head>

<body>
<ul>
  	<li><a href="insert_preferences.php">Back</a></li>
	<br>
	<?php
	echo $_SESSION["name"];
    echo "<br>Instructor Preferences<br><br>";
	?>
</ul>
<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="300">Select a Course to Update</td>
			<td><input name="course" type="text" id="course"></td>
		</tr>
		<tr>
			<td width="300">New Preference (3 best, 1 worst)</td>
			<td><input name="new_pref" type="text" id="new_pref"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td> </td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="add" type="submit" id="add" value="Submit"></td>
		</tr>
	</table>
</form>

<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('projectdb');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$name = $_SESSION['name'];
$sql1 = "Select * " .
		"From prof_pref " .
		"Where name = '$name'; ";
$retval1 = mysql_query( $sql1, $conn );


if(! $retval1 ){
  die('Could not update data: ' . mysql_error());
}
if(mysql_num_rows($retval1) > 0){
	echo "<table id = 't01' style = 'width:20%'><br><caption>Current Preferences for '$name'</ caption><br><br>";
	while($row = mysql_fetch_array($retval1)){
		echo "<tr>
				<td> - Course: " . $row["code"] . "</td>
                <td> - Current Preference: " . $row["pref"]. "</td>
            </tr>" ;
	}
} else {
    echo "<font color = 'red' >0 results\n";
}
if(isset($_POST['add']))
{

$new_pref = $_POST["new_pref"];
$course = $_POST["course"];
echo $name;
$sql2 = "Update prof_pref " .
		"Set pref = '$new_pref' " . 
		"Where name = 'name' AND code = '$course'; ";
$retval2 = mysql_query( $sql2, $conn );

if(! $retval2 ){
  die('Could not update data: ' . mysql_error());
}

mysql_close($conn);
}
else
{
?>
<?php
}
?>
</body>
</html>