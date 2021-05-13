<?php
    if (session_id() === '') {
        session_start();
    }
    include_once(__DIR__ . '/../../dbconnect.php');
    if(isset($_SESSION['tendangnhap']) && $_SESSION['tendangnhap'] != NULL){
        unset($_SESSION['tendangnhap']);
        header('location:/ltweb/frontend/');die();
    }else{
        echo 'Bạn chưa đăng nhập tài khoản!';
        header('location:/ltweb/backend/auth/login.php');die();
    }
?>