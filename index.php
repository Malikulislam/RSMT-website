<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>

<body>
    <div class="container">
        <br><br>
        <?php
        session_start();
        if (!isset($_SESSION['users'])) {
            header("Location: login.php");
        } else {
            $user = $_SESSION["users"];

            require "database.php";
            //get user data from database
            $sql = "SELECT * FROM users WHERE email='$user'";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
                $name = $row["full_name"];
                $email = $row["email"];
                $course = $row["Course"];
                $ids = $row["Id"];
                echo "<h2>Welcome back, " . $name . "!</h2><br>";
                echo "<table id=\"profileTable\">";
                echo "<tr><th colspan=\"3\" style=\"text-align:center;\">Your Profile Information</th></tr>";
                echo "<tr><td>Name : </td><td>" . $name . "</td></tr>";
                echo "<tr><td>Course : </td> <td>" . $course . "</td></tr>";
                echo "<tr><td>Email ID : </td><td>" . $email . "</td></tr>";


                $sql1 = "SELECT COUNT(student_id)  FROM attendance_register WHERE student_id='$ids'";
                $result1 = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_array($result1)) {
                    $total = $row[0];

                    echo "<tr><td>Total Pressent : </td><td>" . $total . "</td></tr>";

                }
                echo "</table>";
            }
            ?>
            <div>
                <a href="logout.php"><button type="button" class="btn btn-warning mt-5 text-right">Log Out</button></a>

            </div>
            <?php
            if (isset($_POST['logoutbtn'])) {
                unset($_SESSION['users']);
                header('location:login.php');
            }
        } ?>
    </div>
</body>

</html>