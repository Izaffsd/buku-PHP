<?php
session_start();
include('connect.php'); // Sambungkan ke database

// Semak jika pengguna sudah log masuk, redirect ke halaman index jika ya
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// Proses pendaftaran pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    
    // Semak jika nama pengguna sudah wujud
    $sqlCheck = "SELECT * FROM login_users WHERE username = ?";
    $stmt = $conn->prepare($sqlCheck);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Nama pengguna sudah wujud!";
    } else {
        // Hash password untuk keselamatan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan data pengguna ke dalam database dengan created_at
        $sqlInsert = "INSERT INTO login_users (username, password, email, created_at) VALUES (?, ?, ?, NOW())";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("sss", $username, $hashed_password, $email);

        if ($stmtInsert->execute()) {
            $_SESSION['create'] = "Pendaftaran dan Log masuk berjaya!";
            header("Location: login.php");
            exit;
        } else {
            $_SESSION['error'] = "Ralat semasa pendaftaran. Sila cuba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pengguna</title>
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
            padding: 40px;
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

        input[type="text"], input[type="password"], input[type="email"] {
            width: 93%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-submit {
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

        .btn-submit:hover {
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
    <h2>Pendaftaran Pengguna</h2>

    <!-- Tunjukkan mesej ralat jika ada -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    <!-- Registration Form -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Nama Pengguna:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Kata Laluan:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="email">E-mel:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit" class="btn-submit">Daftar</button>
    </form>
    <p>Sudah mempunyai akaun? <a href="login.php">Log Masuk</a></p>
</div>
</body>
</html>
