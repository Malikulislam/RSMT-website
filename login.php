<?php
session_start();
if(isset($_SESSION['users'])) {  
    header(("Location: index.php"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Login</title>
</head>

   
        <?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['users'] = "$email";
            header("Location: index.php");
            die();
        } else {
            echo "<p style='color:red;'>Invalid Password! Try Again.</p>";
        }
    } else {
        echo "<h3 style='color:red'>Invalid Email or Password! Please try again.</h3>";
    }
}
?>

<body>
<div class="container">
    <form action="login.php" method="post">
    <h1 class="text-center mt-3">Login Form</h1><br>
           
            
            <div class="form-group">
              <label for="email">Email ID:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="index.html"><button type="button" class="btn btn-warning float-right" >Back</button></a>
          </form>
        <div>
            <div>Not  registered? <a href="registration.php">Register Here</a></div>
    </div>
</div>
</body>
</html>
