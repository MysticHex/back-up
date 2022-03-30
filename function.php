<?php
    $conn=mysqli_connect("localhost","root","","library");

    function query($query){
        global $conn;
        $result=mysqli_query($conn,$query);
        $rows=[];
        while($rows=mysqli_fetch_assoc($result)){
            $rows[]=$rows;
        }
        return $rows;
    }
    function cari($keyword){
        $query="SELECT * FROM `users`
                WHERE
                `username`=$keyword";

        return query($query);
    }
?>