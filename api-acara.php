<?php

include 'koneksi.php';

if ($koneksi) {

    $query = "SELECT * FROM tb_acara"; 
    $result = mysqli_query($koneksi, $query);

    if ($result) {

        $data_table= array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Assuming 'gambar' is the column name where blob data is stored
            // Convert blob to base64
            $data_acara[] = $row;
        }

        echo json_encode($data_acara);

        mysqli_free_result($result);

    } else {
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

} else {
    echo "Koneksi tidak berhasil";
}
?>