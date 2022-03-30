<?php
include 'connection.php';

if (isset($_POST['btnSubmit2'])) {
    $nama2 = (isset($_POST['nama2'])) ? $_POST['nama2'] : "";
    $judul2 = (isset($_POST['judul2'])) ? $_POST['judul2'] : "";
    $isi2 = (isset($_POST['isi2'])) ? $_POST['isi2'] : "";

    $instart = "INSERT INTO `FILES`(
                        `author`,
                        `judul`,
                        `file_type_id`,
                        `isi`
                    )
                    VALUES(
                        '$nama2',
                        '$judul2',
                        'Artikel',
                        '$isi2'
                    )";

    $insart = mysqli_query($conn, $instart);
    if ($insart) {
        header('Location:h1.php?pilihan=Artikel&sm=Artikel berhasil diupload');
    } else {
        header('Location:h1.php?pilihan=Artikel&em=Artikel gagal diupload');
    }
}
