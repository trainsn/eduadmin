<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    function _initialize(){
		header("Content-type:text/html;charset=utf-8");
	}
    public function index(){
        $url=U("login");
        header("Location:$url");
    }

    function login(){//登录模块
    	$this->display();
    }

    function check_login(){	//判断登录是否成功
    	session_start();
    	$type=$us['authority'];
      $api='https://api.zjubtv.com/Passport/userLogin?identity='. $_POST['userid'].'&password='. $_POST['password'];

      $c=curl_init($api);
      curl_setopt($c, CURLOPT_URL, $api);
      curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

      curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
      $return = curl_exec($c);
      $var=json_decode($return);
      curl_close($c);

      dump($var[0]);
      //if (is_object($var))
      {
        $uid=(int)$var[0];
        if ($uid==-1)
        {
          $this->error('登录失败:用户不存在，或被删除');
        }
        else if ($uid==-2)
        {
          $this->error('登录失败：密码错误');
        } 
        else if ($uid>0)
        {
          $url=U("selectedCourse");
          $_SESSION['user_id']=$uid;
          $this->assign("jumpUrl",$url);
          $this->success("登录成功");

          $user=M('User');
          $condition['user_id']=$uid;
          $us=$user->where($condition)->find();

          if (!$us)
          {
            $data['user_id']=$uid;
            $data['account']=$_POST['userid'];
            $data['username']=$_POST['userid'];
            $data['authority']='S';
            $data['password']=$_POST['password'];
            $user->add($data);
          }
          else 
          {
            $update['password']=$_POST['password'];
            $user->where($condition)->save($update);
          }
          if ($us['password']!=($_POST['password']))
          {
            $this->error("密码错误");
          }
        }
        else 
        {
           $this->error('登录失败：未知错误');
        }
      }      
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

    function check_authority(){
      $user=M('User');
      $condition['user_id']=$_SESSION['user_id'];
      $us=$user->where($condition)->find();
      if ($us['authority']=='S')
        $this->error('无权限访问');
    }

    function admin_exit(){
    	unset($_SESSION['user_id']);
    	$url=U("login");
    	$this->assign("jumpUrl",$url);
    	$this->success("退出成功");
    }

    function listCourse(){  //课程列表
    	$this->check_logined();
    	$course=M("Course");
    	$count=$course->count();
    	$listRow=10;

      $course_info=$course->join('info_User on info_course.teacher = info_user.user_id')->select();
     
      for ($i=0;$i<count($course_info);$i++)
      {
        switch ($course_info[$i]['suit']) {
        case 0:
          $course_info[$i]['suita']='记者主持';
          break;
        case 1:
          $course_info[$i]['suita']='摄影剪辑';
          break;
        case 2:
          $course_info[$i]['suita']='网维组';
          break;
        }
      }
      
      //dump($course_info);
      $this->assign("course_info",$course_info);
    	$this->display();
    }

   	function selectCourse(){	//选课操作
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

        $course_info=$selected->where("info_user.user_id=".$_SESSION["user_id"])->join('info_Course on info_selected.course_id = info_course.course_id')->join('info_User on info_course.teacher = info_user.user_id')->select();
        //dump($course_info);
        for ($i=0;$i<count($course_info);$i++)
        {
          switch ($course_info[$i]['suit']) {
          case 0:
            $course_info[$i]['suita']='记者主持';
            break;
          case 1:
            $course_info[$i]['suita']='摄影剪辑';
            break;
          case 2:
            $course_info[$i]['suita']='网维组';
            break;
          }
        }

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

    function publishCourse()
    {
      $this->check_logined();//发布课程模块
      $this->check_authority();
      $this->display();
    }

    function addCourse()//添加课程，尚未添加时间冲突
    {
      $this->check_logined();
      session_start();
      $course=M("course");
      $user=M("user");
      
      $name=$_POST['name'];
      $capacity=$_POST['capacity'];
      $classroom=$_POST['classroom'];
      if (empty($name))
        $this->error("课程名称不能为空");
      if (empty($capacity))
        $this->error("课程容量不能为空");
      if (is_numeric($capacity)==false)
        $this->error("课程容量必须为数字");
      if (empty($classroom))
        $this->error("教室不能为空");

      //dump($course->create());
      if (!$data=$course->create())
        $this->error("create失败");   
      $data['teacher']=$_SESSION['user_id'];
      $data['selectedMan']=0;
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

      $this->check_authority();

      $course=M("course");
      $condition['teacherid']=$_SESSION['user_id'];
      $course_info=$course->where($condition)->select();

      for ($i=0;$i<count($course_info);$i++)
      {
        switch ($course_info[$i]['suit']) {
        case 0:
          $course_info[$i]['suita']='记者主持';
           break;
        case 1:
          $course_info[$i]['suita']='摄影剪辑';
          break;
        case 2:
          $course_info[$i]['suita']='网维组';
          break;
        }
      }

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
        //echo "</br></br></br></br></br>";
        $id=$_GET['id'];
        $course=M("course");

        if (!$course->delete($id))
          $this->error("删除失败");
        
        $url=U("manageCourse");
        $this->assign("jumpUrl",$url);
        $this->success("删除成功");        
    }

    function editcourse() //编辑课程信息
    {
      $this->check_logined();
      $id=$_GET['id'];
      $course=M("course");
      $course_info=$course->find($id);
      $this->assign("course_info",$course_info);
      $this->display(); 
    }

    function updatecourse() 
    {
      $this->check_logined();
      session_start();
      $course=M("course");
      $user=M("user");
      //dump($_GET['id']);
      $name=$_POST['name'];
      $capacity=$_POST['capacity'];
      $classroom=$_POST['classroom'];
      if (empty($name))
        $this->error("课程名称不能为空");
      if (empty($capacity))
        $this->error("课程容量不能为空");
      if (is_numeric($capacity)==false)
        $this->error("课程容量必须为数字");
      if (empty($classroom))
        $this->error("教室不能为空");

      if (!$data=$course->create())
        $this->error();
      $data['teacherid']=$_SESSION['user_id'];
      //dump($data);
      $course->save($data);
      $this->success("修改成功");      
    }

    function listclasstime()
    {
      $this->check_logined();
      session_start();
      $classtime=M("classtime");
      $condition["course_id"]=$_GET["id"];
      $time_info=$classtime->where($condition)->select();
      for ($i=0;$i<count($time_info);$i++)
      {
        $time_info[$i]["date"]=date("Y-m-d",$time_info[$i]["endtime"]);
        $time_info[$i]["starttime"]=date("h:i:s",$time_info[$i]["starttime"]);
        $time_info[$i]["endtime"]=date("h:i:s",$time_info[$i]["endtime"]);        
      }
      
      $this->assign("time_info",$time_info);
      $this->display();
    }

    function deleteclasstime()
    {
        $this->check_logined();
        $id=$_GET['id'];
        $date=$_GET['date'];
        $starttime=$_GET['starttime'];
        $starttime=strtotime($starttime.' '.$date);
        $condition['course_id']=$id;
        $condition['startTime']=$starttime;
        dump($condition);
        
        $time_info=M("classtime");

        if (!$time_info->where($condition)->delete())
          $this->error("删除失败");
        $url=U("manageCourse");
        $this->assign("jumpUrl",$url);
        $this->success("删除成功");   
    }

    function editclasstime() //编辑课程信息
    {
      $this->check_logined();
      $time_info['course_id']=$_GET['id'];
      $time_info['date']=$_GET['date'];
      $time_info['starttime']=$_GET['starttime'];
      $time_info['endtime']=$_GET['endtime'];

      $this->assign("time_info",$time_info);
      $this->display(); 
    }

    function updateclasstime()
    {
        $this->check_logined();
        //echo "</br></br></br></br></br>";
        $date=$_POST['date'];
        $starttime=$_POST['starttime'];
        $endtime=$_POST['endtime'];
        if(empty($date))
          $this->error("日期不能为空");
        if (empty($starttime))
          $this->error("开始日期不能为空");
        if (empty($endtime))
          $this->error("结束日期不能为空");
        $data['starttime']=strtotime($starttime.' '.$date);
        $data['endtime']=strtotime($endtime.' '.$date);

        $date=$_GET['date'];
        $starttime=$_GET['starttime'];
        $condition['course_id']=$_GET['id'];
        $condition['starttime']=strtotime($starttime.' '.$date);
        
        dump($data);
        dump($condition);
        $time_info=M("classtime");

        $Model = new \Think\Model();
        $Model->execute('update info_classtime set starttime='.$data['starttime'].',endtime='.$data['endtime'].' where course_id='.$condition['course_id'].' and starttime='.$condition['starttime'].';');
            
        $url=U('manageCourse');
        $this->assign("jumpUrl",$url);
        $this->success("更新成功");   
    }

    function publishclasstime()
    {
      $this->check_logined();
      $course_id=$_GET['id'];
      $this->assign('course_id',$course_id);
      $this->display();
    }

    function addclasstime()
    {
        $this->check_logined();
        $data['course_id']=$_GET['id'];
        $date=$_POST['date'];
        $starttime=$_POST['starttime'];
        $endtime=$_POST['endtime'];
        if(empty($date))
          $this->error("日期不能为空");
        if (empty($starttime))
          $this->error("开始日期不能为空");
        if (empty($endtime))
          $this->error("结束日期不能为空");

        $data['startTime']=strtotime($starttime.' '.$date);
        $data['endTime']=strtotime($endtime.' '.$date);
        dump($data);

        $classtime=M("classtime");
        if (!$classtime->add($data))
         $this->error("发布失败");
        $url=U("manageCourse");
        $this->assign("jumpUrl",$url);
        $this->success("发布成功");  
    } 

    function stulistclasstime()
    {
      $this->check_logined();
      session_start();
      $classtime=M("classtime");
      $condition["course_id"]=$_GET["id"];
      $time_info=$classtime->where($condition)->select();
      for ($i=0;$i<count($time_info);$i++)
      {
        $time_info[$i]["date"]=date("Y-m-d",$time_info[$i]["endtime"]);
        $time_info[$i]["starttime"]=date("h:i:s",$time_info[$i]["starttime"]);
        $time_info[$i]["endtime"]=date("h:i:s",$time_info[$i]["endtime"]);        
      }
      
      $this->assign("time_info",$time_info);
      $this->display();
    }
}