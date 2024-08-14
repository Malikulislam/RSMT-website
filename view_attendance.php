<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>View Attendance</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">View Attendance</h1><br>
        <label for="course">Course:</label>
        <select name="course" id="course"  >
          <option value="" disabled selected>--Please choose an option--</option>
            <option value="BCA">BCA</option>
            <option value="BBA">BBA</option>
            <option value="MCA">MCA</option>
            <option value="MBA">MBA</option>
        </select>
        <input type="submit" name="submit" class="btn btn-primary float-right" value="Show attendance">
        <br><br>
        <?php

        session_start();

        if (!isset($_SESSION['teacher'])) {
            header("Location: teacher_login.php");
            exit();
        }

        require_once 'database.php';

        if (isset($_POST['submit'])) {
            $courses = $_POST['course'];
            $query = "SELECT * FROM attendance_register WHERE course = '$courses'";
            $result = mysqli_query($conn, $query);
            echo "<table class='table table-striped'>
                    <thead>
                      <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Date</th>
                        <th scope='col'>Attendance</th>
                        </tr>
                    </thead>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tbody><tr><td>".$row["Id"]."</td><td>". $row["full_name"]. "</td><td>". $row["date"]. "</td><td>". $row["attendance"]. "</td></tr></tbody></table>". "\n";
                }
            } else {
                echo "<p>No attendance records found in this course.</p>";
            }
        }

        if (isset($_POST['logout'])) {
            session_start();
            session_destroy();
            header("Location: teacher_login.php");
        }
      ?>
        <br>
        <button type="logout" name="logout" class="btn btn-warning float-right">Log Out</button>
    </div>
</body>
</html>