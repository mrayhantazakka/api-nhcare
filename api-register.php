<?php
include "koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$nohp = $_POST['no_hp'];
$password = $_POST['password'];

if (!empty($nama) && !empty($email) && !empty($password) && !empty($nohp)) {
    // Generate id_donatur unik dengan 8 karakter
    $idDonatur = "DNTR-".generateUniqueId(5);

    // Masukkan data baru ke dalam tabel
    $regis = "INSERT INTO tb_donatur(id_donatur, nama, email, no_hp, password) VALUES ('$idDonatur', '$nama', '$email', '$nohp', '$password')";
    $msqlRegis = mysqli_query($koneksi, $regis);

    if ($msqlRegis) {
        echo "Daftar Berhasil";
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
} else {
    echo "Semua data harus diisi";
}

// Fungsi untuk generate id_donatur unik    
function generateUniqueId($length) {
    $characters = '0123456789';
    $randomString = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>