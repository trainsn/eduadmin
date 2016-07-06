<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    function _initialize(){
		header("Content-type:text/html;charset=utf-8");
	}
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $url=U("login");
        header("Location:$url");
    }

    function login(){//登录模块
    	$this->display();
    }
    function check_login(){	//判断登录是否成功
    	session_start();
    	$user=M('User');
    	$condition['user_id']=$_POST['userid'];
    	$us=$user->where($condition)->find();

    	if (!$us)
    	{
    		$this->error("没有此用户");
    	}
    	if ($us['password']!=($_POST['password']))
    	{
    		$this->error("密码错误");
    	}

    	$type=$us['authority'];
    	switch ($type) {
    		case 'S':
    			$url=U("student");
    			break;
    		case 'T':
    			$url=U("teacher");
    			break;
    		case 'A':
    			$url=U("admin");
    			break;
    	}

    	$_SESSION['user_id']=$_POST['userid'];
    	$this->assign("jumpUrl",$url);
    	$this->success("登录成功");
    }

    function check_logined(){	//检测是否已经登录
    	session_start();
    	$user=M('User');
    	$condition['user_id']=$_SESSION['user_id'];
    	$us=$user->where($condition)->find();
    	if(!$us)
    	{
    		$url=U('login');
    		$this->assign("jumpUrl",$url);
    		$this->error("还没有登录");
    	}
    }

    function admin_exit(){
    	unset($_SESSION['user_id']);
    	$url=U("login");
    	$this->assign("jumpUrl",$url);
    	$this->success("退出成功");
    }

    function student(){		//学生管理首页
    	$this->check_logined();
    	session_start();
    	$user=M('User');
    	$condition['user_id']=$_SESSION['user_id'];
    	$us=$user->where($conditon)->find();
    	$username=$us['name'];
    	$date=date("Y年m月d日",time());
    	$this->assign('username',$username);
    	$this->display();
    }

    function student_page(){	//学生管理首页信息
    	$this->check_logined();
    	$this->display();
    }

    function listCourse(){  //课程列表
    	$this->check_logined();
    	$course=M("Course");
    	$count=$course->count();
    	$listRow=10;
    	//$Page = new \THINK\PAGE($count,$listRow);//实例化分页类，传入总记录数和每页显示的数目
    	//$show =$Page->show(); //分页显示输出
    	//进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$course_info=$course->order('course_id')->select();
    	//$displaypage=0;
    	//if(count($course_info)>0) $displaypage=1;

    	//$this->assign("displaypage",$displaypage);
    	//$this->assign("page",$show);
    	//$this->assign("pagestyle","green-black");
    	$this->assign("course_info",$course_info);
    	$this->display();
    }

   	function selectCourse(){	//选课操作
      echo "</br></br></br></br>";
   		$this->check_logined();
   		session_start();
   		$id=$_GET['id'];
   		$selected=M('selected');

   		$condition['user_id']=$_SESSION['user_id'];
   		$condition['course_id']=$id;
   		if ($selected->where($condition)->find())
   		{
   			$this->error("已经选过");
   		}

   		$course=M("course");
   		$course_info=$course->find($id);
   		$classtime=M('classtime');
      //echo $id;
      //die($id) ;
   		$classtime_info=$classtime->where("course_id=$id")->select();//当前要选择的课程的上课时间
      //dump($classtime_info);

   		$condition1['user_id']=$_SESSION['user_id'];
      $selected_info=$selected->where($condition1)->select();//学生当前选的所有课程

   		for ($i=0;$i<count($selected_info);$i++)
   		{
   			$course_id[$i]=$selected_info[$i]['course_id'];
   		}
   		for ($i=0;$i<count($course_id);$i++)
   		{
   			//$course_info2=$course->find($course_id[$i]);
   			$classtime_info2=$classtime->where("course_id=$course_id[$i]")->select();
        //dump($classtime_info2);
   			for ($j=0;$j<count($classtime_info);$j++)
   				for ($k=0;$k<count($classtime_info2);$k++)
   				{
   					$stTime1=$classtime_info[$j]['starttime'];
   					$stTime2=$classtime_info2[$k]['starttime'];
   					$enTime1=$classtime_info[$j]['endtime'];
   					$enTime2=$classtime_info2[$k]['endtime'];
            //dump($stTime1);
            //dump($stTime2);
            //dump($enTime1);
            //dump($enTime2);

   					if ($stTime2>$stTime1 && $stTime2<$enTime1)
   					{
              $this->error("上课时间冲突");
   					}
   					if ($enTime2>$stTime1 && $enTime2<$enTime1)
   					{
              $this->error("上课时间冲突");
   					}
            if ($stTime2<$stTime1 && $enTime2>$enTime1)
            {
              $this->error("上课时间冲突");
            }
   				}
   		}

   		if ($course_info['selectedMan']>=$course_info['capacity'])
   			$this->error("名额已满");

   		$data['course_id']=$id;
   		$data['user_id']=$_SESSION['user_id'];
   		if (!$selected->add($data))
   			$this->error("选课失败");
   		if (!$course->where("course_id=$id")->setInc('selectedMan',1))
   			$this->error("选课失败");
   		$this->success("选课成功");
   	}

   	function  selectedCourse()  //已经选过课程信息
    {
        $this->check_logined();
        session_start();
        $selected=M("selected");
        $course_info=$selected->where("user_id=$_SESSION[user_id]")->join('info_Course on info_selected.course_id = info_course.course_id')->select();
        //echo count($selected_info);
       /* for ($i=0;$i<count($selected_info);$i++)
        {
            //echo $i;
            $course_id[$i]=$selected_info[$i]['course_id'];
        }
        $course=M("Course")
        $course->join('selected ON selected.course_id = Course.user_id')->;
        $condition['$course_id']=array('in',$course_id);
        $course_info=$course->where($condition)->select();*/
        $export=0;
        if (count($course_info)>0)
          $export=1;
        //echo $export;
        $this->assign("export",$export);
        $this->assign("course_info",$course_info);
        $this->display();
    }

    function quitCourse() //退课操作
    {
         $this->check_logined();
         $id=$_GET['id'];
         $selected=M('selected');
         if (!$selected->where("course_id=$id")->delete())
            $this->error("退课失败");
         $course=M("Course");
         if (!$course->where("course_id=$id")->setDec('selectedMan',1))
          $this->error("退课失败");
        $this->success("退课成功");
    }

    function editPassword() //修改学生密码
    {
        $this->check_logined();
        $this->display();
    }
    
    function updatePassword() //更新学生密码操作
    {
        $this->check_logined();
        session_start();
        $user=M("user");
        $oldpass=($_POST['oldpass']);
        $condition['password']=$oldpass;
        if (!$userInfo=$user->where($condition)->select())
          $this->error("旧密码错误");
        $newpass=($_POST['newpass']);
        $condition['user_id']=$_SESSION['user_id'];
        $data['password']=$newpass;
        if (!$user->where($condition)->save($data))
          $this->error("修改失败");
        $this->success("修改成功");
    }

    function publishCourse()
    {
      $this->check_logined();//发布课程模块
      $this->display();
    }

    function addCourse()//添加课程，尚未添加时间冲突
    {
      $this->check_logined();
      session_start();
      $course=M("course");
      if (!$data=$course->create())
        $this->error();
      $data['teacher']=$_SESSION['user_id'];
      //$condition['teacher']=$_SESSION['user_id'];
      if (!$course->add($data))
        $this->error("发布失败");
      $url=U("publishCourse");
      $this->assign("jumpUrl",$url);
      $this->success("发布成功");      
    }

    function manageCourse()//管理课程，尚未添加时间冲突
    {
      $this->check_logined();
      session_start();
      $course=M("course");
      $condition['teacher']=$_SESSION['user_id'];
      $course_info=$course->where($condition)->select();
      $displaypage=0;
      if (count($course_info)>0)//如果有课程信息才显示分页
        $displaypage=1;
      $this->assign("displaypage",$displaypage);
      $this->assign("course_info",$course_info);
      $this->display();      
    }

    function deleteCourse()//删除课程信息
    {
        $this->check_logined();
        echo "</br></br></br></br></br>";
        $id=$_GET['id'];
        dump($id);
        $course=M("course");

        if (!$course->delete($id))
          $this->error("删除失败");
        
        $url=U("manageCourse");
        $this->assign("jumpUrl",$url);
        $this->success("删除成功");        
    }

    function editCourse()
    {
      
    }
}