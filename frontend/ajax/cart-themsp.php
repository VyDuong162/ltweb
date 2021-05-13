<?php
  if(session_id()===''){
      session_start();
  }
    include_once(__DIR__ . '/../../dbconnect.php');
    $MSHH = $_POST['MSHH'];
    $TenHH = $_POST['TenHH'];
    $Gia = $_POST['Gia'];
    $SoLuong = $_POST['SoLuong'];
    $HinhAnh = $_POST['HinhAnh'];
    if(isset($_SESSION['cartdata'])){
        $data = $_SESSION['cartdata'];
        $data[$MSHH] = array(
            'MSHH' => $MSHH,
            'TenHH' => $TenHH,
            'Gia' => $Gia,
            'SoLuong' => $SoLuong,
            'HinhAnh' => $HinhAnh,
            'ThanhTien' =>  ($SoLuong * $Gia)
        );
        $_SESSION['cartdata'] = $data;
    }else{
        $data[$MSHH] =array(
            'MSHH' => $MSHH,
            'TenHH' => $TenHH,
            'Gia' => $Gia,
            'SoLuong' => $SoLuong,
            'HinhAnh' => $HinhAnh,
            'ThanhTien' => ($SoLuong * $Gia)
        );
        $_SESSION['cartdata'] = $data;
    }
    echo json_encode($_SESSION['cartdata']);