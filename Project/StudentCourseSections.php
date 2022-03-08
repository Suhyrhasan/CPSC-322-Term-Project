<html>

<body>
	<?php

	$CourseNum = $_POST["CourseNum"];
	$hostname = "mariadb";
	$username = "cs332a18";
	$password = "project";

	$link = new mysqli($hostname, $username, $password, $username);

	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	echo "Course Number: ", $CourseNum, "<br> <br>";

	$query3 = "SELECT S.Section_num, S.Classroom, S.Meet_days, S.Beg_time, S.End_time, COUNT(St.CWID) AS enrolled FROM RECORDS R, STUDENT St, SECTION S WHERE S.Course_num = '$CourseNum' AND R.Course_sec = S.Section_num AND St.CWID = R.CWID GROUP BY S.Section_num";
	$result = $link->query($query3);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "Section Number: ", $row["Section_num"], "<br>";
			echo "Classrooms: ", $row["Classroom"], "<br>";
			echo "Meeting Days: ", $row["Meet_days"], "<br>";
			echo "Start Time: ", $row["Start_time"], "<br>";
			echo "End Time: ", $row["End_time"], "<br> <br>";
			echo "Number of students enrolled: ", $row["enrolled"], "<br> <br>";
		}
	} else {
		echo "0 results";
	}
	$result->free_result();
	$link->close();
	?>
</body>

</html>