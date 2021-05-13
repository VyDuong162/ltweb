<?php
    if (session_id() === '') {
        session_start();
    }
    include_once(__DIR__ . '/../../dbconnect.php');
    $sqlSelect = "SELECT * FROM `taikhoan`";
    $result = mysqli_query($conn,$sqlSelect);
    $dataUsername = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataUsername [] = array(
            'username' => $row['username'],
        );

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartphone | Đăng ký</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?><br>
    <link rel="stylesheet" href="/ltweb/assets/backend/css/style.css" type="text/css">
    <script>
        function check_register() {
            var hoten = document.getElementById('hoten').value;
            var tencongty = document.getElementById('tencongty').value;
            var sdt = document.getElementById('sdt').value;
            var email = document.getElementById('email').value;
            var tendangnhap = document.getElementById('username').value;
            var matkhau = document.getElementById('password').value;
            var nhaplaimatkhau = document.getElementById('password2').value;
            var error = '';
            if (hoten == '') {
                error += "Bạn phải nhập họ tên!\n";
            } else if (hoten.length > 50) {
                error += "Họ tên chứa tối đa 50 ký tự!\n";
            }
            if (tencongty == '') {
                error += "Bạn phải nhập tên công ty!\n";
            } else if (tencongty.length > 100) {
                error += "Tên công ty chứa tối đa 100 ký tự!\n";
            }
            if (sdt == '') {
                error += "Bạn phải nhập số điện thoại!\n";
            } else if (!sdt.match(/\d{10,10}/)) {
                error += "Số điện thoại phải chứa 10 số!\n";
            }
            if (email == '') {
                error += "Bạn phải nhập email!\n";
            } else if (!email.match(/^\w+@gmail.+\w/)) {
                error += "Email không hợp lệ phải chứa đuôi @gmail!\n";
            }
            if (tendangnhap == '') {
                error += "Bạn phải nhập tên đăng nhập!\n";
            } else if (tendangnhap.match(/\s/) !== null) {
                error += "Tên đăng nhập không chứa khoảng trống!\n";
            } else if (tendangnhap.length > 100) {
                error += "Tên đăng nhập chứa tối đa 100 ký tự!\n";
            }
            if (matkhau == '') {
                error += "Bạn phải nhập mật khẩu!\n";
            } else if ((matkhau.length < 8) && (matkhau.length > 100)) {
                error += "Mật khẩu chứa ít nhất 8 ký tự và tối đa 100 ký tự!\n";
            }
            if (nhaplaimatkhau == '') {
                error += "Bạn phải nhập lại mật khẩu!\n";
            } else if (nhaplaimatkhau !== matkhau) {
                error += "Không khớp với mật khẩu trên!\n";
            }
            if (error !== '') {
                alert(error);
                return false;
            }
        }
       
    </script>
</head>

<body id="auth-body">
    <div class="auth-container">
        <!-- form đăng ký -->
        <form id="frmauth" name="frmauth" action="" method="post" enctype="multipart/form-data">
            <div class="auth-header">
                <h3 class="auth-heading">Đăng ký</h3>
                <a href="login.php" style="text-decoration: none;"><span class="auth-switch-btn">Đăng nhập</span></a>
            </div>
            <div class="auth-form">
                <div class="form-group">
                    <label for="hoten">Họ Tên</label><br>
                    <input type="text" class="form-control form-edit" name="hoten" id="hoten" placeholder="Họ tên" required>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="tencongty">Tên công ty</label><br>
                    <input type="text" class="form-control" name="tencongty" id="tencongty" placeholder="Tên công ty" required>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-group" style="display: flex;">
                    <div class="col-md-6">
                        <label for="sdt">Số điện thoại</label>
                        <input type="tel" class="form-control" name="sdt" id="sdt" placeholder="Số điện thoại" required>
                        <div class="valid-feedback"></div>
                    </div>
                    <div class="col-md-6" style="margin-left:5px;">
                        <label for="emai">Email</label>
                        <input type="Email" class="form-control" name="email" id="email" placeholder="Email" required>
                        <div class="valid-feedback"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập của bạn" required>
                </div>
                <div class="form-group" style="display: flex;">
                    <div class="col-md-6" style="margin-left:5px;">
                        <label for="password">Mật khẩu</label>
                        <input type="Password" class="form-control" name="password" id="password"  placeholder="Mật khẩu" required>
                        <div class="show-pwd" id="show-pwd">
                            <i class="fas fa-eye"></i>
                            <i class="fa fa-eye-slash hide" aria-hidden="true"></i>
                        </div>
                        <div class="valid-feedback"></div>
                    </div>
                    <div class="col-md-6" style="margin-left:5px;">
                        <label for="password2">Nhập lại mật khẩu</label>
                        <input type="Password" class="form-control" name="password2" id="password2" placeholder="Nhập lại mật khẩu" required>
                        <div class="show-pwd" id="show-pwd-2">
                            <i class="fas fa-eye"></i>
                            <i class="fa fa-eye-slash hide" aria-hidden="true"></i>
                        </div>
                        <div class="valid-feedback"></div>
                    </div>
                </div>
                <div class="form-group auth-control">
                    <button class="btn btn-register" name="btn-register" id="btn-register" onclick="check_register();">Đăng ký</button>
                </div>
            </div>
            <hr>
            <div class="auth-socials">
                <a href="#" class="btn btn-facebook btn-icon"><i class="fab fa-facebook fa-1x"></i><span class="auth-socials-title">Facebook</span></a>
                <a href="#" class="btn btn-google btn-icon"><img src="/ltweb/assets/shared/google.png" height="24px" alt="logo-google" style="vertical-align: sub;"><span class="auth-socials-title">Google</span></a>
            </div>
        </form>
        <?php
        if (isset($_POST['btn-register'])) {
            $hoten = $_POST['hoten'];
            $tencongty = $_POST['tencongty'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $tendangnhap = $_POST['username'];
            $matkhau = md5($_POST['password']);
            $vaitro = 'user';
            $sqlThemTaiKhoan = "INSERT INTO taikhoan (`username`, `password`, `vaitro`) VALUES ('$tendangnhap','$matkhau','$vaitro');";
            $resultTTK = mysqli_query($conn, $sqlThemTaiKhoan);
            $sqlThemKH = "INSERT INTO khachhang (HoTenKH, TenCongTy, SoDienThoai, Email, username) VALUES (N'$hoten', N'$tencongty', '$sdt','$email','$tendangnhap');";
            $resultTKH= mysqli_query($conn, $sqlThemKH);
            mysqli_close($conn);
            if($resultTTK  && $resultTKH){
                echo '<script>alert("Đăng ký thành công!"); location.href="login.php"</script>';
                die();
            }else{
                echo '<script>alert("Đăng ký thất bại!"); location.href="register.php"</script>';
                die();
            }
        }
        ?>
    </div>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/vendor/jquery-validation/localization/messages_vi.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#frmauth').validate({
                rules: {
                    hoten: {
                        required: true,
                        maxlength: 50,
                    },
                    tencongty: {
                        required: true,
                        maxlength: 100,
                    },
                    sdt: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    email: {
                        required: true,
                        
                    },
                    username: {
                        required: true,
                        minlength: 5,
                        maxlength: 100,
                    },
                    password: {
                        required: true,
                        maxlength: 8,
                        maxlength: 16,
                    },
                    password2: {
                        required: true,
                        maxlength: 100,
                        equalTo: "#password"
                    },
                },
                messages: {
                    hoten: {
                        required: "Bạn phải nhập họ tên",
                        maxlength: "Họ tên chứa tối đa 50 ký tự",
                    },
                    tencongty: {
                        required: "Bạn phải nhập tên công ty",
                        maxlength: "Họ tên chứa tối đa 10 ký tự",
                    },
                    sdt: {
                        required: "Bạn phải nhập số điện thoại",
                        minlength: "Số điện thoại chứa 10 số",
                        maxlength: "Số điện thoại chứa 10 số",
                    },
                    email: {
                        required: "Bạn phải nhập email",
                        
                    },
                    username: {
                        required: "Bạn phải nhập tên đăng nhập",
                        minlength: "Tên đăng nhập ít nhất 5 ký tự",
                        maxlength: "Tên đăng nhập tối đa 100 ký tự",
                    },
                    password: {
                        required: "Bạn phải nhập mật khẩu",
                        minlength: "Mật khẩu ít nhất 8 ký tự",
                        maxlength: "Mật khẩu tối đa 16 ký tự",
                    },
                    password2: {
                        required: "Bạn phải nhập lại mật khẩu",
                        equalTo: "Không khớp với mật khẩu trên",
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
                success: function(label, element) {
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }

            });
            $('#show-pwd').click(function(){
                var p = document.getElementById('password');
                var type_p = p.type;
                if(type_p == 'password'){
                    $('#show-pwd .fa-eye-slash').removeClass('hide');
                    $('#show-pwd .fa-eye').addClass('hide');
                    p.setAttribute('type','text');
                    
                }else{
                    $('#show-pwd .fa-eye-slash').addClass('hide');
                    $('#show-pwd .fa-eye').removeClass('hide');
                    p.setAttribute('type','password');
                    
                }
            });
            $('#show-pwd-2').click(function(){
                var p = document.getElementById('password2');
                var type_p = p.type;
                if(type_p == 'password'){
                    $('#show-pwd-2 .fa-eye-slash').removeClass('hide');
                    $('#show-pwd-2 .fa-eye').addClass('hide');
                    p.setAttribute('type','text');
                    
                }else{
                    $('#show-pwd-2 .fa-eye-slash').addClass('hide');
                    $('#show-pwd-2 .fa-eye').removeClass('hide');
                    p.setAttribute('type','password');
                    
                }
            });
        });
    </script>
</body>

</html>