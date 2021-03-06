<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>浙江大学广播电视台内培系统——选课页面</title>
        <link rel="stylesheet" href="/eduadmin/Public/css/bootstrap.min.css">

<script type="text/javascript">
     window.onload=function(){
          document.myform.course_id.focus();
     }
     function check(){
     if(document.myform.course_id.value==""){
          alert('课程编号不能为空！！');
          document.myform.no.focus();
          return false;
     }
     if(isNaN(document.myform.course_id.value)){
          alert('课程编号必须为数字！！');
          document.myform.no.focus();
          return false;
     }
     if(document.myform.name.value==""){
          alert('课程名不能为空！！');
          document.myform.name.focus();
          return false;
     }
   
     if(document.myform.capacity.value==""){
          alert('总人数不能为空！！');
          document.myform.capacity.focus();
          return false;
     }
     if(isNaN(document.myform.capacity.value)){
          alert('总人数必须为数字！！');
          document.myform.capacity.focus();
          return false;
     }

     if(document.myform.classroom.value==""){
          alert('上课教室不能为空！！');
          document.myform.classroom.focus();
          return false;
     }
   }
</script>
    </head>

    <body id="index">
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="file:///C:/Users/Fubuki%20C/Desktop/login&amp;main/main.html#" style="
    width: 430px;
">
        <img alt="Brand" class="col-sm-2 col-xs-3" src="/eduadmin/Public/logo2.jpg" style="
    width: 55px;
">  
    浙江大学广播电视台内培——修改课程
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    </a>
    </div>
    <ul class="nav navbar-nav navbar-right">
    <li><a>你好，学生<?php echo ($username); ?>，今天是<?php echo ($date); ?></a></li>
    <li><a href="/eduadmin/index.php/Home/Index/manageCourse"  class="btn btn-primary" style="
    margin-top: 6px;
    margin-left: 6px;
    margin-bottom: 6px;
    margin-right: 6px;
">回到首页</a></li>
    <li><a href="javascript:ms=confirm('确定退出');ms?location.href='/eduadmin/index.php/Home/Index/admin_exit':history.go(0)" class="btn btn-danger" style="
    margin-top: 6px;
    margin-left: 6px;
    margin-bottom: 6px;
    margin-right: 6px;
">退出登录</a>
      </li>
    </ul>
   </div>
   </nav>
 
 <form class="form-horizontal" action="/eduadmin/index.php/Home/Index/updateCourse/id/<?php echo ($course_info["course_id"]); ?>" method="post" name="myform" onsubmit="return check();">
  <div class="form-group">
    <label class="col-sm-1 col-lg-1 control-label">课程名称</label>
    <div class="col-sm-1 col-lg-3">
    <input type="text" class="form-control" name="name"  value="<?php echo ($course_info["name"]); ?>">
  </div>
  </div>
  <div class="form-group">
    <label class="col-sm-1 col-lg-1 control-label">总人数</label>
    <div class="col-sm-1 col-lg-3">
    <input type="text" class="form-control" name="capacity" value="<?php echo ($course_info["capacity"]); ?>">
  </div>
  </div>
  <div class="form-group">
    <label class="col-sm-1 col-lg-1 control-label">上课教室</label>
    <div class="col-sm-1 col-lg-3">
    <input type="text" class="form-control" name="classroom" value="<?php echo ($course_info["classroom"]); ?>">
  </div>
  </div>
  <div class="form-group">
    <label class="col-sm-1 col-lg-1 control-label">适用对象</label>
    <div class="col-sm-3 col-lg-3">
    <select class="form-control">
       <option value="0">记者主持</option>
       <option value="1">摄影剪辑</option>
       <option value="2">网维组</option>
    </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-5">
      <button type="submit" class="btn btn-primary">修改</button>
      <input type="reset" class="btn btn-danger" value="恢复">
    </div>
  </div>

</form>