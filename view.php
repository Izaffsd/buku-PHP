<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keterangan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .book-details {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .book-details strong {
            display: block;
            margin-bottom: 10px;
        }
        .book-details p {
            margin-bottom: 15px;
            color: #555;
        }
        .btn-back {
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index.php" class="btn-back">Kembali</a>
    <h1>Keterangan Buku</h1>
    <div class="book-details">
        <?php
            include('connect.php');
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM rekod_buku WHERE id = $id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<strong>Tajuk Buku:</strong><p>{$row['tajukBuku']}</p>";
                        echo "<strong>Keterangan:</strong><p>{$row['keterangan']}</p>";
                        echo "<strong>Nama Pengarang:</strong><p>{$row['pengarang']}</p>";
                        echo "<strong>Jenis Buku:</strong><p>{$row['jenisBuku']}</p>";
                    }
                } else {
                    echo "<p>Rekod buku tidak dijumpai.</p>";
                }
            } else {
                echo "<p>Tiada ID buku disertakan dalam URL.</p>";
            }
        ?>
    </div>
</div>

</body>
</html>
