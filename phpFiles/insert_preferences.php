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
    echo "<br>New Instructor Information<br><br>";
	?>
</ul>

<form name='Input Professor Preferences' action='insert_professor_preference.php' method='post'>
<br><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
