<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
  <style>
    /* nth-child 根据索引获取元素 */

    tr td:nth-child(3) {
      /* 最大的宽度 */
      width: 300px;
      /* max-width:  最宽多宽 */
    }

    tr td:last-child {
      width: 150px;
    }
  </style>
</head>

<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include './INC/navbar.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li>
            <a href="#">上一页</a>
          </li>
          <li>
            <a href="#">1</a>
          </li>
          <li>
            <a href="#">2</a>
          </li>
          <li>
            <a href="#">3</a>
          </li>
          <li>
            <a href="#">下一页</a>
          </li>
        </ul>
        <!-- 首页 尾页 -->
        <a href="javascript:;" id="firstPage" class="btn btn-success btn-sm pull-right">首页</a>
        <input id="pageNum" type="number" class="pull-right">
        <a href="javascript:;" id="lastPage" class="btn btn-success btn-sm pull-right">尾页</a>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40">
              <input type="checkbox">
            </th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr class="danger">
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>未批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <?php include './INC/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>

</html>
<!-- 导入模板引擎 -->
<script src="../assets/vendors/template-web/template-web.js"></script>
<!-- 制作模板 -->
<script type="text/html" id="commTem">
  {{each items}}
    <tr commid ={{$value[0]}} 
    {{if $value[5]=='held'}}
      class="danger"
    {{/if}}
    >
      <td class="text-center"><input type="checkbox"></td>
      <td>{{$value[1]}}</td>
      <td>{{$value[2]}}</td>
      <td>《{{$value[3]}}》</td>
      <td>{{$value[4]}}</td>
      <td>
        {{if $value[5]=='held'}}
          未批准
        {{else if $value[5]=='approved'}}
          已批准
        {{else}}
          拒绝
        {{/if}}
      </td>
      <td class="text-center">
        {{if $value[5]=='held'}}
          <a href="javascript:;" class="btn btn-info btn-xs">批准</a>
          <a href="javascript:;" class="btn btn-warning btn-xs">拒绝</a>
        {{/if}}
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  {{/each}}
</script>

<script>
  /*
    需求1
      页面打开之后 获取评论信息
        ajax调用接口
          回调函数中
            渲染页面
              评论部分
              页码部分
   需求2
    点击页码li标签
    获取点击的页数
    调用获取数据的接口
    获取数据
      回调函数中
        渲染页面
      因为代码的部分 跟 需求1十分类似 抽取需求1的逻辑
    需求3
      点击上一页
      点击下一页
        获取当前页的页码
          累加 或者递减
          调用封装的函数
    需求4
      点击 删除 驳回 通过
        调用对应的接口
        回调函数中
          局部刷新
          重新调用getData
    需求5
      全选 & 反选
      点击顶部的 checkbox
        设置tbody中的 checkbox的 选中状态 跟 顶部的一样
        被选中 
          顶部批量操作按钮显示
        反之
          隐藏

      点击tbody中的checkbox
        判断总个数 跟选中的个数
        如果相等 勾选顶部的
        反之取消勾选
        选中一个
          顶部批量操作按钮显示
        反之
          隐藏
    需求6
      点击 批量删除 &批量批准 &批量拒绝
        调用对应的接口
        传递被选中的id去服务器
        格式是id1,id2,id3
          回调函数中
            局部刷新
            调用封装的getData函数
    需求调整
      点击上一页 下一页 全选按钮的勾选状态还在
      批量操作还是现实的
      上一页 下一页的点击事件中
        隐藏批量操作
        取消全选按钮的勾选
    额外需求
      页码一次只显示3个
        修改需求1 封装的getData函数的回调函数中的代码
        根据当前页 计算起始跟结束的索引值即可
      1.点击去首页
        点击 调用 getData(1)

      2.点击去尾页
        点击 调用getData(总页数)
      3.去某一页
        失去焦点
          获取输入的页码
          调用getData(页码)
  */
  $(function () {

    // 定义变量 保存总页数方便后续使用
    var totalPage;

    // 需求1
    function getData(pageNum) {
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/07.getComments.php',
        data: {
          pageNum: pageNum,
          pageSize: 10
        },
        //  type:'get',
        success: function (backData) {
          console.log(backData);
          var result = template('commTem', backData);
          //  console.log(result);
          // 渲染页面
          $('tbody').html(result);

          // 清空 页码中的li 除了 第一个 跟最后一个
          // 删除 pagination 里面除了 第一个 跟最后一个li
          $('.pagination li:not(:first,:last)').remove()

          // 循环 生成 一个个的页码
          // 获取当前页
          var currentPage = parseInt(backData.currentPage);
          // 计算起始的索引
          var startIndex = currentPage-1;
          // 结束的索引
          var endIndex = currentPage+1;
          // 修正 起始 跟结束索引
          if(startIndex<1){
            startIndex=1;
            // 修正为1
            // 结束索引
            endIndex = startIndex+2;
          }
          if(endIndex>backData.totalPage){
            endIndex = backData.totalPage;
            // 起始索引
            startIndex = endIndex - 2;
          }
          for (var i = startIndex; i <=endIndex; i++) {
            // 生成li标签
            var $li = $('<li><a href="#">' + i + '</a></li>');
            // 高亮当前页
            if (backData.currentPage == i) {
              $li.addClass('active');
            }

            // 添加到ul中
            $li.insertBefore('.pagination li:last');
          }
        
          // 保存总页数
          totalPage = backData.totalPage;
          }
      })

    }

    // 默认调用一次 第一页的数据
    getData(1);

    // 需求2
    $('.pagination').on('click', 'li:not(:first,:last)', function () {
      // 获取点击的页码
      var pageNum = $(this).children('a').html();
      // console.log(pageNum);
      // 调用函数
      getData(pageNum);
    })
    // 需求3
    $('.pagination li:first').click(function () {
      // 获取页码
      var currentPage = $('li.active a').html();
      // 递减
      currentPage--;
      if (currentPage < 1) {
        alert('哥们,别点啦,前面木有啦');
        return;
      }
      // 调用函数
      getData(currentPage);
    })
    $('.pagination li:last').click(function () {
      // 获取页码
      var currentPage = $('li.active a').html();
      // 累加
      currentPage++;
      // 总页数(返回的数据获取总页数,获取li的个数,最后一个li内部的内容)
      //                     最后一个li          前面的li   儿子a     内容
      var totalPage = $('.pagination li:last').prev().children('a').html();
      if (currentPage > totalPage) {
        alert('哥们,别点啦,后面木有啦');
        return;
      }
      // 调用函数
      getData(currentPage);
    })

    // 需求4
    $('tbody').on('click', 'a.btn', function () {
      console.log('你点我啦');
      console.log($(this).parent().parent().attr('commid'));
      var id = $(this).parent().parent().attr('commid');

      var mess = $(this).html();

      // 定义变量 保存接口数据
      var targetUrl;
      var targetMethod;
      // 调用接口
      switch (mess) {
        case '删除':
          targetUrl = 'http://www.baixiu.com/admin/API/08.deleteComments.php';
          targetMethod = 'post';
          break;
        case '拒绝':
          targetUrl = 'http://www.baixiu.com/admin/API/10.rejectComments.php';
          targetMethod = 'post';
          break;
        case '批准':
          targetUrl = 'http://www.baixiu.com/admin/API/09.passComments.php';
          targetMethod = 'get';
          break;
      }

      // ajax调用接口即可
      $.ajax({
        url: targetUrl,
        type: targetMethod,
        data: {
          id: id
        },
        success: function (backData) {
          // 重新获取数据
          // console.log(backData);
          // 局部刷新
          // 获取当前页的页码 调用函数即可
          getData($('li.active a').html());
        }
      })
    })

    // 需求5
    //   全选 & 反选
    //   点击顶部的 checkbox
    $('thead input[type=checkbox]').click(function () {
      //     设置tbody中的 checkbox的 选中状态 跟 顶部的一样
      $('tbody input[type=checkbox]').prop('checked', $(this).prop('checked'));
      //     被选中 
      if ($(this).prop('checked') == true) {
        //       顶部批量操作按钮显示
        $('.btn-batch').fadeIn();
      } else {
        //     反之
        //       隐藏
        $('.btn-batch').fadeOut();
      }
    })

    //   点击tbody中的checkbox
    $('tbody').on('click', 'input[type=checkbox]', function () {
      //     判断总个数 跟选中的个数
      var totalCount = $('tbody input[type=checkbox]').length;
      var checkedNum = $('tbody input[type=checkbox]:checked').length;
      //     如果相等 勾选顶部的
      $('thead input[type=checkbox]').prop('checked', totalCount == checkedNum);
      //     反之取消勾选
      //     选中一个
      if (checkedNum != 0) {
        //       顶部批量操作按钮显示
        $('.btn-batch').fadeIn();
      } else {
        //     反之
        //       隐藏
        $('.btn-batch').fadeOut();
      }
    })

    // 需求6
    // 点击 批量删除 &批量批准 &批量拒绝
    $('.btn-batch button').click(function () {
      // 取消顶部的勾选
      $('thead input[type=checkbox]').prop('checked',false);
      // 判断按钮的内容
      var inputText = $(this).text();
      // 定义变量保存 地址 跟 方法
      var targetUrl = '';
      var targetType = '';
      switch (inputText) {
        case '批量批准':
          targetUrl = 'http://www.baixiu.com/admin/API/09.passComments.php';
          targetType = 'get';
          break;
        case '批量拒绝':
          targetUrl = 'http://www.baixiu.com/admin/API/10.rejectComments.php';
          targetType = 'post';
          break;
        case '批量删除':
          targetUrl = 'http://www.baixiu.com/admin/API/08.deleteComments.php';
          targetType = 'post';
          break;
      }
      //     传递被选中的id去服务器
      //     格式是id1,id2,id3
      //  找到被选中的checkbox 获取id 拼接字符串
      // 要发送的id
      var sendId ='';  // i 是索引 e元素 dom元素
      $('tbody input[type=checkbox]:checked').each(function (i, e) {
        // 拼接字符串
        //       checkbox  td   tr    自定义属性
        sendId+=$(e).parent().parent().attr('commid');
        // 拼接,
        sendId+=',';
      })
      // 多了一个,
      sendId = sendId.slice(0,-1);
      //     调用对应的接口
      $.ajax({
        url: targetUrl,
        type: targetType,
        data:{
          // 如果是 普通的ajax  需要些的是对象
          id:sendId
        },
        success: function (backData) {
          console.log(backData);  
          //       回调函数中
          //         调用封装的getData函数
          // 去第一页
          var targetPage = $('li.active a').html();
          // 最后一页 去第一页 最后一个li             前面的li   儿子a     内容
          if(targetPage ==$('.pagination li:last').prev().children('a').html())
          { // 去第一页
            targetPage = 1;
          }
          getData(targetPage);
        }
      })

    })
    

    // 需求调整
    $('.pagination li:first,.pagination li:last').click(function () {
      // 
      // console.log('你点我啦');
      $('.btn-batch').hide();
      $('thead input[type=checkbox]').prop('checked',false);
    })

    // 额外需求1 ,2 ,3
    // 1.点击去首页
    //     点击 调用 getData(1)

    //   2.点击去尾页
    //     点击 调用getData(总页数)
    //   3.去某一页
    //     失去焦点
    //       获取输入的页码
    //       调用getData(页码)
    $('#firstPage').click(function(){
      getData(1);
    })
    $('#lastPage').click(function(){
      // 获取总页数
      getData(totalPage);
    })
    $('#pageNum').blur(function(){
      // 获取页码
      var targetPage = $(this).val();
      if(targetPage>totalPage){
        targetPage = totalPage;
        alert('哥们,你越界了');
      }
      if(targetPage<1){
        targetPage =1;
        alert('哥们,不要乱写,');
      }
      $(this).val(targetPage);
      // 获取总页数
      getData(targetPage);
    })
    
  })
</script>