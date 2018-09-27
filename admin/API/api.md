# 接口文档

```
    格式
        请求地址
        请求方法
        请求的参数
        返回的数据格式
```

## 01.查询所有分类的信息

请求地址:
    http://www.baixiu.com/admin/API/01.getCategories.php
请求方法:get
请求的参数:无
返回的数据格式
    json
    {items:数据}


## 02.新增分类信息

请求地址:
    http://www.baixiu.com/admin/API/02.addCategories.php
请求方法:post
请求的参数:
    slug:英文
    name:中文
返回的数据格式
    json
    {message:'成功或者失败'}

## 03.修改分类信息

请求地址:
    http://www.baixiu.com/admin/API/03.modifyCategory.php
请求方法:get
请求的参数:
    slug:英文
    name:中文
    id:分类id
返回的数据格式
    {message:'成功或者失败'}

## 04.删除分类信息

请求地址:
    http://www.baixiu.com/admin/API/04.delCategory.php
请求方法:post
请求的参数:
    id:分类id(如果要删除多个 id需要遵循这个格式 id1,id2,id3)
返回的数据格式
    {message:'成功或者失败'}

## 05.写文章

请求地址:
    http://www.baixiu.com/admin/API/05.writePost.php
请求方法:post
请求的参数:
  title:文章标题
  content:内容
  slug:别名
  category_id:分类id
  created:创建时间
  status:状态
  feature:图片
返回的数据格式
    {message:'成功或者失败'}

## 06.保存预览图片

请求地址:
    http://www.baixiu.com/admin/API/06.savePreviewImg.php
请求方法:post
请求的参数:
  preview:上传的文件
返回的数据格式
    {url:'图片地址'}

## 07.获取评论信息带分页

请求地址:
    http://www.baixiu.com/admin/API/07.getComments.php
请求方法:get
请求的参数:
    pageNum:页码,
    pageSize:页容量
返回的数据格式
    {
        totalPage:'总页数',
        currentPage:当前页,
        items:'当前页数据'
    }

## 08.删除评论信息

请求地址:
    http://www.baixiu.com/admin/API/08.deleteComments.php
请求方法:post
请求的参数:
    id:(如果要删除多个,id1,id2,id3)
返回的数据格式
   {message:'成功或者失败'}

## 09.批准评论信息

请求地址:
    http://www.baixiu.com/admin/API/09.passComments.php
请求方法:get
请求的参数:
    id:(如果要删除多个,id1,id2,id3)
返回的数据格式
   {message:'成功或者失败'}

## 10.驳回评论信息

请求地址:
    http://www.baixiu.com/admin/API/10.rejectComments.php
请求方法:post
请求的参数:
    id:(如果要删除多个,id1,id2,id3)
返回的数据格式
   {message:'成功或者失败'}

## 11.获取文章信息带分页

请求地址:
    http://www.baixiu.com/admin/API/11.getPosts.php
请求方法:post
请求的参数:
    pageNum:页码,
    pageSize:页容量
    category_id:分类的id
    status:状态
返回的数据格式
    {
        totalPage:'总页数',
        currentPage:当前页,
        items:'当前页数据'
    }

## 12.批准评论信息

请求地址:
    http://www.baixiu.com/admin/API/12.deletePosts.php
请求方法:get
请求的参数:
    id:(如果要删除多个,id1,id2,id3)
返回的数据格式
   {message:'成功或者失败'}

## 13.根据id获取文章的接口
请求地址:
    http://www.baixiu.com/admin/API/13.getPostById.php
请求方法:post
请求的参数:
    id:文章id
返回的数据格式
   {data:'文章的数据'}

## 14.文章编辑接口

请求地址:
    http://www.baixiu.com/admin/API/14.modifyPost.php
请求方法:post
请求的参数:
  title:文章标题
  content:内容
  slug:别名
  category_id:分类id
  created:创建时间
  status:状态
  feature:图片
  id:文章的id
返回的数据格式
    {message:'成功或者失败'}


## 15.获取轮播图信息
请求地址:
    http://www.baixiu.com/admin/API/15.getSlides.php
请求方法:get
请求的参数:
    无
返回的数据格式
    轮播图json数据

## 16.编辑轮播图接口
请求地址:
    http://www.baixiu.com/admin/API/16.modifySlides.php
请求方法:post
请求的参数:
    slideData:(轮播图json格式的数据)
返回的数据格式
    {message:"成功或者失败"}

## 17.保存轮播图图片接口
请求地址:
    http://www.baixiu.com/admin/API/17.saveSlideImg.php
请求方法:post
请求的参数:
    icon:轮播图的图片
返回的数据格式
    {url:"图片路径"}