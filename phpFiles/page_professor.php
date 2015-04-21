<!DOCTYPE html>
<html>
	<head>
		<style>
			ul {
    			list-style-type: none;
    			margin: 0;
    			padding: 0;
			}

			li {
    			display: inline;
			}
		</style>
	</head>
	
<body>
	<ul>
  		<li><a href="page_faculty_staff.php">Faculty/Staff</a></li>
  		<li><a href="page_professor.php">Professor</a></li>
  		<li><a href="page_business_manager.php">Business Manager</a></li>
	</ul>
</body>

<?php
    echo "<br><u>Insert Preferences</u><br><br>";
	?>
<form name='Input Professor Preferences' action='insert_professor_preference.php' method='post'>
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
    echo "<br><u>Update Teaching Load Distribution</u><br><br>";
	?>
<form name='Update Teaching Load Distribution' action='update_distribution.php' method='post'>
Teaching Load Distribution (Fall, Spring, NA): <input type="text" name="teachingDistribution" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
    echo "<br><u>Input Special Requests</u><br><br>";
	?>
<form name='Input Special Teaching Requests' action='input_teaching_requests.php' method='post'>
Course Code: <input type="text" name="courseCode" value="">
<br><br>
Title: <input type="text" name="title" value="">
<br><br>
Justification: <input type="text" name="justification" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
    echo "<br><u>Input Text Book Info</u><br><br>";
	?>
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
<?php
    echo "<br><u>Courses Assigned To Professor Next Semester</u><br><br>";
	?>
<form name='Input Text' action='input_text.php' method='post'>
Professor: <input type="text" name="professor" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
</html>