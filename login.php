<?php
session_start();
include('connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user exists in the database
    $sql = "SELECT * FROM login_users WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        // Verify password if the user is found
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Password is correct, create session
                $_SESSION["username"] = $username;
                $_SESSION["user_id"] = $row['id']; // Store user ID if needed
                
                // Redirect to index.php
                header("Location: index.php");
                // header("Location: view.php");
                // header("Location: index.php");

                exit;
            } else {
                $error = "Kata laluan salah!";
            }
        } else {
            $error = "Nama pengguna tidak dijumpai!";
        }

        mysqli_stmt_close($stmt);
    }
}

// Display the login form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 42px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        p {
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        /* Error message */
        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Log Masuk</h2>
    
    <!-- Error Message (if exists) -->
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    
    <!-- Login Form -->
    <form action="login.php" method="POST">
        <label for="username">Nama Pengguna:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Kata Laluan:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Log Masuk">
    </form>

    <p>Belum ada akaun? <a href="signup.php">Daftar</a></p>
</div>

</body>
</html>
