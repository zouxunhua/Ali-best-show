<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
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
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40">
                  <input type="checkbox">
                </th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td class="text-center">
                  <img class="slide" src="../uploads/slide_1.jpg">
                </td>
                <td>XIU功能演示</td>
                <td>#</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center">
                  <input type="checkbox">
                </td>
                <td class="text-center">
                  <img class="slide" src="../uploads/slide_2.jpg">
                </td>
                <td>XIU功能演示</td>
                <td>#</td>
                <td class="text-center">
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
</body>

</html>
<script src="../assets/vendors/template-web/template-web.js"></script>
<!-- each 如果是循环对象中的某个属性 需要指定属性名
    如果直接传入一个数组 不需要人为的指定属性是什么
-->
<script type='text/html' id="slideTem">
  {{each}}
    <tr slideindex="{{$index}}">
        <td class="text-center"><input type="checkbox"></td>
        <td class="text-center"><img class="slide" src="{{$value.image}}"></td>
        <td>{{$value.text}}</td>
        <td>{{$value.link}}</td>
        <td class="text-center">
          <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
        </td>
      </tr>
    {{/each}}
</script>
<script>
  /*
    需求1
      页面打开之后 获取轮播图信息 渲染到页面上
        使用jQ的ajax 
          调用接口
            回调函数中
              使用模板引擎 渲染页面(引入模板引擎,定义模板,挖坑起名字,填坑)
    需求2
      选择了图片之后预览图片
      方案1(本地)
        使用html5的api实现预览
      方案2(传到了服务器)
        使用ajax2.0结合图片预览接口实现预览
    需求3
      抽取轮播图数据为变量  slideData
      在需求1中赋值

      点击添加按钮
        新增的轮播图数据 追加到 轮播图数组中
    需求4
      点击删除
      删除这个a标签对应的那个轮播图数据(本地数据)

      调用接口 吧数据发送到服务器
        回调函数中
          重新渲染页面(局部刷新)
              
  */
  $(function () {
    // 声明变量
    var slideData;

    // 需求1
    function getData() {
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/15.getSlides.php',
        // data:,
        // type:,
        success: function (backData) {
          console.log(backData);
          var result = template('slideTem', backData);
          // console.log(result);
          $('tbody').html(result);

          // 保存轮播图数据到变量中
          slideData = backData;
        }
      })

    }

    // 默认调用一次
    getData();

    // 需求2
    // 方案1
    $('#image').change(function () {

      // 保存this
      var $this = $(this);
      // 方案1--------
      /*
        // 获取图片
        var file = this.files[0];
        // 生成url
        var url = URL.createObjectURL(file);
        // console.log(url);
        // 设置给img 显示img标签
        $(this).prev('img').attr('src',url).fadeIn(2000);
      */

      // 方案2
      // 表单元素中的name属性 刚好跟key一样
      var sendData = new FormData();
      // 如果不一致 自行append
      sendData.append('icon', this.files[0]);
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/17.saveSlideImg.php',
        data: sendData,
        type: 'post',
        contentType: false,// 不要设置请求头
        processData: false,// 不要格式化数据
        success: function (backData) {
          // console.log(backData);
          $this.prev('img').attr('src', backData.url).slideDown(1000);
        }
      })
    })


    // 需求3
    $('form button.btn-primary').click(function (event) {
      //阻止默认行为
      event.preventDefault();

      // 获取轮播图信息
      var newSlide = {
        image: $(".help-block").attr('src'),
        link: $('#link').val(),
        text: $('#text').val()
      };

      // 获取完数据之后 干掉他们
      $(".help-block").hide();
      $('#link').val('');
      $('#text').val('');

      // 添加到数组中
      slideData.push(newSlide);

      console.log(slideData);

      // js中 提供了一对方法 
      // json字符串 ->js对象 数组
      // js对象 数组 ->json字符串
      var sendData = JSON.stringify(slideData);
      // console.log(sendData);

      // 调用接口 发送到服务器即可
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/16.modifySlides.php',
        data: {
          slideData: sendData
        },
        type: 'post',
        success: function (backData) {
          // console.log(backData);
          // 重新获取数据
          getData();
        }
      })
    })


    // 需求4
    $('tbody').on('click', 'a.btn-danger', function () {
      // 根据a标签找tr中保存的index
      // a    td      tr
      var deleteIndex = $(this).parent().parent().attr('slideindex');

      // 删除数组中这个索引对应的元素
      slideData.splice(deleteIndex, 1);
      // console.log(slideData);

      // 调用接口
      // js中 提供了一对方法 
      // json字符串 ->js对象 数组
      // js对象 数组 ->json字符串
      var sendData = JSON.stringify(slideData);
      // console.log(sendData);

      // 调用接口 发送到服务器即可
      $.ajax({
        url: 'http://www.baixiu.com/admin/API/16.modifySlides.php',
        data: {
          slideData: sendData
        },
        type: 'post',
        success: function (backData) {
          // console.log(backData);
          // 重新获取数据
          getData();
        }
      })
    })
  })

</script>