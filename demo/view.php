<!DOCTYPE html>
<html>
<head>
    <title>View Data</title>
</head>
<body>
    <h2>User Data</h2>
<form method="POST" action=""> 
    <input type="text" id="search" name="search" />
    <input type="submit" name="btn_search" value="search user">
</form>

    <?php
    // Connect to the database (you can reuse the previous database connection code)

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "form";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


        if(isset($_POST['btn_search']) && !empty($_POST['search'])) {
            $searchTerm = $_POST['search'];
    
            // Use a prepared statement to avoid SQL injection
            $sql = "SELECT name, email FROM formi WHERE name LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Display the results in a table
            echo "<table width='200' border='1'>";
            echo "<tr>";
            echo "<th>name</th>";
            echo "<th>email</th>";
            echo "</tr>";
    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "</tr>";
            }
    
            echo "</table>";
        }else{
            
    // Retrieve data from the database (assuming a "users" table)
        $sql = "SELECT name, email FROM formi";
        $result = $conn->query($sql);

        echo "<table width='200' border='1'>";
        echo "<tr>";
        echo "<th>name</th>";
        echo "<th>email</th>";
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        }
    



    $conn->close();
    ?>
</body>
</html>
