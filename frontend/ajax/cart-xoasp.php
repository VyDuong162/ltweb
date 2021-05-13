<?php
    if(session_id()===''){
        session_start();
    }
    include_once(__DIR__ . '/../../dbconnect.php');
    $MSHH = $_POST['MSHH'];
    if(isset($_SESSION['cartdata'])){
        $data = $_SESSION['cartdata'];

        if(isset($data[$MSHH])){
            unset($data[$MSHH]);
        }
       $_SESSION['cartdata'] = $data; 
    }
    echo json_encode($_SESSION['cartdata']);
