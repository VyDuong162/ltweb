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
    <title>Smartphone | Khách hàng</title>
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
                        $sql ="SELECT * FROM `nhanvien`";
                        $result = mysqli_query($conn, $sql);
                        $dataNhanVien = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $dataNhanVien[] = array(
                                'MSNV' => $row['MSNV'],
                                'HoTenNV' => $row['HoTenNV'],
                                'ChucVu' => $row['ChucVu'],
                                'DiaChi' => $row['DiaChi'],
                                'SoDienThoai' => $row['SoDienThoai'],
                                'username' => $row['username'],
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
                                        <div class="card-title"> Thêm mới nhân viên </div>
                                    </div>
                                    <div class="card-body ">
                                        <form name="frmcreate" id="frmcreate" method="POST" action="#" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="HoTenNV">Họ tên nhân viên</label>
                                                    <input type="text" class="form-control" name="HoTenNV" id="HoTenNV" placeholder="Họ tên" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="ChucVu">Chức vụ</label>
                                                    <input type="text" class="form-control" name="ChucVu" id="ChucVu" placeholder="Chức vụ">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="SoDienThoai">Số điện thoại</label>
                                                    <input type="tel" class="form-control" name="SoDienThoai" id="SoDienThoai" placeholder="Số điện thoại liên hệ">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="DiaChi">Địa chỉ</label>
                                                    <input type="tel" class="form-control" name="DiaChi"  id="DiaChi" placeholder="Địa chỉ nơi ở">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary">Trở về</button>
                                            <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Lưu dữ liệu</button>
                                        </form>
                                        <?php
                                            if(isset($_POST['btnSave'])){
                                                $HoTenNV = $_POST['HoTenNV'];
                                                $ChucVu = $_POST['ChucVu'];
                                                $soDienThoai = $_POST['SoDienThoai'];
                                                $DiaChi = $_POST['DiaChi'];
                                                $username = $_POST['username'];
                                                $password = $_POST['password'];
                                                $vaitro ='nhân viên';
                                                $sqlThemNV = "INSERT INTO `nhanvien` (HoTenNV, ChucVu, SoDienThoai, DiaChi, username) VALUES (N'$HoTenNV', N'$ChucVu', '$SoDienThoai','$DiaChi','$username');";
                                                mysqli_query($conn, $sqlThemNV);
                                                $MSNV = $conn->insert_id;
                                                $sqlThemTaiKhoan = "INSERT INTO `taikhoan` (`username`, `password`, `vaitro`) VALUES ('$username','$password','$vaitro');";
                                                mysqli_query($conn, $sqlThemTaiKhoan);
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
        $(document).ready(function(){
            $('#frmcreate').validate({
                rules: {
                    HoTenNV: {
                        required: true,
                        maxlength: 50,
                    },
                    ChucVu: {
                        required: true,
                        maxlength: 50,
                    },
                    SoDienThoai: {
                        required: true,
                        minlength:10,
                        maxlength: 10,
                    },
                    DiaChi: {
                        required: true,
                        maxlength: 100,
                    },
                    username: {
                        required: true,
                        maxlength: 100,
                    },
                    password: {
                        required: true,
                        maxlength: 100,
                    },
                },
                messages: {
                    HoTenNV: {
                        required: "Bạn phải nhập họ tên khách hàng",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                    ChucVu: {
                        required: "Bạn phải nhập chức vụ ",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                    SoDienThoai: {
                        required: "Bạn phải nhập số điện thoại ",
                        minlength:"Bạn đã nhập ít hơn 10 ký tự cho phép",
                        maxlength: "Bạn đã nhập quá 10 ký tự cho phép",
                    },
                    DiaChi: {
                        required:  "Bạn phải nhập địa chỉ ",
                        maxlength: "Bạn đã nhập quá 100 ký tự cho phép",
                    },
                    username: {
                        required:  "Bạn phải nhập username ",
                        maxlength: "Bạn đã nhập quá 100 ký tự cho phép",
                    },
                    password: {
                        required:  "Bạn phải nhập password ",
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