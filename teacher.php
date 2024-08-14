<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Attendance sheet</title>
</head>
<body>
    <div class="container">
        <form action="teacher.php" method="post">
            <h1 class="text-center mt-3">Attendance List</h1><br>
            <label for="course">Course:</label>
            <select name="course" id="course" onchange="getStudents(this.value)">
                <option value="" disabled selected>--Please choose an option--</option>
                <option value="BCA">BCA</option>
                <option value="BBA">BBA</option>
                <option value="MCA">MCA</option>
                <option value="MBA">MBA</option>
            </select>
            <input type="submit" name="submit" class="btn btn-primary float-right" value="Show students">
            <br><br>
            <label for="date">Date:</label>
            <input type="date" name="date" id="date"><br><br>
            <?php
            session_start();
            if (!isset($_SESSION['teacher'])) {
                header("Location: teacher_login.php");
                exit();
            }
            require_once 'database.php';
            if (isset($_POST['submit'])) {
                $courses = $_POST['course'];
                $query = "SELECT * FROM users WHERE course = '$courses'";
                $result = mysqli_query($conn, $query);
                echo "<table class='table table-striped'>
                <thead>
                  <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Name</th>
                    <th scope='col'>Present</th>
                    </tr>
                </thead>";
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tbody><tr><td>" . $row["Id"] . "</td><td>" . $row["full_name"] . "</td><td> <input type='checkbox' name='attendance[]' value='" . $row["Id"] . "'>" . "</td></tr></tbody>" . "\n";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No students found in this course.</p>";
                }
            }
            if (isset($_POST['register'])) {
                $ids = $_POST['attendance'];
                $date = $_POST['date'];
                foreach ($ids as $id) {
                    $query = "SELECT * FROM attendance_register WHERE student_id = '$id' AND date = '$date'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo '<script>alert("This user has already been marked present for this date.")</script>';
                    } else {
                        $query2 = "INSERT INTO attendance_register(student_id, date,attendance) VALUES('$id', '$date', 'P')";
                        if (!mysqli_query($conn, $query2)) {
                            die("Error: " . mysqli_error($conn));
                        }

                        echo '<script>alert("Attendance recorded!")</script>';
                    }
                }
            }
            if (isset($_POST['view'])) {
                $courses = $_POST['course'];
                $query = "SELECT Id FROM users WHERE Course = '$courses'";
                $result = mysqli_query($conn, $query);
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Student ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($ids = mysqli_fetch_assoc($result)) {
                                $studentId = $ids["Id"];
                                $query2 = "SELECT * FROM attendance_register WHERE student_id='$studentId' ORDER BY date ";
                                $res = mysqli_query($conn, $query2);
                                while ($r = mysqli_fetch_assoc($res)) {
                                    echo "<tr>";
                                    echo "<td>" . $r['date'] . "</td>";
                                    echo "<td>" . $r['student_id'] . "<br></td>";
                                    echo "<td>P</td></tr>";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <form method="post">
                    <button class="btn btn-primary" name="export" value="Export to Excel">Export to Excel</button>
                </form>
                <?php
            }
            if (isset($_POST['logout'])) {
                session_start();
                session_destroy();
                header("Location: teacher_login.php");
            }
            ?>
            <br>
            <input type="submit" name="register" class="btn btn-primary" value="Save">
            <button type="logout" name="logout" class="btn btn-warning float-right">Log Out</button>
            <button type="view" name="view" class="btn btn-info float-right mr-3">View Attendance</button>
        </form>
    </div>
</body>
</html>