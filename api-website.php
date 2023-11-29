<?php

include 'koneksi.php';

if ($koneksi) {

    $query = "SELECT * FROM tb_website"; 
    $result = mysqli_query($koneksi, $query);

    if ($result) {

        $data_website= array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Assuming 'gambar' is the column name where blob data is stored
            $row['img_website'] = base64_encode($row['img_website']); // Convert blob to base64
            $data_website[] = $row;
        }

        echo json_encode($data_website);

        mysqli_free_result($result);

    } else {
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

} else {
    echo "Koneksi tidak berhasil";
}
?>