<?php
    // header('content-type:text/html;charset=utf-8');
    // 执行查询语句
    function my_SELECT($sql){
        // 连接数据库
        $link = mysqli_connect('127.0.0.1','root','root','baixiu');
        // sql语句
        // $sql = 
        // 执行sql语句
        $result = mysqli_query($link,$sql);
        // 如果result 是布尔值的false 说明 sql语句没有写对
        // 反过来说 sql语句没有错
        // var_dump($result);
        if($result==false){
            return 'sql语句写错啦';
        }else{
            // 解析结果
            $data = mysqli_fetch_all($result);
            // 关闭连接
            mysqli_close($link);
            return $data;
        }
    }

    // 测试语句
    // $data = my_SELECT("select * from cq123");
    // // $data = my_SELECT("select * from cq");
    // var_dump($data);    


    // 执行增删改语句
     function my_ZSG($sql){
        // 连接数据库
        $link = mysqli_connect('127.0.0.1','root','root','baixiu');
        // sql语句
        // $sql = 
        // 执行sql语句
       mysqli_query($link,$sql);
        // 获取行数
        $rowNum = mysqli_affected_rows($link);
        // 关闭连接
        mysqli_close($link);
        return $rowNum;
    }

    // 保存文件的函数
    function my_move_upload_file($key,$path){
        $fileName_GBK = iconv('utf-8','gbk',$_FILES[$key]['name']);
        move_uploaded_file($_FILES[$key]['tmp_name'],$path.$fileName_GBK);

        // 返回文件名
        // gbk的名字
        // utf-8的名字
        return $_FILES[$key]['name'];
    }

?>
