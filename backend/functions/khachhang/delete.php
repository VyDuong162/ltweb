<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    $sqlKhachHang ="DELETE FROM khachhang WHERE MSKH=$id";
    mysqli_query($conn, $sqlKhachHang);
    $sqlTaiKhoan ="DELETE FROM taikhoan a join khachhang b on a.username= b.usename WHERE b.MSKH=$id";
    mysqli_query($conn, $sqlTaiKhoan);
    //var_dump($sql); die();
    mysqli_close($conn);
    header('location:index.php');
?>