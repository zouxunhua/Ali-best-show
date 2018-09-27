<?php
    // 设置格式为json
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收id
    $id = $_REQUEST['id'];
    // 根据id查询文章
    $sql = "select * from posts where id = $id";
    // echo $sql;
    $data = my_SELECT($sql);
    // 返回给用户
    $backdata = array(
        'data'=>$data
    );
    echo json_encode($backdata);

?>