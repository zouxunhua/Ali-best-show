<?php
    // 设置格式json
    header('content-type:application/json;charset=utf-8');
    // // 引入函数
    include '../../tools/tools.php';
    // 接收文件 使用图片原始的名字 并返回
    $iconName = my_move_upload_file('icon','../../uploads/');
    
    // 返回图片地址 拼接上一个时间戳
    // echo '../../uploads/preview.jpg?'.time();
    $backData = array('url'=>'/uploads/'.$iconName);

    echo json_encode($backData);
?>