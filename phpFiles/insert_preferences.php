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
  	<li><a href="page_professor.php">Back</a></li>
	<br>
	<?php
    echo "<br>Instructor Preferences<br><br>";
	?>
</ul>

<?php
if(isset($_POST['update']))
{

$_SESSION["name"] = "Lim";

}
else
{
?>

<form method="post" action="prefs.php">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="300">Select a Professor to Update</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td> </td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="update" type="submit" id="update" value="Submit"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>