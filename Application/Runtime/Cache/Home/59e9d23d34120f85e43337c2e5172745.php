<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>浙江大学广播电视台内培系统——选课页面</title>
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
    浙江大学广播电视台内培——管理课程
    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
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
   <div class="col-sm-10 col-xs-7">
   
   <table class=" table table-striped table-bordered">
   <tbody><tr><td style="text-align: center;">课程编号</td>
       <td style="text-align: center;">上课日期</td>
       <td style="text-align: center;">开始时间</td>
       <td style="text-align: center;">结束时间</td>
       <td style="text-align: center;">操作</td>
    </tr>
    <?php if(is_array($time_info)): $i = 0; $__LIST__ = $time_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$time_info): $mod = ($i % 2 );++$i;?><tr><td style="text-align: center;vertical-align: middle"><?php echo ($time_info["course_id"]); ?></td>
        <td style="text-align: center;vertical-align: middle"><?php echo ($time_info["date"]); ?></td>
        <td style="text-align: center;vertical-align: middle"><?php echo ($time_info["starttime"]); ?></td>
        <td style="text-align: center;vertical-align: middle"><?php echo ($time_info["endtime"]); ?></td>
        <td style="text-align: center;vertical-align: middle;"><a href="/eduadmin/index.php/Home/Index/editclasstime/id/<?php echo ($time_info["course_id"]); ?>/date/<?php echo ($time_info["date"]); ?>/starttime/<?php echo ($time_info["starttime"]); ?>/endtime/<?php echo ($time_info["endtime"]); ?>">编辑</a>/<a href="/eduadmin/index.php/Home/Index/deleteclasstime/id/<?php echo ($time_info["course_id"]); ?>/date/<?php echo ($time_info["date"]); ?>/starttime/<?php echo ($time_info["starttime"]); ?>">删除</td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
   </tbody></table>
   </div>
    
   </div>
        <script src="/eduadmin/Public/js/jquery-1.12.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/eduadmin/Public/js/bootstrap.min.js"></script>
    
</body></html>