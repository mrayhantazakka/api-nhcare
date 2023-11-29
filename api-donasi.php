<?php

require_once "koneksi.php"; // Sesuaikan dengan file koneksi Anda

function insertDonasi($data) {
    global $koneksi; // Menggunakan variabel global untuk koneksi

    // Memeriksa apakah parameter yang diperlukan ada dalam array $data
    if (isset($data['transaction_id'], $data['gross_amount'], $data['order_id'], $data['settlement_time'], $data['id_donatur'], $data['nama_donatur'], $data['keterangan'], $data['doa'])) {
        $transactionId = $data['transaction_id'];
        $grossAmount = $data['gross_amount'];
        $orderId = $data['order_id'];
        $settlementTime = $data['settlement_time'];
        $idDonatur = $data['id_donatur'];
        $namaDon = $data['nama_donatur'];
        $keterangan = $data['keterangan'];
        $doa = $data['doa'];
    
        // Masukkan data ke dalam tabel MySQL
        $query = "INSERT INTO tb_donasi (transaction_id, gross_amount, order_id, settlement_time, id_donatur, nama_donatur, keterangan, doa) VALUES ('$transactionId', '$grossAmount', '$orderId', '$settlementTime', '$idDonatur', '$namaDon', '$keterangan', '$doa')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            return ['message' => 'Data berhasil disimpan'];
        } else {
            return ['message' => 'Gagal menyimpan data. Error: ' . mysqli_error($koneksi)];
        }
    } else {
        return ['message' => 'Data tidak lengkap. Pastikan semua parameter tersedia.'];
    }
}

// Mendapatkan data dari parameter URL
$data = $_POST; 

// Memanggil fungsi insertDonasi
$response = insertDonasi($data);

// Menampilkan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);


?>