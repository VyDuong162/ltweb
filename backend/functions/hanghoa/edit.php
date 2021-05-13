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
    <title>Smartphone | Hàng hóa</title>
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
                    $id_update = $_GET['MSHH'];
                    $sqlHH = "SELECT * FROM `hanghoa` where MSHH = '$id_update' ";
                    $resultHH = mysqli_query($conn, $sqlHH);
                    $dataHH = [];
                    while ($rowHH = mysqli_fetch_array($resultHH, MYSQLI_ASSOC)) {
                        $dataHH = array(
                            'MSHH' => $rowHH['MSHH'],
                            'TenHH' => $rowHH['TenHH'],
                            'QuyCach' => $rowHH['QuyCach'],
                            'Gia' => $rowHH['Gia'],
                            'SoLuongHang' => $rowHH['SoLuongHang'],
                            'GhiChu' => $rowHH['GhiChu'],
                            'HinhAnh' => $rowHH['HinhAnh'],
                            'MaLoaiHang' => $rowHH['MaLoaiHang'],
                        );
                    }
                    $sqlLHH = "SELECT * FROM `loaihanghoa`";
                    $result = mysqli_query($conn, $sqlLHH);
                    $dataLoaiHH = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $dataLoaiHH[] = array(
                            'MaLoaiHang' => $row['MaLoaiHang'],
                            'TenLoaiHang' => $row['TenLoaiHang'],
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
                                        <div class="card-title"> Chỉnh sửa hàng hóa </div>
                                    </div>
                                    <div class="card-body ">
                                        <form name="frmupdate" id="frmupdate" method="POST" action="#" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="MSHH">Mã hàng hóa</label>
                                                    <input type="text" class="form-control disabled" disabled name="MSHH" id="MSHH" value="<?= $dataHH['MSHH'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="tenHH">Tên hàng hóa</label>
                                                    <input type="text" class="form-control" name="tenHH" id="tenHH" value="<?= $dataHH['TenHH'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row">

                                                <div class="form-group col-md-6">
                                                    <label for="maLoaiHang">Loại hàng hóa</label>
                                                    <select name="maLoaiHang" id="maLoaiHang" class="form-select" required aria-label="select loại hàng hóa">
                                                        <?php foreach ($dataLoaiHH as $lhh) : ?>
                                                            <?php if ($dataHH['MaLoaiHang'] == $lhh['MaLoaiHang']) : ?>
                                                                <option value="<?= $lhh['MaLoaiHang'] ?>"><?= $lhh['TenLoaiHang'] ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">Vui lòng chọn loại hàng hóa</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="quyCach">Quy cách</label>
                                                    <input type="text" class="form-control" name="quyCach" id="quyCach" value="<?= $dataHH['QuyCach'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="gia">Gia</label>
                                                    <input type="number" class="form-control" name="gia" id="gia" value="<?= $dataHH['Gia'] ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="soLuongHang">Số lượng hàng</label>
                                                    <input type="number" class="form-control" name="soLuongHang" id="soLuongHang" value="<?= $dataHH['SoLuongHang'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="HinhAnh">Hình ảnh đại diện</label>
                                                    <input type="file" class="form-control" name="hh_avt_tenfile" id="hh_avt_tenfile" placeholder="tên file ảnh" >
                                                    <div class="preview-img-container col-sm-3 mt-1">
                                                        <?php if (!file_exists('../../../assets/uploads/img-product/' . $dataHH['HinhAnh']) || empty($dataHH['HinhAnh'])) : ?>
                                                            <img src="/ltweb/assets/shared/default.png" id="preview-img" class="img-fluid" width="100px">
                                                        <?php else : ?>
                                                            <img src="/ltweb/assets/uploads/img-product/<?= $dataHH['HinhAnh'] ?>" id="preview-img" class="img-fluid" width="100px" />
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="ghiChu">Ghi Chú</label><br>
                                                    <textarea name="ghiChu" id="ghiChu" cols="50" rows="5" placeholder="Mô tả ngắn hàng hóa"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <a href="index.php"><button type="button" class="btn btn-primary" style="margin-right: 10px; margin-left:10px">Trở về</button></a>
                                                <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['btnSave'])) {
                                            $tenHH = $_POST['tenHH'];
                                            $maLoaiHang = $_POST['maLoaiHang'];
                                            $quyCach = $_POST['quyCach'];
                                            $gia = $_POST['gia'];
                                            $soLuongHang = $_POST['soLuongHang'];
                                            $ghiChu = $_POST['ghiChu'];
                                            if (isset($_FILES['hh_avt_tenfile'])) {
                                                $upload_dir = __DIR__ . "/../../../assets/uploads/";
                                                $subdir = 'img-product/';
                                                if ($_FILES['hh_avt_tenfile']['error'] > 0) {
                                                    echo " <!>: error uploading the file!";
                                                    die;
                                                } else {
                                                        if(!empty($dataHH['HinhAnh'])){
                                                            $old_file = $upload_dir . $subdir . $dataHH['HinhAnh'];
                                                            if (file_exists($old_file)) {
                                                                unlink($old_file);
                                                            }
                                                        }
                                                        $tentaptin =date('YmdHis') . '_' . $_FILES['hh_avt_tenfile']['name'];
                                                        $hh_avt_tenfile = $tentaptin;
                                                        move_uploaded_file($_FILES['hh_avt_tenfile']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                                                }
                                            }
                                            $sqlSuaHH =<<<EOT
                                            UPDATE `hanghoa` 
                                            SET 
                                                TenHH = N'$tenHH',
                                                QuyCach = N'$quyCach',
                                                Gia = $gia,
                                                SoLuongHang = $soLuongHang,
                                                GhiChu = N'$ghiChu',
                                                MaLoaiHang = $maLoaiHang,
                                                HinhAnh = '$hh_avt_tenfile'
                                            WHERE
                                                MSHH = $id_update;
EOT;  
                                            //print_r($sqlSuaHH); die();
                                            mysqli_query($conn, $sqlSuaHH);
                                            mysqli_close($conn);
                                            echo '<script>location.href="index.php"</script>';
                                        }
                                        ?>

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
       const reader = new FileReader();
        const fileInput = document.getElementById("hh_avt_tenfile");
        const img = document.getElementById("preview-img");
        reader.onload = e =>{
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f =e.target.files[0];
            reader.readAsDataURL(f);
        })
        $(document).ready(function() {
            $('#frmupdate').validate({
                rules: {
                    tenHH: {
                        required: true,
                        maxlength: 50,
                    },
                    maLoaiHang: {
                        required: true,
                    },
                    quyCach: {
                        required: true,
                        maxlength: 50,
                    },
                    gia: {
                        required: true,
                        maxlength: 20,
                    },
                    soLuongHang: {
                        required: true,
                        maxlength: 5,
                    },
                    ghiChu: {
                        maxlength: 100,
                    },
                },
                messages: {
                    tenHH: {
                        required: "Bạn phải nhập tên hàng hóa",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                    maLoaiHang: {
                        required: "Bạn phải chọn loại hàng hóa ",
                    },
                    quyCach: {
                        required: "Bạn phải nhập quy cách ",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                    gia: {
                        required: "Bạn phải nhập giá tiền ",
                        maxlength: "Bạn đã nhập quá 20 số",
                    },
                    soLuongHang: {
                        required: "Bạn phải nhập số lượng hàng ",
                        maxlength: "Bạn đã nhập quá 5 số",
                    },
                    ghiChu: {
                        maxlength: "Bạn đã nhập quá 100 ký tự cho phép",
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>
</body>

</html>