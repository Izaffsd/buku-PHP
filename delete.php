<?php
// Check if 'id' is set in the GET request
if (isset($_GET['id'])) {
    include("connect.php");

    // Sanitize the 'id' to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Prepare the SQL statement to delete the record
    $sql = "DELETE FROM rekod_buku WHERE id='$id'";
    
    // Execute the query and check for success
    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete"] = "Rekod buku berjaya dibuang!";
        header("Location: index.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        die("Terdapat masalah dalam membuang rekod: " . mysqli_error($conn));
    }
} else {
    echo "Buku tidak wujud";
}
?>
