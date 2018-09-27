<?php
    // 设置返回的格式
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收数据
    $slug = $_REQUEST['slug'];
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];
    // 准备sql
    $sql = "update categories set slug='$slug',name='$name' where id = $id";
    // 执行sql
    $rowNum = my_ZSG($sql);
    // 判断结果
    if($rowNum!=-1){
        $backData = array(
            'message'=>'编辑成功了哦 🐷'
        );
    }else{
        $backData = array(
            'message'=>'编辑失败了呀哦 👧'
        );
    }
    
    // 提示用户
    echo json_encode($backData);
?>