<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <h1>Tambah Buku</h1>
        <form action="process.php" method="post">
            <label for="tajuk">Tajuk Buku:</label>
            <input type="text" id="tajuk" name="tajukBuku" placeholder="Masukkan tajuk buku" required>

            <label for="pengarang">Nama Pengarang:</label>
            <input type="text" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" required>

            <label for="jenis">Pilih Jenis Buku:</label>
            <select id="jenis" name="jenisBuku" required>
                <option value="" disabled selected>Pilih jenis buku</option>
                <option value="Pendidikan Islam">Pendidikan Islam</option>
                <option value="Sains dan Teknologi">Sains dan Teknologi</option>
                <option value="Pengembaraan">Pengembaraan</option>
                <option value="Fiksyen">Fiksyen</option>
            </select>

            <label for="keterangan">Keterangan Buku:</label>
            <textarea id="keterangan" name="keterangan" rows="4" placeholder="Tulis keterangan buku di sini"></textarea>

            <button type="submit" name="create" class="btn-submit">Tambah Buku</button>
        </form>
    </div>
</body>
</html>

<!-- 
<body>
    <div class="container">
        <header>
            <h1>Kemas Kini Buku</h1>
            <div>
                <a href="index.php" class="btn">Kembali</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <div class="form-element">
                <input type="text" name="tajukBuku" placeholder="Tajuk Buku:" required>
            </div>
            <div class="form-element">
                <input type="text" name="pengarang" placeholder="Nama Pengarang:" required>
            </div>
            <div class="form-element">
                <select name="jenisBuku" required>
                    <option value="">Pilih Jenis Buku:</option>
                    <option value="Pendidikan Islam">Pendidikan Islam</option>
                    <option value="Sains dan Teknologi">Sains dan Teknologi</option>
                    <option value="Pengembaraan">Pengembaraan</option>
                    <option value="Fiksyen">Fiksyen</option>
                </select>
            </div>
            <div class="form-element">
                <textarea name="keterangan" placeholder="Keterangan Buku:" required></textarea>
            </div>
            <div class="form-element">
                <input type="submit" name="create" value="Tambah Buku" class="btn">
            </div>
        </form>
    </div>
</body> -->