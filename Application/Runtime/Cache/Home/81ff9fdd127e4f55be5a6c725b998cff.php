<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>浙江大学广播电视台内培系统——个人中心</title>
        <link rel="stylesheet" href="/eduadmin/Public/css/bootstrap.min.css">
        
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
    浙江大学广播电视台内培选课个人中心
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    </a>
    </div>
    <ul class="nav navbar-nav navbar-right">
    <li><a>你好，学生<?php echo ($username); ?>，今天是<?php echo ($date); ?></a></li>
    <li><button type="submit" class="btn btn-primary" style="
    margin-top: 6px;
    margin-left: 6px;
    margin-bottom: 6px;
    margin-right: 6px;
">回到首页</button></li>
    <li><button type="submit" class="btn btn-danger" style="
    margin-top: 6px;
    margin-left: 6px;
    margin-bottom: 6px;
    margin-right: 6px;
">退出登录</button>
      </li>
    </ul>
   </div>
   </nav>

  <div class="container-fluid">
    <div class="col-sm-3 col-xs-5">
    <div class="list-group">
  <a href="#" class="list-group-item active">菜单</a>
  <a href="/eduadmin/index.php/Home/Index/selectedCourse" target="frameBord" class="list-group-item">已选课程</a>
  <a href="/eduadmin/index.php/Home/Index/listCourse" target="frameBord" class="list-group-item">选择课程</a>
  <a href="/eduadmin/index.php/Home/Index/publishCourse" target="frameBord" class="list-group-item">发布课程</a>
  <a href="/eduadmin/index.php/Home/Index/manageCourse" target="frameBord" class="list-group-item">管理课程</a>
  
    </div>
   </div>

   <div class="col-sm-8 col-xs-7">
	   <volist id="course_info" name="course_info">
	   <table class=" table table-striped table-bordered">
	   <tbody><tr><td style="text-align: center;">课程编号</td>
	       <td style="text-align: center;">课程名称</td>
	       <td style="text-align: center;">开课地点</td>
	       <td style="text-align: center;">指导老师</td>
	       <td style="text-align: center;">开课日期</td>
	       <td style="text-align: center;">操作</td>
	    </tr>
	    <tr><td style="text-align: center;vertical-align: middle"><?php echo ($course_info["course_id"]); ?></td>
	        <td style="text-align: center;vertical-align: middle"><$course_info.name></td>
	        <td style="text-align: center;vertical-align: middle"><$course_info.classroom></td>
	        <td style="text-align: center;vertical-align: middle"><$course_info.username></td>
	        <td style="text-align: center;vertical-align: middle"><a href="#">显示上课时间</a></td>
	        <td style="text-align: center;vertical-align: middle">
	        <button type="submit" class="btn btn-danger">退课</button></td>
	      </tr>
	   </tbody></table>
   </div>
 </div>
 </body>
 </html>