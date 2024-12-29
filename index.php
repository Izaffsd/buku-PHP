<?php
// Periksa jika sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Panggil session_start hanya jika sesi belum aktif
}

// Check if the user is logged in, if not redirect them to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to login page
    exit;
}

// Display success messages
if (isset($_SESSION["create"])) {
    echo '<div class="success">';
    echo $_SESSION["create"];
    echo '</div>';
    unset($_SESSION["create"]);
}

if (isset($_SESSION["update"])) {
    echo '<div class="success">';
    echo $_SESSION["update"];
    echo '</div>';
    unset($_SESSION["update"]);
}

if (isset($_SESSION["delete"])) {
    echo '<div class="success">';
    echo $_SESSION["delete"];
    echo '</div>';
    unset($_SESSION["delete"]);
}
  // Periksa apakah ada pesan sukses
  if (isset($_SESSION["success"])) {
    echo '<div class="success">' . $_SESSION["success"] . '</div>';
    unset($_SESSION["success"]); // Hapus pesan setelah ditampilkan
}

// Periksa apakah ada pesan error
if (isset($_SESSION["error"])) {
    echo '<div class="alert alert-danger">' . $_SESSION["error"] . '</div>';
    unset($_SESSION["error"]); // Hapus pesan setelah ditampilkan
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Buku</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f6f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 25px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 40px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-logo {
            display: flex;
            align-items: center;
        }

        .header-logo img {
            max-width: 80px;
            margin-right: 15px;
        }

        .header h1 {
            font-size: 2rem;
            color: #333;
            margin: 0;
        }
        /* Success Message */
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 5px solid #28a745;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 16px;
            text-align: center;
            font-size: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 1.1rem;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e2edff;
            transition: background-color 0.3s ease;
        }

        /* Button Styles */
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-right: 8px;
            display: inline-block;
            text-decoration: none;
        }

        .btn-blue {
            background-color: #007bff;
            color: white;
        }

        .btn-blue:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-yellow {
            background-color: #ffc107;
            color: white;
        }

        .btn-yellow:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-red {
            background-color: #dc3545;
            color: white;
        }

        .btn-red:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Add Book Button */
        .add-book {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .add-book:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Logout Button */
        .btn-logout {
            font-size: 15px;
            text-decoration: none;
            color: #343a40;
            padding: 14px 18px;
            background-color: #f1f1f1;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .btn-logout:hover {
            color: #343a40;
            font-weight: bold;
            background-color: #e1e1e1;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <!-- Logo and Title -->
        <div class="header-logo">
            <img src="imgs/images-removebg-preview.png" alt="ILP Kuala Langat Logo">
            <h1>Senarai Buku</h1>
        </div>
        <div>
            <a href="create_book.php" class="add-book">Tambah buku baru</a>
            <a href="index.php?logout=true" class="btn-logout">Log Keluar</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tajuk Buku</th>
                <th>Nama Pengarang</th>
                <th>Jenis Buku</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('connect.php');
        $sqlSelect = "SELECT * FROM rekod_buku";
        $result = mysqli_query($conn, $sqlSelect);
        // echo $sql = "SELECT * FROM `rekod_buku` WHERE id=$id";
        //         $result = mysqli_query($conn, $sql);
        //         $row = mysqli_fetch_array($result);
        $count = 1; // Dynamic numbering
        if ($result && mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $data['tajukBuku']; ?></td>
                <td><?php echo $data['pengarang']; ?></td>
                <td><?php echo $data['jenisBuku']; ?></td>
                <td>
                    <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-blue">Lebih lanjut</a>
                    <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-yellow">Kemas kini</a>
                    <a href="delete.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Adakah anda pasti ingin buang rekod ini?')" class="btn btn-red">Buang</a>
                </td>
            </tr>
        <?php
            $count++;
            }
        } else {
            echo "<tr><td colspan='5'>Tiada rekod buku dijumpai.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>



