<pre>
<?php
  // 判断字段
  // session
  // 开启session
header('content-type:text/html;charset=utf-8');
  // 引入函数
include '../tools/tools.php';
  // 接收数据
  // var_dump($_REQUEST);
  /*
    array(4) {
  ["email"]=&gt;
  string(14) "jack@heima.com"
  ["slug"]=&gt;
  string(6) "sister"
  ["nickname"]=&gt;
  string(12) "littleSister"
  ["bio"]=&gt;
  string(24) "一群跳舞的小姐姐"
}
 */
if (isset($_REQUEST['email'])) {
  $email = $_REQUEST["email"];
  $slug = $_REQUEST["slug"];
  $nickname = $_REQUEST["nickname"];
  $bio = $_REQUEST["bio"];
    // 接收文件
  $avatar = '/uploads/' . my_move_upload_file('avatar', '../uploads/');
  
  // 如果没有 就是/uploads/
  // echo $avatar;
  // 开启session即可
  session_start();
  // id 通过session获取
  $id = $_SESSION['userInfo'][0];
  if ($avatar != '/uploads/') {
  
    // 生成sql语句
    $sql = "update users set email ='$email',slug ='$slug',nickname ='$nickname',bio ='$bio',avatar ='$avatar' where id =$id";

  }else{
     // 生成sql语句
     $sql = "update users set email ='$email',slug ='$slug',nickname ='$nickname',bio ='$bio' where id =$id";
  }
  // 调用函数执行sql语句
    // echo $sql;
  $rowNum = my_ZSG($sql);
  if ($rowNum != -1) {
    // 更新session中保存的数据
    $_SESSION['userInfo'] = my_SELECT("select * from users where id = $id")[0];
    // 什么都不用干 继续执行即可
    // 重新调回 个人中心页 不带任何数据
    // 再次刷新 就没有重复提交数据的提示了
    header('location:./profile.php');
  } else {
  }


}
 
  // 判断结果


?>
</pre>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
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
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form action="./profile.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" name="avatar" type="file">
              <img src="<?php echo $_SESSION['userInfo'][5]; ?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $_SESSION['userInfo'][2]; ?>" placeholder="邮箱" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $_SESSION['userInfo'][1]; ?>" placeholder="slug">
            <p class="help-block">https://zce.me/author/<strong>zce</strong></p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $_SESSION['userInfo'][4]; ?>" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" name="bio" placeholder="Bio" cols="30" rows="6"><?php echo $_SESSION['userInfo'][6]; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">更新</button>
            <a class="btn btn-link" href="password-reset.php">修改密码</a>
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
<script>
  /*
    选择文件之后
    生成url
    设置给img
  */ 
  $(function(){
    // 基于 html5的新api实现的图片预览
    // $('#avatar').change(function(){
    //   // console.log('图片变了');
    //   // 生成url
    //    var resultUrl = URL.createObjectURL(this.files[0]);
    //   //  console.log(resultUrl);
    //   $(this).next('img').attr('src',resultUrl);
    // })

    // 基于ajax2.0实现的图片预览
    $('#avatar').change(function(){
      // 如果放入了form表单 会自动格式化有 name属性的数据
      // 在这个页面中 文件的name 不是preview
      var sendData = new FormData()
      // 自己追加一组键值对到发送的数据中
      sendData.append('preview',this.files[0]);
      // ajax2.0
      $.ajax({
        url:'http://www.baixiu.com/admin/API/06.savePreviewImg.php',
        type:'post',
        data:sendData,
        processData:false,// 不格式化数据
        contentType:false,// 不设置请求头
        success:function(backData){
          // console.log(backData);
          $("#avatar").next('img').attr('src',backData.url);
        }
      })
    })
  })


</script>
