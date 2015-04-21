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
    echo "<br>Courses Assigned Next Semester<br><br>";
	?>
</ul>

<form name='Input Text' action='input_text.php' method='post'>
Professor: <input type="text" name="professor" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
</html>