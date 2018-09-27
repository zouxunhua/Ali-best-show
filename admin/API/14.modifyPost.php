<?php
header('content-type:application/json;charset=utf-8');
  // 引入函数
  // 接收数据
  // 引入函数
include '../../tools/tools.php';
    // 接受数据
$title = $_REQUEST["title"];
$content = $_REQUEST["content"];
$slug = $_REQUEST["slug"];
$category_id = $_REQUEST["category_id"];
$created = $_REQUEST["created"];
$status = $_REQUEST["status"];
    // 接收文件
$feature = '/uploads/' . my_move_upload_file('feature', '../../uploads/');

// 文章的id
$postId = $_REQUEST['id'];

    // 生成sql
if($feature!='/uploads/'){
    $sql = "
    update posts 
    set title = '$title',
    content = '$content',
    slug = '$slug',
    category_id = '$category_id',
    created = '$created',
    status = '$status',
    feature = '$feature'
    where id = '$postId'
    ";
}else{
    // 没传入图片 直接 不修改图片即可
    $sql = "
    update posts 
    set title = '$title',
    content = '$content',
    slug = '$slug',
    category_id = '$category_id',
    created = '$created',
    status = '$status'
    where id = '$postId'
    ";
}


// echo $sql;
$rowNum = my_ZSG($sql);
if ($rowNum != -1) {
    $backData = array(
        'message'=>'恭喜你,修改成功啦'
    );
} else {
    $backData = array(
        'message'=>'很遗憾,改不了'
    );
}
// 格式化为json
echo json_encode($backData);
?>
