<?php
    // 设置格式为json
    header('content-type:application/json;charset=utf-8');
    // header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 准备sql
    $sql = "select * from categories";
    // 调用函数 查询数据
    $data = my_SELECT($sql);
    // 返回json格式的数据
    // json_encode
    $backData = array(
        'items'=>$data
    );
    // 转化为json格式的字符串
    $jsonStr = json_encode($backData);
    // 返回字符串
    echo $jsonStr;
?>