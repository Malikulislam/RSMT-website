<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicant Login</title>
  <style>
    .container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.sub-container {
  border: 5px solid black;
  margin: 0 auto;
  width: 400px;
  text-align: center;
  padding: 20px;
  background-color: #f9f9f9;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  margin-top: 0;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

label {
  margin-bottom: 10px;
}

input[type="email"], input[type="password"] {
  width: 100%;
  height: 40px;
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
}

button[type="submit"] {
  width: 100%;
  height: 40px;
  background-color: #4CAF50;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

p {
  margin-top: 20px;
}

a {
  text-decoration: none;
  color: #4CAF50;
}

a:hover {
  color: #3e8e41;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="sub-container">
      <h1>Applicant Login</h1>
      <form action="applicant.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </form>
    </div>
  </div>
</body>
</html>