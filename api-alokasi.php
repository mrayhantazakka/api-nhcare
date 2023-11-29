<?php

include 'koneksi.php';

if ($koneksi) {

    $query = "SELECT * FROM tb_alokasi"; 
    $result = mysqli_query($koneksi, $query);

    if ($result) {

        $data_program = array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Assuming 'gambar' is the column name where blob data is stored
            $row['img_alokasi'] = base64_encode($row['img_alokasi']); // Convert blob to base64
            $data_mapel[] = $row;
        }

        echo json_encode($data_mapel);

        mysqli_free_result($result);

    } else {
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

} else {
    echo "Koneksi tidak berhasil";
}
?>