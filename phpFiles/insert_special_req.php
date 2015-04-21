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
<title>Load Distribution</title>
</head>

<body>
<ul>
  	<li><a href="page_professor.php">Back</a></li>
	<br>
	<?php
    echo "<br>Insert Special Requests<br><br>";
	?>
</ul>



<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Course Code:</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="100">Title:</td>
			<td><input name="title" type="text" id="title"></td>
		</tr>
		<tr>
			<td width="100">Justification:</td>
			<td><input name="justification" type="text" id="justification"></td>
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
</body>
</html>