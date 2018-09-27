<?php
    // 开启session
    session_start();
    // 删除session
    unset($_SESSION['userInfo']);
    // 去登录页
    header('location:./login.php');

?>