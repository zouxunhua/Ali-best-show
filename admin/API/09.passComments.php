<?php
    // 设置格式
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收数据
    $id = $_REQUEST['id'];
    // 准备sql语句
    $sql = " update comments set status='approved' where id in($id)";
    // 执行sql
    $rowNum = my_ZSG($sql);
    // 判断结果
    if($rowNum!=-1){
        $backData = array(
            'message'=>'恭喜你,通过啦'
        );
    }else{
        $backData = array(
            'message'=>'很遗憾,通不过'
        );
    }
    // 提示用户
    echo json_encode($backData);

?>