<?php
// $dbHost = "localhost";  
// $dbUser = "root";       
// $dbPass = "";           
// $dbName = "buku";       

// $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// if (!$conn) {
//     die("Pangkalan data tidak dapat disambungkan: " . mysqli_connect_error());
// }
?>

<?php
$servername = "localhost";
$username = "root"; // Tukar jika perlu
$password = ""; // Tukar jika perlu
$dbname = "buku"; // Nama database anda

// Membuat sambungan
$conn = new mysqli($servername, $username, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

