<?php
    include_once(__DIR__ . '/../../dbconnect.php');
    $sqlSoLuongDatHang ="SELECT COUNT(*) AS tongdh FROM dathang";
    $result = mysqli_query($conn, $sqlSoLuongDatHang);
    $dataSoLuongDatHang;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongDatHang = array(
            'tongdh' => $row['tongdh']
        );
    }
    echo json_encode($dataSoLuongDatHang);
?>