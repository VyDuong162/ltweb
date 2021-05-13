<?php
    include_once(__DIR__ . '/../../dbconnect.php');
    $sqlSoLuongHangHoa ="SELECT COUNT(*) AS tongsp FROM hanghoa";
    $result = mysqli_query($conn, $sqlSoLuongHangHoa);
    $dataSoLuongHangHoa;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongHangHoa = array(
            'tongsp' => $row['tongsp']
        );
    }
    echo json_encode($dataSoLuongHangHoa);
?>