<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理界面</title>
<link href="/eduadmin/Public/css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
     table{
        width:900px;
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
     td.credit{
       width:50px;
     }
     input{
        width:148px;
        margin:0px;
        padding:0px;
        height:20px;
        line-height:20px;
        text-align:center;
        font-size:14px;
     }
     input.publish{
        width:96px;
     }
     select{
        width:48px;
        margin:0px;
        padding:0px;
        height:20px;
        line-height:20px;
     }
     select.week{
        width:63px;
        float:left;
     }
     select.jie{
        width:87px;
     }
</style>
<script type="text/javascript">
     window.onload=function(){
          document.myform.no.focus();
     }
     function check(){
     if(document.myform.no.value==""){
          alert('课程编号不能为空！！');
          document.myform.no.focus();
          return false;
     }
     if(isNaN(document.myform.no.value)){
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
     if(document.myform.place.value==""){
          alert('上课教室不能为空！！');
          document.myform.place.focus();
          return false;
     }
   }
</script>
</head>
<body id="page">
<h2>修改课程</h2>
<form action="/eduadmin/index.php/Home/Index/updateclasstime/id/<?php echo ($time_info["course_id"]); ?>/date/<?php echo ($time_info["date"]); ?>/starttime/<?php echo ($time_info["starttime"]); ?>/" method="post" name="myform" onsubmit="return check();">
<table>
  <tr><th>上课日期</th>
  <th>开始时间</th> 
  <th>结束时间</th><th>操作</th></tr>
  <tr>
    <td><input type="text" name="date" value="<?php echo ($time_info["date"]); ?>"></td>
    <td><input type="text" name="starttime" value="<?php echo ($time_info["starttime"]); ?>"></td>
    <td><input type="text" name="endtime" value="<?php echo ($time_info["endtime"]); ?>"></td>
   <td><input type="submit" name="submit" value="修改" class="publish"></td>
  </tr>
</table>
</form>
</body>
</html>