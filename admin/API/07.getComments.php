<?php
    // 设置格式为json
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include '../../tools/tools.php';
    // 接收数据
    // ----计算当前页数据的逻辑------
    // 页码
    $pageNum = $_REQUEST['pageNum'];
    // 页容量
    $pageSize = $_REQUEST['pageSize'];
    // 计算起始的索引值
    $startIndex = ($pageNum-1)*$pageSize;


    // ----计算总页数的逻辑----------
    // 总条数 / 页容量 向上取整
    // 这里连表的意义 是保证数据的一致性
    $totalCount = count(my_SELECT("select * from comments inner join posts on comments.post_id = posts.id"));
    // 可能是小数 1.2
    $totalPage = ceil($totalCount/$pageSize);

    // 查询数据
    $data = my_SELECT("
    select 
    comments.id,
    comments.author,
    comments.content,
    posts.title,
    comments.created,
    comments.status
    from comments
    inner join posts
    on comments.post_id = posts.id
    limit  $startIndex,$pageSize");

    // 返回数据 json
    $backData = array(
        'totalPage'=>$totalPage,
        'currentPage'=>$pageNum,
        'items'=>$data
    );

    echo json_encode($backData);
?>