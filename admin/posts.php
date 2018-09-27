<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">废弃</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
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
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40">
              <input type="checkbox">
            </th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center">
              <input type="checkbox">
            </td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
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
<!-- 导入模板 -->
<script src="../assets/vendors/template-web/template-web.js"></script>
<!-- 定义模板 -->
<script type="text/html" id="postTem">
  {{each items}}
    <tr >
      <td class="text-center"><input value="{{$value[0]}}" type="checkbox"></td>
      <td>{{$value[1]}}</td>
      <td>{{$value[2]}}</td>
      <td>{{$value[3]}}</td>
      <td class="text-center">{{$value[4]}}</td>
      <td class="text-center">
        {{if $value[5]=='published'}}
          已发布
        {{else if $value[5]=='drafted'}}
          草稿
        {{else}}
          废弃
        {{/if}}
      </td>
      <td class="text-center">
        <a href="./post-add.php?id={{$value[0]}}" class="btn btn-default btn-xs">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  {{/each}}
</script>
<script>
  /*
    需求1
      页面一打开
      获取分类信息
        回调函数中
          渲染到分类的下拉菜单中
    需求2
      页面一打开
        调用获取文章接口
        获取第一页的文章
          回调函数中
            渲染页面
            根据总页数 生成页码
    需求3
      抽取需求2为函数
      方便后续的重复调用

    需求3.1
      点击筛选 根据条件 筛选元素
        重新调用 获取文章数据的接口
          传递页码 页容量 分类id,状态
            回调函数中
              根据模板引擎渲染页面
    需求3.2
      form表单中的select 只要重新选择 立刻获取数据
      绑定change事件
        在change事件中 重新调用抽取的getData()函数即可
    需求4
      上一页
      下一页
      点击去某一页
    需求5
      全选&反选
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
      点击 批量删除
        调用对应的接口
        传递被选中的id去服务器
        格式是id1,id2,id3
          回调函数中
            局部刷新
            调用封装的getData函数
    需求7
      点击每一行中的删除a标签
        获取id
        调用删除接口
          回调函数中
            局部刷新


  */
  $(function () {
    // 需求1
    // 调用获取分类接口
    $.ajax({
      url: 'http://www.baixiu.com/admin/API/01.getCategories.php',
      //  data:,
      //  type:,
      success: function (backData) {
        console.log(backData);
        // 动态生成 option标签 添加到页面上
        for (var i = 0; i < backData.items.length; i++) {
          // 自己拼接生成option
          var $opt = $('<option value="' + backData.items[i][0] + '">' + backData.items[i][2] + '</option>');
          // 添加到 select
          $('.form-inline select:first').append($opt);
        }
      }
    })

    // 需求2
    function getData(pageNum) {
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/11.getPosts.php',
        data: {
          pageNum: pageNum,// 页码
          pageSize: 6,// 页容量
          category_id: $('.form-inline select:first').val(),// 分类id
          status: $('.form-inline select:last').val(),// 状态
        },
        type: 'post',
        success: function (backData) {
          console.log(backData);// 打印测试数据
          // 使用模板引擎渲染数据
          var result = template('postTem', backData);
          //  填充到页面上
          $('tbody').html(result);
          // 生成页码
          // 删除原本的 1,2,
          $('.pagination li:not(:first,:last)').remove();
          // 循环生成页码
          for (var i = 1; i <= backData.totalPage; i++) {
            // 生成li 
            var $li = $('<li><a href="#">' + i + '</a></li>');
            // 高亮当前
            if (backData.currentPage == i) {
              $li.addClass('active');
            }
            // 添加到ul中
            $li.insertBefore('.pagination li:last');
          }
        }
      })

    }

    getData(1);

    // 需求3.1
    $('.form-inline button').click(function (event) {
      // 阻止默认行为
      event.preventDefault();
      // 调用接口
      // 重新获取第一页数据
      getData(1);
    })

    // 需求3.2 form 中select 一change立刻调用函数 筛选即可
    $('.form-inline select').change(function () {
      // 重新获取第一页数据即可
      getData(1);
    })

    // 需求4
    // 上一页
    $('.pagination li:first').click(function () {
      // 获取当前页
      var currentPage = $('li.active a').html();
      // 递减
      currentPage--;
      if (currentPage < 1) {
        alert('哥们,不要点啦');
        //  直接跳出即可
        return;
      }
      // 调用函数getData
      getData(currentPage);
    })
    $('.pagination li:last').click(function () {
      // 获取当前页
      var currentPage = $('li.active a').html();
      // 递减
      currentPage++;
      if (currentPage > $('.pagination li').length - 2) {
        alert('哥们,不要点啦');
        //  直接跳出即可
        return;
      }
      // 调用函数getData
      getData(currentPage);
    })

    // 点击某一页
    $('.pagination').on('click', 'li:not(:first,:last)', function () {
      // 获取页码
      var currentPage = $(this).children('a').html();
      // 调用函数
      getData(currentPage);
    })

    // 需求5
    $('thead input[type=checkbox]').click(function () {
      //     设置tbody中的 checkbox的 选中状态 跟 顶部的一样
      $('tbody input[type=checkbox]').prop('checked', $(this).prop('checked'));
      //     被选中 
      if ($(this).prop('checked') == true) {
        //       顶部批量操作按钮显示
        $('.page-action a.btn-danger').fadeIn();
      } else {
        //     反之
        //       隐藏
        $('.page-action a.btn-danger').fadeOut();
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
        $('.page-action a.btn-danger').fadeIn();
      } else {
        //     反之
        //       隐藏
        $('.page-action a.btn-danger').fadeOut();
      }
    })

    // 需求6
    $('.page-action a.btn-danger').click(function () {

      // 还原页面的状态
      $(this).hide();
      // 取消勾选
      $('thead input[type=checkbox]').prop('checked', false);

      // 生成 id,id2,id3
      // 获取被选中的
      var sendId = '';
      $('tbody input[type=checkbox]:checked').each(function (i, e) {
        // 循环的的id值
        // 拼串
        sendId += $(e).val();
        sendId += ',';
      })
      // 去掉末尾的,
      sendId = sendId.slice(0, -1);

      // 调用接口
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/12.deletePosts.php',
        data: {
          id: sendId
        },
        type: 'get',
        success: function (backData) {
          // console.log(backData);
          // 局部刷新
          getData($('li.active a').html());
        }
      })
    })

    // 需求7
    // 点击每一行中的删除a标签
    $('tbody').on('click','a.btn-danger',function(){
      // 获取id
      // a     td      所有兄弟    老大    的儿子             的value值
      var deleteId = $(this).parent().siblings().find('input').val();
      // console.log(id);

      // 调用删除接口
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/12.deletePosts.php',
        data: {
          id: deleteId
        },
        type: 'get',
        success:function(backData){
          // 回调函数中
          // 局部刷新
          getData($('li.active a').html());
        }
      })
    })
  })


</script>