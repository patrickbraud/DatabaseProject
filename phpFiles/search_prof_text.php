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
<title>Prof. Textbooks</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Professor Textbook Info<br><br>";
	?>
</ul>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Prof. Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="update" type="submit" id="update" value="Add"></td>
		</tr>
	</table>
</form>