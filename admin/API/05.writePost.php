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
    // 通过session获取用户的id
session_start();
$user_id = $_SESSION['userInfo'][0];
    // 生成sql
$sql = "insert into posts(title,content,slug,category_id,created,status,feature,user_id) 
      values ('$title','$content','$slug','$category_id','$created','$status','$feature','$user_id');
    ";
// echo $sql;
$rowNum = my_ZSG($sql);
if ($rowNum != -1) {
    $backData = array(
        'message'=>'恭喜你,新增成功啦'
    );
} else {
    $backData = array(
        'message'=>'很遗憾,新增失败啦'
    );
}
// 格式化为json
echo json_encode($backData);
?>
