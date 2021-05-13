<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $id = $_GET['idxoa'];
    $sqlSelect = "SELECT * FROM `hanghoa` WHERE MSHH = $id";
    $resultSelect = mysqli_query($conn, $sqlSelect);
    $hhrow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
    $upload_dir = __DIR__."/../../../assets/upload/";
    $subdir = 'img-product/';
    $old_file = $upload_dir . $subdir . $hhrow['HinhAnh'];
    if(file_exists($old_file)){
        unlink($old_file);
    }
    $sql = "DELETE FROM `hanghoa` where MSHH =" . $id;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
?>