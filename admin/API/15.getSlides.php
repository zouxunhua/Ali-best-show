<?php
    // 返回轮播图信息

    // 设置json格式
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 准备sql语句
    $sql = "select * from options where id = 10";
    // 查询数据
    $data = my_SELECT($sql);
    // var_dump 会返回数据类型
    // var_dump($data[0][2]);
    // 返回数据
    echo $data[0][2];
?>
   



