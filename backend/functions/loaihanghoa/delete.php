<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $id = $_GET['idxoa'];
    $sql = "DELETE FROM `loaihanghoa` where MaLoaiHang =" . $id;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
?>