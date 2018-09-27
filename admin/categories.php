<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
  <script>NProgress.start()</script>

  <div class="main">
    <!-- 引入抽取的页面即可 -->
    <?php include './INC/navbar.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/
                <strong>slug</strong>
              </p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
              <button class="btn btn-success" type="button" style="display:none">取消</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="visibility: hidden">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40">
                  <input type="checkbox">
                </th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include './INC/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script src="../assets/vendors/template-web/template-web.js"></script>
  <!-- 定义模板 挖坑 起名字 -->
  <script type="text/html" id="cateTem">
    {{each items}}
      <tr cateId="{{$value[0]}}">
          <td class="text-center"><input type="checkbox"></td>
          <td>{{$value[2]}}</td>
          <td>{{$value[1]}}</td>
          <td class="text-center">
            <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
            <a href="#" class="btn btn-danger btn-xs">删除</a>
          </td>
      </tr>
    {{/each}}
  </script>
</body>

</html>
<script>
  /*
    1.需求1
      页面打开之后
        无刷新获取数据ajax
          回调函数
            获取数据
            调用模板引擎
            渲染页面
    2.需求2
      点击添加按钮
        无刷新提交数据 ajax
          发送别名 中文名去服务器
            回调函数
            需要重新渲染页面
              抽取需求1的代码为函数
    3.需求3
      点击删除
        无刷新提交数据 删除
          回调函数中
            局部刷新(getData())
    4.需求4
      点击编辑按钮
        事件委托 绑定给tbody
      修改左侧区域 为编辑的样子
        form h2
        #name
        #slug
        button[type=submit] 确认
        button.btn-success
    需求5
      点击取消按钮
        还原内容
    需求6
      点击确认按钮
        ajax调用修改接口
          回调函数中
            局部刷新
    需求7
      全选反选
      出现 隐藏批量删除按钮
    需求8
      点击批量删除
        获取所有被选中的 checkbox tbody
        获取id 拼接为 id1,id2,id3
        调用接口
          回调函数中
            局部刷新 getData

  */
  $(function () {
    // 定义变量保存每次点击的id
    var editId;


    function getData() {
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/01.getCategories.php',
        // data:,
        type: 'get',
        success: function (backData) {
          console.log(backData);
          var result = template('cateTem', backData);
          console.log(result);
          // 直接替换
          $('tbody').html(result);
          // 先移除
          // $('tbody tr').remove();
          // 再添加
          // $('tbody').append(result);
        }
      })
    }
    // 需求1
    getData();

    // 需求2 需求6 并存
    $('form button[type=submit]').click(function (event) {
      // 阻止默认行为
      event.preventDefault();

      // 添加判断的逻辑
      if ($(this).html() == '添加') {
        // 调用接口
        $.ajax({
          url: 'http://www.baixiu.com/admin/API/02.addCategories.php',
          data: {
            slug: $("#slug").val(),
            name: $("#name").val()
          },
          type: 'post',
          dataType: 'json',
          success: function (backData) {
            console.log(backData);
            // 手动刷新页面
            // window.location.reload();
            // 重新渲染页面(局部刷新)
            getData();
          },
          error: function () {
            console.log('出错啦');
          },
          complete: function () {
            console.log('完成啦');
          }
        })
      } else {
        // 确认修改逻辑
        $.ajax({
          url: 'http://www.baixiu.com/admin/API/03.modifyCategory.php',
          data: {
            slug: $("#slug").val(),
            name: $("#name").val(),
            id: editId
          },
          type: 'get',
          success: function (backData) {
            console.log(backData);
            getData();
          }
        })
        // 手动调用取消按钮的点击事件
        $('button.btn-success').click();
      }

    })

    // 需求3
    // tr是动态生成的 绑定给他的老爸
    // on委托的方式绑定 一般是用在元素是动态生成的时候
    $('tbody').on('click', 'a.btn-danger', function () {
      // 保存this
      var $this = $(this);
      // console.log('你点我啦');
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/04.delCategory.php',
        data: {
          // attr jQ提供的获取属性的方法
          id: $this.parent().parent().attr('cateid')
        },
        type: 'post',
        success: function (backData) {
          console.log(backData);
          // 局部刷新
          getData();
        }
      })
    })

    // 需求4
    $('tbody').on('click', 'a.btn-info', function () {
      // 修改dom元素
      $('form h2').text('编辑分类')
      //               a      td       兄弟们     第二个 内容
      $('#name').val($(this).parent().siblings().eq(1).html());
      $('#slug').val($(this).parent().siblings().eq(2).html());
      $('button[type=submit]').text('确认');
      $('button.btn-success').show();

      // 获取id 保存到变量中
      editId = $(this).parent().parent().attr('cateid');
    })
    // 需求5
    $('button.btn-success').click(function () {
      // 修改dom元素
      $('form h2').text('添加新分类目录')
      //               a      td       兄弟们     第二个 内容
      $('#name').val('');
      $('#slug').val('');
      $('button[type=submit]').text('添加');
      $('button.btn-success').hide();
    })

    // 需求7
    $('thead input[type=checkbox]').click(function () {
      // 设置tbody中的checkbox的选中状态跟自己一样
      $('tbody input[type=checkbox]').prop('checked', $(this).prop('checked'));
      if ($(this).prop('checked') == true) {
        $('.page-action a.btn-danger').css('visibility', 'visible');
      } else {
        $('.page-action a.btn-danger').css('visibility', 'hidden');
      }
    })

    // 点击tbody中的checkbox
    // tr是动态生成的
    $('tbody').on('click', 'input[type=checkbox]', function () {
      // 全部的个数
      var totalNum = $('tbody input[type=checkbox]').length;
      // 选中的个数
      var checkedNum = $('tbody input[type=checkbox]:checked').length;
      // 设置顶部的
      $('thead input[type=checkbox]').prop('checked', totalNum == checkedNum);
      // 显示隐藏
      if (checkedNum>1) {
        $('.page-action a.btn-danger').css('visibility', 'visible');
      } else {
        $('.page-action a.btn-danger').css('visibility', 'hidden');
      }

    })
    
      // 需求8
    $('.page-action a.btn-danger').click(function(){
      // 获取所有被选中的checkbox
      // i索引 e dom元素
      // 用来拼串
      var sendId = '';
      // $('tbody input[type=checkbox]:checked').each(function(i,e){
      //   // console.log(i+'|'+e);
      //   // 翻山越岭 找id
      //   //checkbox  td  tr
      //   var id = $(e).parent().parent().attr('cateid');
      //   // console.log(id);
      //   sendId+=id;
      //   // 如果是最后一个id 不拼接
      //   sendId+=',';
      // })
      // // 格式拼接好了? 现在这里 最后有一个额外的逗号 需要删除
      // // console.log(sendId);
      // // 从0开始 直到最后一个为止
      //   sendId = sendId.slice(0,-1);

      // 使用for循环拼接数据
      var $checkBox = $('tbody input[type=checkbox]:checked');
      for(var i =0;i<$checkBox.length;i++){
        //                 checkbox     td        tr
        var currentId = $($checkBox[i]).parent().parent().attr('cateid');
        // 拼串
        sendId+=currentId;
        if(i!=$checkBox.length-1){
          sendId+=',';
        }
      }

       console.log(sendId);
      // ajax 调用接口
      $.ajax({
        url:'http://www.baixiu.com/admin/API/04.delCategory.php',
        data:{
          id:sendId
        },
        type:'post',
        success:function(backData){
          // 局部刷新
          getData();
        }
      })
    })
  
   })
  

</script>