<?php 
    // 判断字段
  // session
  // 开启session
session_start();
if (isset($_SESSION['userInfo']) == false) {
  header('location:./login.php');
}
?>
<nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="./doLogout.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>