<?php

include 'koneksi.php';

if ($koneksi) {

    $query = "SELECT nama,kelas,nama_sekolah,deskripsi,img_anak FROM tb_anakasuh"; 
    $result = mysqli_query($koneksi, $query);

    if ($result) {

        $data_anakasuh= array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Assuming 'gambar' is the column name where blob data is stored
            $row['img_anak'] = base64_encode($row['img_anak']); // Convert blob to base64// Convert blob to base64
            $data_anakasuh[] = $row;
        }

        echo json_encode($data_anakasuh);

        mysqli_free_result($result);

    } else {
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

} else {
    echo "Koneksi tidak berhasil";
}
?>