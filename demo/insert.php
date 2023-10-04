<!DOCTYPE html>
<html>
<head>
    <title>Add, Update, and Delete Users</title>
</head>
<body>
    <h2>Add User</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <input type="submit" name="add_user" value="Add User">
    </form>

    <h2>Update User</h2>
    <form action="" method="post">
        <label for="update_email">Email to Update:</label>
        <input type="email" id="update_email" name="update_email"><br><br>

        <label for="new_name">New Name:</label>
        <input type="text" id="new_name" name="new_name"><br><br>

        <input type="submit" name="update_user" value="Update User">
    </form>

    <h2>Delete User</h2>
    <form action="" method="post">
        <label for="delete_email">Email to Delete:</label>
        <input type="email" id="delete_email" name="delete_email"><br><br>

        <input type="submit" name="delete_user" value="Delete User">
    </form> 

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "form";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle Add User
        if (isset($_POST['add_user'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $sql = "INSERT INTO formi (name, email) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $name, $email);

            if ($stmt->execute()) {
                echo "Data inserted successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        // Handle Update User
        if (isset($_POST['update_user'])) {
            $update_email = $_POST['update_email'];
            $new_name = $_POST['new_name'];

            $sql = "UPDATE formi SET name = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $new_name, $update_email);

            if ($stmt->execute()) {
                echo "Data updated successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        // Handle Delete User
        if (isset($_POST['delete_user'])) {
            $delete_email = $_POST['delete_email'];

            $sql = "DELETE FROM formi WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $delete_email);

            if ($stmt->execute()) {
                echo "Data deleted successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();
    ?>
</body>
</html>
