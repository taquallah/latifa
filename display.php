<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mb-3">
            <h2>Hello Welcome</h2>

            <!-- PHP Insert Form Processing -->
            <?php
            // PHP insert code
            if (isset($_POST['submit'])) {
                $conn = new mysqli("localhost", "root", "", "l42025");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $hashed=password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (Username, Email, Password)VALUES ('$username', '$email', '$hashed')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>New record created successfully</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                }

                $conn->close();
            }
            ?>

            <!-- Form for Input -->
            <form action="" method="POST">
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username">
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email">
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
                <div>
                </div>
                <div>
                    <br><button name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            <br><br>

            <!-- PHP to Display Data from Database -->
            <h3>Users List</h3>
            <?php
            // Fetching records from the database to display in a table
            $conn = new mysqli("localhost", "root", "", "l42025");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                                 <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>";

                // Output each row of data
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                             <td>" . $row["Username"] . "</td>
                            <td>" . $row["Email"] . "</td>
                            <td>
                                <a href='edit.php?id=" . $row["ID"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete.php?id=" . $row["ID"] . "' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                          </tr>";
                }

                echo "</tbody>
                    </table>";
            } else {
                echo "<div class='alert alert-info'>No records found.</div>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
