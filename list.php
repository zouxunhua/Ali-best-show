<pre>
<?php
  header('content-type:text/html;charset=utf-8');
  // 引入函数
  include './tools/tools.php';
    // 渲染页面
    $cateData = my_SELECT("select * from categories");

    // 获取当前分类的文章
    // 接收分类id
    $cateId = $_REQUEST['id'];
    // 根据分类id 查询出分类的名字
    $cateName = my_SELECT("select *from categories where id = $cateId")[0][2];
    // echo $cateName;
    // 根据分类id 查询文章信息
    $postData = my_SELECT("select * from posts where category_id = $cateId and status='published' limit 4");
    // var_dump($postData);
?>
</pre>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
      <?php for($i=0;$i<count($cateData);$i++): ?>
          <li><a href="./list.php?id=<?php echo $cateData[$i][0]; ?>"><i class="fa fa-glass"></i><?php echo $cateData[$i][2]; ?></a></li>
      <?php endfor; ?>
      </ul>
    </div>
    <div class="header">
      <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      <?php for($i=0;$i<count($cateData);$i++): ?>
          <li><a href="./list.php?id=<?php echo $cateData[$i][0]; ?>"><i class="fa fa-glass"></i><?php echo $cateData[$i][2]; ?></a></li>
        <?php endfor; ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
          <li>
            <a href="javascript:;">
              <p class="title">废灯泡的14种玩法 妹子见了都会心动</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_1.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">可爱卡通造型 iPhone 6防水手机套</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_2.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">变废为宝！将手机旧电池变为充电宝的Better</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_3.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">老外偷拍桂林芦笛岩洞 美如“地下彩虹”</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_4.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">doge神烦狗打底南瓜裤 就是如此魔性</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_5.jpg" alt="">
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $cateName; ?></h3>
        <?php for($i=0;$i<count($postData);$i++): ?>
          <div class="entry">
            <div class="head">
              <a href="javascript:;"><?php echo $postData[$i][2]; ?></a>
            </div>
            <div class="main">
              <p class="info">admin 发表于 <?php echo $postData[$i][4]; ?></p>
              <p class="brief"><?php echo $postData[$i][5]; ?></p>
              <p class="extra">
                <span class="reading">阅读(<?php echo $postData[$i][6]; ?>)</span>
                <span class="comment">评论(0)</span>
                <a href="javascript:;" class="like">
                  <i class="fa fa-thumbs-up"></i>
                  <span>赞(<?php echo $postData[$i][7]; ?>)</span>
                </a>
                <a href="javascript:;" class="tags">
                  分类：<span><?php echo $cateName; ?></span>
                </a>
              </p>
              <a href="javascript:;" class="thumb">
                <img src="<?php echo $postData[$i][3]; ?>" alt="">
              </a>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
