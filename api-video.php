<?php

include 'koneksi.php';

if ($koneksi) {

    $query = "SELECT * FROM tb_video"; 
    $result = mysqli_query($koneksi, $query);

    if ($result) {

        $data_video= array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Assuming 'gambar' is the column name where blob data is stored
            // Convert blob to base64
            $data_video1[] = $row;
        }

        echo json_encode($data_video1);

        mysqli_free_result($result);

    } else {
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

} else {
    echo "Koneksi tidak berhasil";
}
?>