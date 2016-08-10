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
    <li><a href="javascript:ms=confirm('确定退出');ms?location.href='/eduadmin/index.php/Home/Index/admin_exit':history.go(0)" target="_self">退出</a></li>
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
     <table class=" table table-striped table-bordered">
     <tbody><tr><td style="text-align: center;">课程编号</td>
         <td style="text-align: center;">课程名称</td>
         <td style="text-align: center;">开课地点</td>
         <td style="text-align: center;">指导老师</td>
         <td style="text-align: center;">已选/容量</td>
         <td style="text-align: center;">开课日期</td>
         <td style="text-align: center;">操作</td>
      </tr>
      <?php if(is_array($course_info)): $i = 0; $__LIST__ = $course_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course_info): $mod = ($i % 2 );++$i;?><tr><td style="text-align: center;vertical-align: middle"><?php echo ($course_info["course_id"]); ?></td>
          <td style="text-align: center;vertical-align: middle"><?php echo ($course_info["name"]); ?></td>
          <td style="text-align: center;vertical-align: middle"><?php echo ($course_info["classroom"]); ?></td>
          <td style="text-align: center;vertical-align: middle"><?php echo ($course_info["username"]); ?></td>
          <td style="text-align: center;vertical-align: middle"><?php echo ($course_info["selectedman"]); ?>/<?php echo ($course_info["capacity"]); ?></td>
          <td style="text-align: center;vertical-align: middle"><a href="/eduadmin/index.php/Home/Index/stulistclasstime/id/<?php echo ($course_info["course_id"]); ?>">显示上课时间</a></td>
          <td style="text-align: center;vertical-align: middle">
          <a href="/eduadmin/index.php/Home/Index/selectCourse/id/<?php echo ($course_info["course_id"]); ?>">选课</td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
     </tbody></table>
   </div>
 </div>
 </body>
 </html>