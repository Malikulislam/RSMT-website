<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>View Students</title>
</head>

<body>
    <div class="container">
    <h1 class="text-center mt-3">View Students</h1>

    <?php
    session_start();

    // Check if admin is logged in
    if (!isset($_SESSION['admin'])) {
        header("Location: admin.php");
        exit();
    }

    // Connect to the database
    require_once 'database.php';

    // Query to retrieve all students
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    // Display all student data
    ?>
    <table border="2" class="table table-striped mt-5">
        <tr>
            <th>ID</th>
            <th >Full Name</th>
            <th>Email</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['Id'] ?></td>
                <td><?= $row['full_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><a href="#">Edit</a></td>
                <td><a href="#">Delete</a></td>
            </tr>
        <?php } ?>

    </table>
    <a href="logout.php"><button type="button" class="btn btn-warning mt-1 float-right">Back</button></a>
    </div>
</body>
</html>

    <?php mysqli_close($conn); ?>