<?php
    // 设置格式json
    header('content-type:application/json;charset=utf-8');
    // // 引入函数
    // include '../../tools/tools.php';
    // 接收文件(写死的文件名) 自己封装的函数 会保存文件原始的名字
    // my_move_upload_file('preview','../../uploads/');
    move_uploaded_file($_FILES['preview']['tmp_name'],'../../uploads/preview.jpg');
    // 返回图片地址 拼接上一个时间戳
    // echo '../../uploads/preview.jpg?'.time();
    $backData = array('url'=>'../../uploads/preview.jpg?'.time());

    echo json_encode($backData);
?>