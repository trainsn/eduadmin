<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    window.onload=function(){
          document.myForm.userid.focus();
    }
    function checkForm(){
          if(document.myForm.userid.value==""){
               alert('ID不能为空！！');
               document.myForm.userid.focus();
               return false;
          }
          if(document.myForm.password.value==""){
               alert('密码不能为空！！');
               document.myForm.password.focus();
               return false;
          }
    }
</script>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>浙江大学广播电视台内培系统</title>
        <link rel="stylesheet" href="/eduadmin/Public/css/bootstrap.min.css">
        
    </head>

    <body>
         <div class="container-fluid"style="opacity: 1.0">
          <div class="jumbotron">
            <div class="container">
                 <div class="row">
                      <img class="col-xs-4 col-sm-2" src="/eduadmin/Public/logo2.jpg">
                      <div class="col-xs-6 col-sm-4 text">
                         <h1>欢迎来到</h1>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-10">
                         <h1><strong>浙江大学广播电视台内培系统</strong></h1>
                      </div>
                 </div>
                 
             </div>
          </div>

             <div class="panel panel-primary col-md-offset-4 col-xs-12 col-md-4">
                <div class="panel-heading"><strong>Log in</strong></div>
                <div class="panel-body">
                  <form class="form-horizontal" action="/eduadmin/index.php/Home/Index/check_login" target='_self'id="loginForm" method="post" name="myForm" onSubmit="return checkForm();">
                     <div class="form-group">
                      <label class="col-sm-3 col-xs-4 control-label" for="form-username"><h4>用户名ID</h4></label>
                      <div class="col-sm-8 col-xs-8">
                      <input type="text" name="userid" placeholder="请输入用户名" class="form-username form-control" id="form-username" style="height:50px">
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 col-xs-4 control-label" for="form-password"><h4>密码</h4></label>
                      <div class="col-sm-8 col-xs-8">
                      <input type="password" name="password" placeholder="请输入密码" class="form-password form-control" id="form-password" style="height: 50px">
                      </div>
                      </div>                      
                      <!--<div class="form-group">
                         <div class="col-sm-offset-3 col-xs-offset-5">
                             <div class="checkbox">
                               <label>
                                  <input type="checkbox">记住密码
                               </label>
                          </div>
                        </div>
                      </div>-->
                       <div class="form-group">
                        <div class="col-xs-offset-3">
                           <button class="btn btn-primary btn-lg" type="submit" >登录</button>
                           <button class="btn btn-danger btn-lg" type="submit">忘记密码</button>
                        </div> 
                      </div>
                      </form>
                  </div>
            </div>
          </div>
    
        <script src="/eduadmin/Public/js/jquery-1.12.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/eduadmin/Public/js/bootstrap.min.js"></script>
    </body>
</html>