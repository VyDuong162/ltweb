<?php
    include_once(__DIR__ . '/../../dbconnect.php');
    $sqlSoLuongKhachHang ="SELECT COUNT(*) AS tongkh FROM khachhang";
    $result = mysqli_query($conn, $sqlSoLuongKhachHang);
    $dataSoLuongKhachHang;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongKhachHang = array(
            'tongkh' => $row['tongkh']
        );
    }
    echo json_encode($dataSoLuongKhachHang);
?>