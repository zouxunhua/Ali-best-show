
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
  <?php include './INC/navbar.php'; ?>
  <?php
    // 接收数据
  $message = null;
  if (isset($_REQUEST['old'])) {
    // 引入函数
    include '../tools/tools.php';
    $old = $_REQUEST['old'];
    $new = $_REQUEST['new'];
    $new2 = $_REQUEST['new2'];
      // 准备sql语句--查询旧密码是否跟数据库中的一致(也可以直接使用session来搞定)
      // 开启session
      // session_start();
    if ($old == $_SESSION['userInfo'][3]) {
      if ($new == $new2) {
          $id = $_SESSION['userInfo'][0];
            // 执行sql语句
            $sql = "update users set password ='$new' where id =$id";
            // 一致 修改 - 执行修改逻辑
            $rowNum = my_ZSG($sql);
            // 不一致 提示用户
            if($rowNum!=-1){
              // 成功了
              header('location:./doLogout.php');
            }else{
              // 失败了
              // 根据结果 提示用户 跳转页面
              $message = '密码没有改成功哦';
            }
      } else {
        // 两次新密码不同
        $message = "哥们,是不是手滑了,两次不一样哦,检查一下呗,要心细一点哦😂😂😂😂";
      }
    } else {
        // 老密码不对 提示用户
      $message = '哥们,旧密码不对哦,你是!!👋👋👋👋👋';
    }
  }
  ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <?php if ($message != null) : ?>
        <div class="alert alert-danger">
          <strong>错误！</strong><?php echo $message; ?>
        </div>
      <?php endif; ?>
      <form class="form-horizontal" action="./password-reset.php" method="post">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" name="old" class="form-control" type="password" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" name="new" class="form-control" type="password" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" name="new2" class="form-control" type="password" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <button type="submit" class="btn btn-primary">修改密码</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<?php include './INC/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
