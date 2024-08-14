<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == 'admin' && $password == 'password') {
        $_SESSION['admin'] = $username;
        header("Location: view_students.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">

    <form action="admin.php" method="post">
    <h1 class="text-center mt-3">Admin Login</h1><br>
           
            
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary ">Login</button>
            <a href="index.html"><button type="button" class="btn btn-warning float-right" >Back</button></a>

    </form>
    </div>
</body>
</html>
