<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="remember">Remember Me:</label>
        <input type="checkbox" id="remember" name="remember"><br><br>

        <input type="submit" value="Login">
    </form>

    <?php
     session_start(); 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];

            // Establish a database connection
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "form";

            $conn = new mysqli($servername, $db_username, $db_password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute a SQL query to check the credentials
            $sql = "SELECT * FROM formi WHERE name = ? AND email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Redirect to another page on successful login
                $_SESSION['loggedin'] = true;
                header("Location: view.php");
                exit();
            } else {
                if($result->num_rows > 1){
                    echo "multiple user are exist";
                }else{
                    echo "Login failed. Please check your username and password.";
                }
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        }
    ?>
</body>
</html>
