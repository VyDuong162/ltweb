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
    <link rel="stylesheet" href="/ltweb/assets/vendor/DataTables/datatables.min.css">
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
                    $sql = "SELECT * FROM `khachhang`";
                    $result = mysqli_query($conn, $sql);
                    $dataKhachHang = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $dataKhachHang[] = array(
                            'MSKH' => $row['MSKH'],
                            'HoTenKH' => $row['HoTenKH'],
                            'TenCongTy' => $row['TenCongTy'],
                            'SoDienThoai' => $row['SoDienThoai'],
                            'Email' => $row['Email'],
                            'username' => $row['username'],
                        );
                    }
                    ?>
                    <div class="container">
                        <div class="row p-1 m-1">
                            <div class="col-md-12 mb-3">
                                <a href="create.php"><button type="button" class="btn btn-primary">Thêm mới</button></a>
                            </div>
                        </div>
                        <div class="row p-1 m-1">
                            <div class="col-xl-12 ml-20">
                                <div class="card shadow mb-4">
                                    <div class="card-header">
                                        <h1 class="h2 text-gray-800 text-center m-20 font-weight-bold text-primary">Danh sách khách hàng</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="tbdanhsach" class="table table-striped">
                                                <thead class="thead-dark " style="background-color:deepskyblue">
                                                    <tr class=" text-left">
                                                        <th class="align-middle">#</th>
                                                        <th class="align-middle">Mã khách hàng</th>
                                                        <th class="align-middle">Tên khách hàng</th>
                                                        <th class="align-middle">Tên công ty</th>
                                                        <th class="align-middle">Số điện thoại</th>
                                                        <th class="align-middle">Email</th>
                                                        <th class="align-middle">Tài khoản</th>
                                                        <th class="align-middle">Thực thi</th>
                                                    </tr>
                                                </thead>
                                                <?php $i=1 ?>
                                                <tbody>
                                                    <?php foreach ($dataKhachHang as $kh) : ?>
                                                        <tr>
                                                            <td class=""><?php echo $i; ?></td>
                                                            <td class="align-middle"><?php echo $kh['MSKH']; ?></td>
                                                            <td class="align-baseline"><?php echo $kh['HoTenKH']; ?></td>
                                                            <td class="align-baseline"><?php echo $kh['TenCongTy']; ?></td>
                                                            <td class="align-middle"><?php echo $kh['SoDienThoai']; ?></td>
                                                            <td class="align-baseline"><?php echo $kh['Email']; ?></td>
                                                            <td class="align-baseline"><?php echo $kh['username']; ?></td>
                                                            <td class="">
                                                                <a href="edit.php?MSKH=<?php echo $kh['MSKH'];?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa">
                                                                    <i class="fas fa-pencil-alt fa-sm" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btnDelete btn-sm" data-idxoa = <?php echo $kh['MSKH']; ?> bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                                    <i class="fas fa-trash-alt fa-sm" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
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
    <script src="/ltweb/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/ltweb/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/backend/js/app.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
        
        $(document).ready(function() {
            $('#tbdanhsach').DataTable({
                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    },
                    buttons: {
                        "copy": "Sao chép",
                        "excel": "Xuất ra file Excel",
                        "pdf": "Xuất ra file PDF",
                    }
                },
                "lengthMenu": [
                    [5,10, 15, 20, 25, 50, 100, -1],
                    [5,10, 15, 20, 25, 50, 100, "Tất cả"]
                ]
            });
        });
        $('.btnDelete').click(function() {
            swal({
                    title: "Bạn có chắn chắn xóa không?",
                    text: "Không thể phục hồi dữ liệu khi xóa!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var MSKH = $(this).data('idxoa');
                        var url = 'delete.php?idxoa=' + MSKH;
                        location.href = url;
                    } else {
                        swal("Hủy xóa thành công!");
                    }
                });
        });
    </script>
</body>
</html>