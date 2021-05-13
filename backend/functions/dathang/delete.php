<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $id = $_GET['idxoa'];
    $sqlxoaCTDH = "DELETE FROM `chitietdathang` WHERE SoDonDH = '$id'";
    $resultxoaCTDH = mysqli_query($conn, $sqlxoaCTDH);
    $sqlxoaDH = "DELETE FROM `dathang` WHERE SoDonDH = '$id'";
    $resultxoaDH = mysqli_query($conn, $sqlxoaDH);
    mysqli_close($conn);
    header('location:index.php');
?>