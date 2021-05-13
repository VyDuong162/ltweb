<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    $sqlNhanVien="DELETE FROM nhanvien WHERE MSNV=$id";
    mysqli_query($conn, $sqlNhanVien);
    $sqlTaiKhoan ="DELETE FROM taikhoan a join khachhang b on a.username= b.usename WHERE b.MSNV=$id";
    mysqli_query($conn, $sqlNhanVien);
    //var_dump($sql); die();
    mysqli_close($conn);
    header('location:index.php');
?>