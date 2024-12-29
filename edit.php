<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemas Kini Buku</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f8fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 60px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-weight: 500;
            margin-top: 10px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>          
<div class="container">
    <a href="index.php" class="btn-back">Kembali</a>
    <h1>Kemas Kini Buku</h1>
    <form action="process.php" method="post">
        <?php
        if (isset($_GET['id'])) {
            include("connect.php");
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM `rekod_buku` WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
        ?>
                <label for="tajuk">Tajuk Buku:</label>
                <input type="text" id="tajuk" name="tajukBuku" value="<?php echo $row['tajukBuku']; ?>" required>

                <label for="pengarang">Nama Pengarang:</label>
                <input type="text" id="pengarang" name="pengarang" value="<?php echo $row['pengarang']; ?>" required>

                <label for="jenis">Pilih Jenis Buku:</label>
                <select id="jenis" name="jenisBuku" required>
                    <option value="" disabled>Pilih jenis buku</option>
                    <option value="Pendidikan Islam" <?php if ($row['jenisBuku'] == "Pendidikan Islam") echo "selected"; ?>>Pendidikan Islam</option>
                    <option value="Sains dan Teknologi" <?php if ($row['jenisBuku'] == "Sains dan Teknologi") echo "selected"; ?>>Sains dan Teknologi</option>
                    <option value="Pengembaraan" <?php if ($row['jenisBuku'] == "Pengembaraan") echo "selected"; ?>>Pengembaraan</option>
                    <option value="Fiksyen" <?php if ($row['jenisBuku'] == "Fiksyen") echo "selected"; ?>>Fiksyen</option>
                </select>

                <label for="keterangan">Keterangan Buku:</label>
                <textarea id="keterangan" name="keterangan" rows="4" required><?php echo $row['keterangan']; ?></textarea>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <button type="submit" name="edit" class="btn-submit">Kemas Kini Buku</button>
        <?php
            } else {
                echo "<h3>Buku tidak wujud.</h3>";
            }
        } else {
            echo "<h3>ID buku tidak disediakan.</h3>";
        }
        ?>
    </form>
</div>
</body>
</html>
