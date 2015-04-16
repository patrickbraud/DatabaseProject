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
		echo "<br>Insert New Professor / FTI / GPTI";
	?>
<form name='Input New Professor' action='insert_professor.php' method='post'>

New Prof Name: <input type="text" name="newProfId" value="">
<br><br>
Hire Date: <input type="text" name="hireDate" value="">
<br><br>
Tenured (yes/no): <input type="text" name="tenured" value="">
<br><br>
Title: <input type="text" name="title" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php
    echo "<br>Input Course and Section Information<br>";
	?>
<form name='Input New Course Info' action='insert_course.php' method='post'>
Instructor: <input type="text" name="instructor" value="">
<br><br>
Course Code: <input type="text" name="courseCode" value="">
<br><br>
Section Number: <input type="text" name="sectionNumber" value="">
<br><br>
Time: <input type="text" name="time" value="">
<br><br>
Days: <input type="text" name="days" value="">
<br><br>
Room: <input type="text" name="room" value="">
<br><br>
Building: <input type="text" name="building" value="">
<br><br>
Capacity: <input type="text" name="capacity" value="">
<br><br>
Enrollment: <input type="text" name="enrollment" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
    echo "<br>Input TA Information<br>";
	?>
<form name='Input TA Info' action='insert_ta_info.php' method='post'>
Section CRN: <input type="text" name="sectionCRN" value="">
<br><br>
Name: <input type="text" name="taName" value="">
<br><br>
Hours: <input type="text" name="taHours" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
    echo "<br>Input Catalog Info<br>";
	?>
<form name='Input Catalog Year' action='insert_catalog_year.php' method='post'>
Catalog Year: <input type="text" name="catalogYear" value="">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
</html>