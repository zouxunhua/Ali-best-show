<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-success" style="display:none">
        <strong>提示</strong>
        <span></span>
      </div>
      <form class="row" action="./post-add.php" method="POST" enctype="multipart/form-data">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <!-- <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea> -->
            <!-- 表单元素之外的 加name 木有用 -->
            <div id="content" name="content"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/
              <strong>slug</strong>
            </p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category_id">
              <option value="1">未分类</option>
              <option value="2">潮生活</option>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
            <button class="btn btn-success" style="display:none" type="button">确认</button>
            <a class="btn btn-danger" href="./posts.php" style="display:none" type="button">取消</a>
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
<script src="../assets/vendors/template-web/template-web.js"></script>
<script type="text/html" id="postTem">
  {{each items}}
      <option value="{{$value[0]}}">{{$value[2]}}</option>
  {{/each}}
</script>

<!-- 导入日期插件 -->
<script src="../assets/vendors/moment/moment.js"></script>
<script src="../assets/vendors/wangEditor/wangEditor.min.js"></script>

<script>
  /*
    需求1
      页面打开 获取分类信息
        回调函数中
          渲染到页面上
    需求2
      修改为ajax提交数据之后 不希望 提交自己
      需要阻止默认行为
    需求3
      选择图片实现预览
      URL.createObjectURL
      测试版本 兼容性 差
      还有一种兼容性更好的图片预览方式
        input标签 选了图片之后 
          
          利用ajax2.0选择了图片之后 把上传到服务器  
            服务器返回一个图片的 url
            在ajax的回调函数中 获取这个url
              把这个url设置给img标签
    需求4
      页面打开 设置当前的时间 到 日期标签上
    需求5
      输入内容区域 使用富文本编辑器

    编辑文章逻辑
      需求1
        页面跳转过来之后 获取url中的id(不能使用php的代码)
        如果通过url传递数据(纯前端的数据传递)s
        获取id
        如果没有id 正常的逻辑
        如果有id 编辑
          修改页面显示的方式 为编辑状态
          通过id 获取这个id 对应的文章数据
            数据获取到之后
              调用接口13
              传递id
              回调函数中
                渲染到页面上
      需求2
        点击取消按钮 返回 文章列表页即可
      需求3
        点击确认按钮
          调用编辑文章接口
            回调函数中 提示用户
        */
  var editor2
  $(function () {
    // 需求1
    $.ajax({
      url: 'http://www.baixiu.com/admin/API/01.getCategories.php',
      // data:,
      // type:,type不写 就是 get
      success: function (backData) {
        console.log(backData);
        var result = template('postTem', backData);
        // 直接替换 不需要去手动的删除 原本的分类`
        $('#category').html(result);

      }
    })
    // 需求5
    // 保存对象
    var E = window.wangEditor
    // 实例化
    editor2 = new E('#content')
    // 创建
    editor2.create()

    // 需求2
    // form from
    $('form button[type=submit]').click(function (event) {
      // 阻止默认行为
      event.preventDefault();
      // 调用接口
      // 文件上传 ajax2.0 FormData
      // 自动格式化数据
      // 全部获取到了
      // category_id undefine index 
      var sendData = new FormData($('form')[0]);
      // 表单中没有了 content 我们需要自己人为的添加
      sendData.append('content', editor2.txt.html());
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/05.writePost.php',
        data: sendData,
        type: 'post',
        contentType: false,// 不设置请求头
        processData: false,// 不格式化数据为 key=value&key2=value2
        success: function (backData) {
          console.log(backData);
          // 清空表单元素的内容
          // form表单的 后代元素 有name属性
          $('form [name]').val('');
        }
      })
    })

    // 需求3 兼容性一般
    // $('#feature').change(function(){
    //   // console.log('图片变了');
    //   // 生成url
    //   // mdn
    //    var resultUrl = URL.createObjectURL(this.files[0]);
    //   //  console.log(resultUrl);
    //   $(this).prev('img').attr('src',resultUrl).fadeIn();
    // })

    // 需求3 兼容性高的版本
    // 基于ajax2.0实现的图片预览
    // change事件(表单元素的value值更改了就回触发)
    $('#feature').change(function () {
      // console.dir(this);
      // 如果放入了form表单 会自动格式化有 name属性的数据
      // 在这个页面中 文件的name 不是preview
      var sendData = new FormData()
      // 自己追加一组键值对到发送的数据中
      sendData.append('preview', this.files[0]);
      // ajax2.0
      // 如果我们要用 jQuery的ajax 发送 FormData 
      // 一定要写 processData  contentType
      // 要用ajax上传文件 就需要使用ajax2.0
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/06.savePreviewImg.php',
        type: 'post',
        data: sendData,
        processData: false,// 不格式化数据
        contentType: false,// 不设置请求头
        success: function (backData) {
          // console.log(backData);
          $("#feature").prev('img').attr('src', backData.url).fadeIn();
        }
      })
    })

    // 需求4
    var result = moment().format('YYYY-MM-DDTHH:mm');
    // console.log(result);
    // 使用jQ设置
    $('#created').val(result);

    // 文章编辑 获取通过url传递的id
    var editId = window.location.search.split('=')[1];
    // console.log(editId);
    if (editId) {
      // 改变显示的状态
      $('h1').html('编辑文章');
      // 隐藏 保存
      // 显示 确认 取消
      $('form button.btn-primary').hide().siblings().show();

      // 通过ajax获取数据 渲染到页面上
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/13.getPostById.php',
        data: {
          id: editId
        },
        type: 'post',
        success: function (backData) {
          console.log(backData);
          // 设置标题
          $('#title').val(backData.data[0][2]);
          // 内容
          editor2.txt.html(backData.data[0][5]);
          // 别名
          $('#slug').val(backData.data[0][1]);
          // 图片
          $('.help-block').attr('src', backData.data[0][3]).show();
          // 分类id
          $('#category').val(backData.data[0][10]);
          // 状态
          $('#status').val(backData.data[0][8]);
        }
      })
    }

    // 文章编辑 需求3
    $('form button.btn-success').click(function () {
      // 全部获取到了
      // category_id undefine index 
      var sendData = new FormData($('form')[0]);
      // 表单中没有了 content 我们需要自己人为的添加
      sendData.append('content', editor2.txt.html());

      // 追加id
      sendData.append('id', editId);


      $.ajax({
        url: 'http://www.baixiu.com/admin/API/14.modifyPost.php',
        data: sendData,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (backData) {
          // console.log(backData);

          // jQ的链式编程 中间有可能会修改返回的值
          // 我们可以使用 end方法 变回他改变之前的状态
          // alert-success        span                   span       alert-success
          // end 返回破坏性操作之前的状态
          $('.alert-success').children('span').html(backData.message).end().fadeIn().delay(1000).fadeOut();
        }
      })
    })

  })

</script>