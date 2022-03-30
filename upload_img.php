<?php
    session_start();
    include 'connection.php';
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date('d/m/Y h:i A');

    if (isset($_POST['btn_4'])&&isset($_FILES['file_4'])) {
        echo "<pre>";
        print_r($_FILES['file_4']);
        echo "</pre>";

        $fn = (isset($_POST['nama_4'])) ? $_POST['nama_4'] :"";
        $judul = (isset($_POST['judul_4'])) ? $_POST['judul_4'] :"";
        
        $imgname = $_FILES['file_4']['name'];
        $tmp_name = $_FILES['file_4']['tmp_name'];
        $error = $_FILES['file_4']['error'];
        
        $img_count=count($imgname);
        // echo $img_count;
        
        for ($i=0; $i < $img_count; $i++) { 
            echo $i.'<br>';
            $imgnamei = $_FILES['file_4']['name'][$i];
            $tmp_namei = $_FILES['file_4']['tmp_name'][$i];
            $error = $_FILES['file_4']['error'][$i];

        if($error===0){
            $imgex=pathinfo($imgnamei,PATHINFO_EXTENSION);

            $img_ex_lc=strtolower($imgex);

            $allowed_exs=array('png','jpeg','jpg');

            if(in_array($img_ex_lc, $allowed_exs)){
                $newimgname = uniqid("image-$i"."_",true).".".$img_ex_lc;
                echo $newimgname.'<br>';
                
                $image_upload_path='uploads/'.$newimgname;
                $move=move_uploaded_file($tmp_namei,$image_upload_path);

                echo $image_upload_path.'<br>';

                $sql="INSERT INTO `files`(
                          `author`,
                          `judul`,
                          `file_type_id`,
                          `isi`
                      )
                      VALUES(
                          '$fn',
                          '$judul',
                          'image',
                          '$newimgname'
                      )";
                  
                  $run=mysqli_query($conn,$sql);

                  $ssql="SELECT * FROM `files` WHERE `isi`='$newimgname'";
                  $rrun=mysqli_query($conn,$ssql);
                  $row=mysqli_fetch_assoc($rrun);
                  $iid=$row['id'];
                  $jud=$row['judul'];
                  $typ=$row['file_type_id'];
                  $ca=$row['created_at'];
                  $ua=$row['update_at'];
  
                  $sssql="INSERT INTO `assignment`(
                      `file_id`,
                      `version`,
                      `production_year`,
                      `created_by_user_id`,
                      `file_size`,
                      `duration`,
                      `length`,
                      `url`,
                      `created_at`
                  )
                  VALUES(
                      '$iid',
                      '',
                      '$',
                      '$',
                      '$',
                      '$',
                      '$',
                      '$',
                      '$'
                  )";
                    if($run&&$move){
                      header('Location:h1.php?pilihan=image&sm=Image Berhasil diunggah');
                    }else{
                        header("Location:h1.php?pilihan=image&em=There was an error occured");
                    }

            }else{
                header("Location:h1.php?pilihan=image&em=Tipe file tidak didukung");
            }
        }
    }
}else{
    header("Location:h1.php?pilihan=image&em=There was an error occured");
}

?>
