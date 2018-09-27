<?php
    // 设置格式
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收数据
    $slideData = $_REQUEST['slideData'];
    // 准备sql
    $sql = "update options set value = '$slideData' where id = 10";

    // 执行sql
    // 判断结果
    $rowNum = my_ZSG($sql);

     // 判断结果
     if($rowNum!=-1){
        $backData = array(
            'message'=>'恭喜你,搞定了哟'
        );
    }else{
        $backData = array(
            'message'=>'很遗憾,搞不定!!!o(╯□╰)o'
        );
    }
    // 提示用户
    echo json_encode($backData);
?>