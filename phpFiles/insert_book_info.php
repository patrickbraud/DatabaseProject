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
    echo "<br>Insert Text Book Info<br><br>";
	?>
</ul>

<form name='Input Text' action='input_text.php' method='post'>
	Professor: <input type="text" name="professor" value="">
	<br><br>
	Text Title: <input type="text" name="textTitle" value="">
	<br><br>
	Author: <input type="text" name="author" value="">
	<br><br>
	Edition: <input type="text" name="edition" value="">
	<br><br>
	ISBN: <input type="text" name="isbn" value="">
	<br><br>
	Publisher: <input type="text" name="publisher" value="">
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>