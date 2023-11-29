<?php

include "koneksi.php";

$email = $_GET['email'];
$password = $_GET['password'];

if (!empty($email) && !empty($password)) {
    // Perbaikan keamanan: Menggunakan prepared statement
    $query = "SELECT * FROM tb_donatur WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $result = mysqli_stmt_num_rows($stmt);

        if ($result > 0) {
            $idDonatur = getDataDonaturByEmail($email); // Fungsi untuk mendapatkan ID donatur berdasarkan email
            echo json_encode(["status" => "success", "id_donatur" => $idDonatur]);
        } else {
            echo json_encode(["status" => "failed", "message" => "Email atau password salah"]);
        }
    } else {
        echo json_encode(["status" => "failed", "message" => "Error in the prepared statement."]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["status" => "failed", "message" => "Isi semua data"]);
}

function getDataDonaturByEmail($email) {
    global $koneksi;
    
    // Query untuk mendapatkan ID donatur berdasarkan email
    $email = mysqli_real_escape_string($koneksi, $email);
    $query = "SELECT id_donatur, nama, email, no_hp FROM tb_donatur WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('Error in query: ' . mysqli_error($koneksi));
    }

    $row = mysqli_fetch_assoc($result);
    return $row;
}
?>