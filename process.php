<?php
session_start();
include("connect.php"); // Sertakan koneksi database

// Cek apakah form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitasi dan validasi input
    $tajukBuku = isset($_POST['tajukBuku']) ? mysqli_real_escape_string($conn, trim($_POST['tajukBuku'])) : '';
    $pengarang = isset($_POST['pengarang']) ? mysqli_real_escape_string($conn, trim($_POST['pengarang'])) : '';
    $jenisBuku = isset($_POST['jenisBuku']) ? mysqli_real_escape_string($conn, trim($_POST['jenisBuku'])) : '';
    $keterangan = isset($_POST['keterangan']) ? mysqli_real_escape_string($conn, trim($_POST['keterangan'])) : '';

    // Cek apakah create atau edit
    if (isset($_POST['create'])) {
        // Proses tambah buku
        if (!empty($tajukBuku) && !empty($pengarang) && !empty($jenisBuku) && !empty($keterangan)) {
            $sql = "INSERT INTO rekod_buku (tajukBuku, pengarang, jenisBuku, keterangan) VALUES (?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssss", $tajukBuku, $pengarang, $jenisBuku, $keterangan);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION["success"] = "Buku baru berhasil ditambahkan!";
                } else {
                    $_SESSION["error"] = "Gagal menambah buku.";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            $_SESSION["error"] = "Sila isi semua maklumat yang diperlukan!";
        }
    } elseif (isset($_POST['edit'])) {
        // Proses update buku
        $id = isset($_POST['id']) ? mysqli_real_escape_string($conn, trim($_POST['id'])) : '';
        if (!empty($id) && !empty($tajukBuku) && !empty($pengarang) && !empty($jenisBuku) && !empty($keterangan)) {
            $sql = "UPDATE rekod_buku SET tajukBuku=?, pengarang=?, jenisBuku=?, keterangan=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssi", $tajukBuku, $pengarang, $jenisBuku, $keterangan, $id);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION["update"] = "Rekod buku berhasil dikemas kini!";
                } else {
                    $_SESSION["error"] = "Gagal mengemas kini buku.";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            $_SESSION["error"] = "Sila isi semua maklumat yang diperlukan!";
        }
    } else {
        $_SESSION["error"] = "Permintaan tidak sah!";
    }

    // Redirect setelah semua proses selesai
    header("Location: index.php");
    exit();
}

// Tutup koneksi
mysqli_close($conn);
?>
