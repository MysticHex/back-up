<?php
    include 'connection.php';
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date('d/m/Y h:i A');

    if (isset($_POST['btn3'])&&isset($_FILES['file3'])) {
        echo "<pre>";
        print_r($_FILES['file3']); 
        echo "</pre>"; 
        $fn = (isset($_POST['nama3'])) ? $_POST['nama3'] :"";
        $judul = (isset($_POST['judul3'])) ? $_POST['judul3'] :"";
        $docname = $_FILES['file3']['name'];
        $tmp_name = $_FILES['file3']['tmp_name'];
        $error = $_FILES['file3']['error'];

        if($error===0){
            $docex=pathinfo($docname,PATHINFO_EXTENSION);
            
            $docex_lc=strtolower(($docex));

            $allowedexs=array("docx","pdf");

            if(in_array($docex_lc,$allowedexs)){
                $newdocname=uniqid("document-",true).".".$docex_lc;
                $document_upload_path='uploads/'.$newdocname;
                move_uploaded_file($tmp_name,$document_upload_path);
                $sql="INSERT INTO `files`(
                    `author`,
                    `judul`,
                    `file_type_id`,
                    `isi`
                )
                VALUES(
                    '$fn',
                    '$judul',
                    'document',
                    '$newdocname'
                );";
                $run=mysqli_query($conn,$sql);
                header('Location:h1.php?pilihan=artdok&sm=Berhasil');
            }else{
                header('location:h1.php?pilihan=artdok&em=Format file tidak didukung');
            }
        }
    
    }else{
        header('Location:h1.php?pilihan=artdok&em=File belum terpilih');
    }
?>