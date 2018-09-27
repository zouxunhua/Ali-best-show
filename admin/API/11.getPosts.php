<?php
    // 设置格式为json
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收数据
    // 定义筛选的条件
    $option = '';
    // 分类id
    $category_id = $_REQUEST['category_id'];
    if($category_id!=''){
        // 传递了分类id过来
        $option.="and posts.category_id = $category_id ";
    }
    // 状态
    $status = $_REQUEST['status'];
    if($status!=''){
        // 传递了分类id过来
        $option.="and posts.status = '$status' ";
    }
    // 页码
    $pageNum = $_REQUEST['pageNum'];
    // 页容量
    $pageSize = $_REQUEST['pageSize'];
    // 计算数值
    // 起始的索引
    $startIndex = ($pageNum-1)*$pageSize;
    // 总页数 总条数 / 页容量 向上取整
    $totalPage = ceil(count(my_SELECT("
        select
            posts.id,
            posts.title,
            users.nickname,
            categories.name,
            posts.created,
            posts.status
        from posts
        inner join users 
        on posts.user_id = users.id
        inner join categories 
        on posts.category_id = categories.id 
        where true $option"))/$pageSize);
    // 查询当前这一页的数据 带上传递过来的条件

    $sql = "
    select
        posts.id,
        posts.title,
        users.nickname,
        categories.name,
        posts.created,
        posts.status
    from posts
    inner join users 
    on posts.user_id = users.id
    inner join categories 
    on posts.category_id = categories.id 
    where true $option
    limit $startIndex,$pageSize
    ";
    // echo $sql;
    $data = my_SELECT($sql);

    // // 准备json格式数据 并返回
    $backData = array(
        'totalPage'=>$totalPage,
        'currentPage'=>$pageNum,
        'items'=>$data
    );

    echo json_encode($backData);

?>