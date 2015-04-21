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
    echo "<br>Insert Teaching Load Distribution<br><br>";
	?>
</ul>

<form name='Update Teaching Load Distribution' action='update_distribution.php' method='post'>
Load Distribution (Fall, Spring, NA): <input type="text" name="teachingDistribution" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>