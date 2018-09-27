<?php
    // 设置返回的格式
    header('content-type:application/json;charset=utf-8');
    // 工作时  后台开发人员一般会设置这个头
    // header('content-type:text/xml;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收数据
    $slug = $_REQUEST['slug'];
    $name = $_REQUEST['name'];
    // 准备sql
    $sql = "insert into categories (slug,name) values('$slug','$name')";
    // 执行sql
    $rowNum = my_ZSG($sql);
    // 判断结果
    if($rowNum!=-1){
        $backData = array(
            'message'=>'新增成功了哦 🐷'
        );
    }else{
        $backData = array(
            'message'=>'新增失败了呀哦 👧'
        );
    }
    
    // 提示用户
    echo json_encode($backData);
?>