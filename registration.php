<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        // Connect to the database
        include 'database.php';

        // Initialize errors array
        $errors = [];

        // Check if form is submitted
        if (isset($_POST['submit'])) {
            // Sanitize input data
            $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $course =$_POST['course'];

            // Validate input data
            if (empty($fullname)) {
                $errors[] = "Full name is required.";
            }
            if (empty($email)) {
                $errors[] = "Email is required.";
            }
            if (empty($password)) {
                $errors[] = "Password is required.";
            }
            if(empty($course)) {
                $errors[] = "Please select your course ";
            } 
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);

            if ($rowCount > 0) {
                array_push($errors, "User with this email already exists.");

            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";

                }
            }

            // Only hash the password and insert into database if there are no errors
            if (count($errors) == 0) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (full_name, email, password, Course) VALUES (?, ?, ?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $passwordHash,$course);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Registration successful.</div>";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
     
        <form action="registration.php" method="post">
        <h1 class="text-center mt-3">Registration Form</h1><br>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" class="form-control" name="fullname"><br>
            </div>
           <div class="form-group">
    <label for="course">Course:</label>
    <select name="course" id="course" class="form-control">
        <option value="BCA">BCA</option>
        <option value="BBA">BBA</option>
        <option value="MCA">MCA</option>
        <option value="MBA">MBA</option>
    </select>
</div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email"><br>
            </div>

            <div class="form-group password">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" name="password"><br>
            </div>

            <div class="form-group password">
                <label for="repeat_password">Repeat Password:</label>
                <input type="password" id="repeat_password" class="form-control" name="repeat_password"><br>
            </div>

            <input type="submit" name="submit" class="btn btn-primary" value="Register">
            <a href="index.html"><button type="button" class="btn btn-warning" >Back</button></a>
        </form>
        <div>
            <div><p>Already registered?  <a href="login.php">Login here</a>.</p></div>
    </div>
</body>

</html>
