<?php 
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
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
        function check_login() {
            var tendangnhap = document.getElementById('username').value;
            var matkhau = document.getElementById('password').value;
            var error = '';
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
            if (error !== '') {
                alert(error);
                return false;
            }
        }
        function thongbao1() {
                document.getElementById("notice").style.display = 'block';
                notice.innerHTML += "Đăng nhập thành công!";
        };
        function thongbao2() {
                var n = document.getElementById("notice");
                n.classList.remove('alert-success');   
                document.getElementById("notice").style.display = 'block';
                notice.innerHTML += "Đăng nhập thất bại! Refresh F5 lại ";
                n.classList.add('alert-danger');
        };

    </script>
</head>

<body id="auth-body">
    <div class="auth-container">
        <!-- form đăng ký -->
        <form id="frmauth" name="frmauth" action="" method="post" enctype="multipart/form-data">
            <div id="notice" class="alert alert-success alert-dismissible fade show my-alert hide" role="alert" style="margin-top: 10px; margin-bottom: 10px;">
                    
            </div>
            <div class="auth-header">
                <h3 class="auth-heading">Đăng nhập</h3>
                <a href="/ltweb/backend/auth/register.php" style="text-decoration: none;"><span class="auth-switch-btn">Đăng ký</span></a>
            </div>
            <div class="auth-form">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập của bạn" required>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="Password" class="form-control" name="password" id="password" placeholder="Mật khẩu" required>
                    <div class="show-pwd" id="show-pwd">
                        <i class="fas fa-eye"></i>
                        <i class="fa fa-eye-slash hide" aria-hidden="true"></i>
                    </div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-group auth-control">
                    <button class="btn btn-login" name="btn-login" id="btn-login" onclick="check_login();">Đăng nhập</button>
                </div>
            </div>
            <div class="forget-pwd">
                <a href="#">Quên mật khẩu</a>
            </div>
            <hr>
        </form>
        <?php
        if (isset($_POST['btn-login'])) {
            $tendangnhap = $_POST['username'];
            $matkhau = md5($_POST['password']);
            $selectThongTin = "SELECT * FROM `khachhang` kh,`taikhoan` tk,`nhanvien` nv WHERE tk.username = '$tendangnhap' AND tk.password = '$matkhau' AND (kh.username = tk.username OR nv.username =tk.username)";
            $resultThongTin = mysqli_query($conn, $selectThongTin);
            if(mysqli_num_rows($resultThongTin) > 0){
                $data = mysqli_fetch_array($resultThongTin,MYSQLI_ASSOC);
                $_SESSION['MSKH'] = $data['MSKH'];
                $_SESSION['tendangnhap'] = $tendangnhap;
                $_SESSION['HoTenKH'] = $data['HoTenKH'];
                $_SESSION['vaitro'] = $data['vaitro'];
                if($_SESSION['vaitro']== 'user'){
                    echo '<script> thongbao1(); location.href = "/ltweb/frontend/index.php"</script>';
                }else{
                    echo '<script> thongbao1(); location.href = "/ltweb/backend/dashboard.php"</script>';
                }
            }else{
                echo '<script> thongbao2(); setTimeout(function(){location.href="/ltweb/backend/auth/login.php", 10000} );</script>';
            }
        }
        ?>
    </div>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#frmauth').validate({
                rules: {
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
                },
                messages: {
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
        });
    </script>
</body>

</html>