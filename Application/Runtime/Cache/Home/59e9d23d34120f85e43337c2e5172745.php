<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理界面</title>
<link href="/eduadmin/Public/css/page.css" rel="stylesheet" type="text/css" />
<link href="/eduadmin/Public/css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
     table{
        width:902px;
        margin:0px;
        padding:0px;
     }
     td{
       width:150px;
       padding:0px;
       margin:0px;
       height:20px;
       line-height:20px;
       text-align:center;
     }
	 td.id{
       width:70px;
     }
	 td.total{
       width:60px;
     }
     td.edit{
       width:102px;
     }
     a,a:visited{
        text-decoration:none;
     }
     a:hover{
        text-decoration:underline;
     }
     .green-black {
	     padding-left:350px;
	     text-align:left;
}
</style>
</head>
<body id="page">
<h2>管理课程</h2>
<table>
  <tr><th>课程编号</th>
 <th>上课日期</th><th>开始时间</th><th>结束时间</th><th>操作</th></tr>
  <?php if(is_array($time_info)): $i = 0; $__LIST__ = $time_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$time_info): $mod = ($i % 2 );++$i;?><tr>
    <td class="id"><?php echo ($time_info["course_id"]); ?></td>
    <td class="total"><?php echo ($time_info["date"]); ?></td>
    <td class="total"><?php echo ($time_info["starttime"]); ?></td>
    <td class="total"><?php echo ($time_info["endtime"]); ?></td>
   <td class="edit"><a href="/eduadmin/index.php/Home/Index/editclasstime/id/<?php echo ($time_info["course_id"]); ?>/date/<?php echo ($time_info["date"]); ?>/starttime/<?php echo ($time_info["starttime"]); ?>/endtime/<?php echo ($time_info["endtime"]); ?>">编辑</a>/<a href="/eduadmin/index.php/Home/Index/deleteclasstime/id/<?php echo ($time_info["course_id"]); ?>/date/<?php echo ($time_info["date"]); ?>/starttime/<?php echo ($time_info["starttime"]); ?>">删除</td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<br>
</body>
</html>