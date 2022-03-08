<html>

<body>
    <?php

    $SSN = $_POST["SSN"];
    $hostname = "mariadb";
    $username = "cs332a18";
	$password = "project";
   
    $link = new mysqli($hostname, $username, $password, $username);

    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
    echo "Professor's SSN: ", $SSN, "<br> <br>";

    $query1 = "SELECT C.Title, S.Classroom, S.Meet_days, S.Beg_time, S.End_time FROM PROFESSOR P, COURSE C, SECTION S WHERE P.SSN = '$SSN' AND P.SSN = S.SSN AND C.Course_num = S.Course_num";
    $result = $link->query($query1);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Title: ", $row["Title"], "<br>";
            echo "Classrooms: ", $row["Classroom"], "<br>";
            echo "Meeting Days: ", $row["Meet_days"], "<br>";
            echo "Start Time: ", $row["Beg_time"], "<br>";
            echo "End Time: ", $row["End_time"], "<br> <br>";
        }
    } else {
        echo "0 results";
    }
    $result->free_result();
    $link->close();

    ?>
</body>

</html>