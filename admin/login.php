<?php

// 定义判断是否显示提示信息的标示
// 默认不赋值
$message = null;

if (isset($_REQUEST['email'])) {
  header('content-type:text/html;charset=utf-8');
  // 引入函数
  include '../tools/tools.php';
  // 接收数据
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  // 准备sql语句
  $sql = "select * from users where email='$email' and password ='$password'";
  // 调用函数执行sql语句
  $data = my_SELECT($sql);
  // var_dump($data);
  // 判断结果
  if(count($data)==0){
    // 错
    // 显示提示消息
    $message ="用户名或密码错误哦,你真的是本人吗?";
  }else{
    // 对
    // 开启session
    session_start();
    // 记录信息
    $_SESSION['userInfo'] = $data[0];
    // 去首页
    header('location:./index.php');
  }
  // 如果失败 显示提示信息 (默认不显示)
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form action="./login.php" method="post" class="login-wrap">
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if($message!=null): ?>
        <div class="alert alert-danger">
          <strong>错误！</strong><?php echo $message; ?>
        </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block" type="submit">登 录</button>
    </form>
  </div>
</body>
</html>
