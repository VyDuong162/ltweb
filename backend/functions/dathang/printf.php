<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smartphone | In hóa đơn</title>
    <!-- Paper CSS -->
    <link rel="stylesheet" href="/ltweb/assets/vendor/paper-css/paper.css" type="text/css" />
    <!-- Định khổ giấy: A5, A4 or A3 -->
    <style>
        @page {
            size: A4
        }
    </style>
</head>

<body class="A4">
    <?php
        $idHD=$_GET['id'];
        $sqlDatHang =<<<EOT
        SELECT dh.SoDonDH, dh.NgayDH, dh.NgayGH, dh.NgayGH, kh.HoTenKH, kh.SoDienThoai, dc.DiaChi, nv.MSNV, nv.HoTenNV
        FROM `dathang` dh 
        JOIN `nhanvien` nv ON dh.MSNV = nv.MSNV
        JOIN `khachhang` kh ON dh.MSKH = kh.MSKH
        JOIN `diachikh` dc ON dh.MSKH = dc.MSKH
        WHERE dh.SoDonDH = '$idHD';
EOT;
        $resultDH = mysqli_query($conn, $sqlDatHang);
        $dataDatHang = [];
        while( $rowDH = mysqli_fetch_array($resultDH, MYSQLI_ASSOC)){
            $dataDatHang = array(
                'SoDonDH' => $rowDH['SoDonDH'], 
                'NgayDH' => date('d-m-Y H:i:s', strtotime($rowDH['NgayDH'])), 
                'NgayGH' => date("d-m-Y H:i:s",strtotime($rowDH['NgayGH'])), 
                'HoTenKH' => $rowDH['HoTenKH'], 
                'SoDienThoai' => $rowDH['SoDienThoai'], 
                'DiaChi' => $rowDH['DiaChi'], 
                'MSNV' => $rowDH['MSNV'], 
                'HoTenNV' => $rowDH['HoTenNV'],
            );
        };
        $sqlChiTietDH =<<<EOT
        SELECT hh.MSHH, hh.TenHH, ct.SoLuong, ct.GiaDatHang, ct.GiamGia
        FROM `chitietdathang` ct, `hanghoa` hh
        WHERE 
            ct.SoDonDH=$idHD
        AND
            ct.MSHH = hh.MSHH
EOT;
        $resultCTDH = mysqli_query($conn, $sqlChiTietDH);
        $dataCTDH = [];
        while( $rowCTDH = mysqli_fetch_array($resultCTDH, MYSQLI_ASSOC)){
            $dataCTDH[] = array(
                'MSHH' => $rowCTDH['MSHH'],
                'TenHH' => $rowCTDH['TenHH'],
                'SoLuong' => $rowCTDH['SoLuong'],
                'GiaDatHang' => $rowCTDH['GiaDatHang'],
                'GiamGia' => $rowCTDH['GiamGia']
            );
        }
        $dataDatHang['sanpham'] =$dataCTDH;
    ?>
    
    <section class="sheet padding-10mm"  style="margin: auto;">
        <!-- Thông tin về Cửa hàng -->
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td align="center"><img src="/ltweb/assets/shared/logo.png" alt="logo" height="100px"></td>
                    <td align="center">
                        <b style="font-size: 2em;">Smartphone - Đồng hành cùng bạn</b><br />
                        <small>Cung cấp các mẫu điện thoại đa dạng </small><br />
                        <small>Mang đến bạn những trãi nghiệm mới với công nghệ mới nhất</small>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Thông tin về đơn hàng -->
        <p><i><u>Thông tin Đơn hàng</u></i></p>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%">Khách hàng:</td>
                    <td><b><?= $dataDatHang['HoTenKH'] ?></b>
                            - Liên hệ: <b><?= $dataDatHang['SoDienThoai'] ?></b></td>
                </tr>
                <tr>
                    <td>Ngày đặt hàng:</td>
                    <td><b><?= $dataDatHang['NgayGH'] ?></b></td>
                </tr>
                <tr>
                    <td>Ngày giao hàng:</td>
                    <td><b><?= $dataDatHang['NgayGH'] ?></b></td>
                </tr>
                <tr>
                    <td>Địa chỉ nhận:</td>
                    <td><b><?= $dataDatHang['DiaChi'] ?></b></td>
                </tr>
            </tbody>
        </table>
        <!-- Thông tin về hàng hóa -->
        <p><i><u>Chi tiết đơn hàng</u></i></p>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Giảm giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                $tongtien =0;
                ?>
                <?php foreach ($dataDatHang['sanpham'] as $sp) : ?>
                    <tr>
                        <?php $tongtien += $sp['SoLuong'] * $sp['GiaDatHang'] ?>
                        <td align="center"><?= $stt; ?></td>
                        <td align="left"><?= $sp['TenHH'] ?></td>
                        <td align="right"><?= $sp['SoLuong'] ?></td>
                        <td align="right"><?= number_format($sp['GiaDatHang'], 0, ".", ",") ?></td>
                        <td align="right"><?= number_format($sp['GiamGia']*100, 0, ".", ",")."%" ;?></td>
                        <td align="right"><?= number_format(($sp['SoLuong'] * $sp['GiaDatHang'])-($sp['GiaDatHang']*$sp['GiamGia']), 0, ".", ",")  ?></td>
                    </tr>
                    <?php $stt++; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" align="right"><b>Tổng thành tiền</b></td>
                    <td align="right"><b><?= number_format($tongtien, 0, ".", ",")?></b></td>
                </tr>
            </tfoot>
        </table>
        <!-- Thông tin Footer -->
        <br />
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td align="center">
                        <small>Xin cám ơn Quý khách đã ủng hộ Cửa hàng, Chúc Quý khách An Khang, Thịnh Vượng!</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>