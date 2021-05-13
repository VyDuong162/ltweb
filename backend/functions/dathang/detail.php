<?php
    if(session_id() === ''){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartphone | Đặt hàng</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?><br>
    <link rel="stylesheet" href="/ltweb/assets/backend/css/style.css" type="text/css">
</head>

<body>
    <div class="dash">
        <div class="container-fluid">
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <div class="row">
                <div class="col">
                    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
                </div>
                <main class="main">
                    <?php
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $id_detail = $_GET['id'];
                    $sqlDH = "SELECT * FROM `dathang` WHERE SoDonDH = '$id_detail'";
                    $resultDH = mysqli_query($conn, $sqlDH);
                    $dataDH = [];
                    while ($rowDH = mysqli_fetch_array($resultDH, MYSQLI_ASSOC)) {
                        $dataDH = array(
                            'SoDonDH' => $rowDH['SoDonDH'],
                            'MSNV' => $rowDH['MSNV'],
                            'MSKH' => $rowDH['MSKH'],
                            'NgayDH' => $rowDH['NgayDH'],
                            'NgayGH' => $rowDH['NgayGH'],
                            'TrangThai' => $rowDH['TrangThai'],
                        );
                    }
                    $sqlCTDH = "SELECT * FROM `chitietdathang` a LEFT JOIN `hanghoa` b ON a.MSHH = b.MSHH WHERE SoDonDH = '$id_detail'";
                    $resultCTDH = mysqli_query($conn, $sqlCTDH);
                    $dataCTDH = [];
                    while ($rowCTDH = mysqli_fetch_array($resultCTDH, MYSQLI_ASSOC)) {
                        $dataCTDH[] = array(
                            'MSHH' => $rowCTDH['MSHH'],
                            'TenHH' => $rowCTDH['TenHH'],
                            'SoLuong' => $rowCTDH['SoLuong'],
                            'GiaDatHang' => $rowCTDH['GiaDatHang'],
                            'GiamGia' => $rowCTDH['GiamGia'],
                        );
                    }
                    $sqlKH = "SELECT * FROM `khachhang` ";
                    $resultKH = mysqli_query($conn, $sqlKH);
                    $dataKH = [];
                    while ($rowKH = mysqli_fetch_array($resultKH, MYSQLI_ASSOC)) {
                        $khtomtat = sprintf("%s, %s", $rowKH['HoTenKH'], $rowKH['SoDienThoai']);
                        $dataKH[] = array(
                            'MSKH' => $rowKH['MSKH'],
                            'khtomtat' => $khtomtat,
                        );
                    }
                    $sqlNV = "SELECT * FROM `nhanvien`";
                    $resultNV = mysqli_query($conn, $sqlNV);
                    $dataNV = [];
                    while ($rowNV = mysqli_fetch_array($resultNV, MYSQLI_ASSOC)) {
                        $nvtomtat = sprintf(" MSNV: %s - %s", $rowNV['MSNV'], $rowNV['HoTenNV']);
                        $dataNV[] = array(
                            'MSNV' => $rowNV['MSNV'],
                            'nvtomtat' => $nvtomtat,
                        );
                    }
                    $sqlDCKH = "SELECT * FROM `diachikh` ";
                    $resultDCKH = mysqli_query($conn, $sqlDCKH);
                    $dataDCKH = [];
                    while ($rowDCKH = mysqli_fetch_array($resultDCKH, MYSQLI_ASSOC)) {
                        $dataDCKH[] = array(
                            'MaDC' => $rowDCKH['MaDC'],
                            'DiaChi' => $rowDCKH['DiaChi'],
                            'MSKH' => $rowDCKH['MSKH'],
                        );
                    }
                    ?>
                    <div class="container">
                        <div class="row p-1 m-1">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="card-title"> Chi tiết đơn hàng</div>
                                    </div>
                                    <div class="card-body ">
                                        <form name="frmdetail" id="frmdetail" method="POST" action="#" enctype="multipart/form-data">
                                            <fieldset id="fs_donhang">
                                                <legend>Thông Tin đơn hàng</legend>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="SoDonDH">Mã hóa đơn</label>
                                                        <input type="text" class="form-control disabled" disabled name="SoDonDH" id="SoDonDH" value="<?= $dataDH['SoDonDH'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-9">
                                                        <label for="MSNV">Nhân viên tiếp nhận</label>
                                                        <?php foreach ($dataNV as $nv) : ?>
                                                            <?php if ($dataDH['MSNV'] == $nv['MSNV']) : ?>
                                                                <input type="text" class="form-control disabled" disabled name="MSNV" id="MSNV" value="<?= $nv['nvtomtat'] ?>">
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 col-xl-12">
                                                        <label for="MSKH">Thông tin khách hàng</label>
                                                        <?php foreach ($dataKH as $kh) : ?>
                                                            <?php if ($dataDH['MSKH'] == $kh['MSKH']) : ?>
                                                                <input type="text" class="form-control disabled" disabled name="MSKH" id="MSKH" value="<?= $kh['khtomtat'] ?>">
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="NgayDH">Ngày đặt hàng</label>
                                                        <input type="text" class="form-control disabled" disabled name="NgayDH" id="NgayDH" value="<?= $dataDH['NgayDH'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="NgayGH">Ngày giao hàng</label>
                                                        <input type="text" class="form-control disabled" disabled name="NgayGH" id="NgayGH" value="<?= $dataDH['NgayGH'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 col-xl-12">
                                                        <label for="DiaChiKH">Địa chỉ khách hàng</label>
                                                        <?php foreach ($dataDCKH as $dckh) : ?>
                                                            <?php if ($dataDH['MSKH'] == $dckh['MSKH']) : ?>
                                                                <input type="text" class="form-control disabled" disabled name="DiaChiKH" id="DiaChiKH" value="<?= $dckh['DiaChi'] ?>">
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="TrangThai">Trạng thái đơn hàng</label> <br>
                                                        <?php if ($dataDH['TrangThai'] == 0) : ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="TrangThai" id="TrangThai-0" value="0" checked>
                                                                <label class="form-check-label" for="TrangThai-0">Chưa xử lý</label>
                                                            </div>
                                                            <?php elseif($dataDH['TrangThai'] == 1) : ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="TrangThai" id="TrangThai-1" value="1" checked>
                                                                <label class="form-check-label" for="TrangThai-1">Đã xác nhận</label>
                                                            </div>
                                                            <?php elseif($dataDH['TrangThai'] == 2) : ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="TrangThai" id="TrangThai-2" value="2" checked>
                                                                <label class="form-check-label" for="TrangThai-2">Đã giao</label>
                                                            </div>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset id="fs_chitietdh">
                                                <legend>Thông tin chi tiết đơn hàng</legend>
                                                <table id="tbl_chitietdh" class="table table-borderd">
                                                    <thead class="text-center align-middle">
                                                        <th>Sản phẩm</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Giảm giá</th>
                                                        <th>Thành tiền</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($dataCTDH as $ctdh) : ?>
                                                            <tr class="text-center align-middle">
                                                                <td><?= $ctdh['TenHH'] ?></td>
                                                                <td><?= $ctdh['SoLuong'] ?></td>
                                                                <td><?= number_format($ctdh['GiaDatHang'], 0, ".", ",") . "VND"; ?></td>
                                                                <td><?php if( !empty( $ctdh['GiamGia'] )) : ?>
                                                                        <?= number_format($ctdh['GiamGia'] * 100) ."%";?> 
                                                                    <?php else : ?>
                                                                        <?=''?> 
                                                                    <?php endif;?>
                                                                </td>
                                                                <td><?= number_format(($ctdh['GiaDatHang'] * $ctdh['SoLuong']) - ($ctdh['GiaDatHang'] * $ctdh['GiamGia']),0, ".", ",") . "VND"; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                            <div class="form-row">
                                                <a href="index.php"><button type="button" class="btn btn-primary" style="margin-right: 10px; margin-left:10px">Trở về</button></a>
                                                <a href="printf.php?id=<?= $id_detail ?>" class="btn btn-secondary btn-xl" data-bs-toggle="tooltip" data-bs-placement="top" title="In"><i class="fas fa-print"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/backend/js/app.js" type="text/javascript"></script>
    <script>

    </script>
</body>

</html>