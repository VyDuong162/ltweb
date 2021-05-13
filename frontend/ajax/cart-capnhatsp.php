<?php
    if(session_id()===''){
        session_start();
    }
    include_once(__DIR__ . '/../../dbconnect.php');
    $MSHH = $_POST['MSHH'];
    $SoLuong = $_POST['SoLuong'];
    if(isset($_SESSION['cartdata'])){
        $data = $_SESSION['cartdata'];
        $item_product = $data[$MSHH];
        $data[$MSHH] = array(
            'MSHH' => $item_product['MSHH'],
            'TenHH' => $item_product['TenHH'],
            'SoLuong' => $SoLuong,
            'Gia' => $item_product['Gia'],
            'HinhAnh' => $item_product['HinhAnh'],
            'ThanhTien' => ($SoLuong * $item_product['Gia']),
        );
        $_SESSION['cartdata'] = $data;
    }
    echo json_encode($_SESSION['cartdata']);
