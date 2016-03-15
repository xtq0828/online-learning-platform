<?php
    session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>详细情况</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<link href="css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="css/dtree.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/slide.js"></script>
</head>
<body>

<?php
  if(isset($_SESSION['user_no']))  
  {
	  include_once("sql_connect.php");
      include_once("my_msg.php");
      mysql_query("set names utf8");
      $sqlstr="select * from user where User_no =".$_SESSION['user_no'];
	  $result = mysql_query($sqlstr,$link);
	  $row = mysql_fetch_array($result, MYSQL_BOTH);
      if(mysql_num_rows ($result)==1 ){
	  $User_nickname= $row["User_nickname"];
	  $User_realname= $row["User_realname"];
	  $User_no= $row["User_no"];
	  }
  
mysql_free_result($result);
mysql_close($link);
  }
?>

<div class="zhong">
  
  <div class="banner"><img src="images/img_2.gif" /></div>
    <div class="menu">
   <ul id="nav">
       <li class="mainlevel" id="mainlevel_01"> <?php
           if($_SESSION['type']==1)
		   {?>
		    <a href="teacher/tea_index.php"> 首页</a>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		    <a href="student/stu_index.php"> 首页</a>
		  <?php }?>
          
          <?php
               if($_SESSION['type']!=2&&$_SESSION['type']!=1)
			   {?>
				    <a href="login.php"> 首页</a>
			   <?php }?>
     <ul id="sub_01">
    
    </ul>
    </li>

     <li class="mainlevel" id="mainlevel_02"><a href="#">了解我们</a>
    <ul id="sub_02">
    
    </ul>
    </li>
    
    
    <?php
           if($_SESSION['type']==1)
		   {?>
		    <li class="mainlevel" id="mainlevel_03"><a>课程学习</a>
    <ul id="sub_03">
    <li><a href="teacher/kecheng.php?flag=1">添加课程</a></li>
    <li><a href="teacher/biji.php?flag=2">查看学习情况</a></li>
    
    </ul>
    </li>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		   <li class="mainlevel" id="mainlevel_03"><a>课程学习</a>
    <ul id="sub_03">
    <li><a href="student/stu_kecheng.php">自学课程</a></li>
    <li><a href="student/biji.php">查看学习情况</a></li>
    
    </ul>
    </li>
		  <?php }?>
    <?php
           if($_SESSION['type']==1)
		   {?>
		    <li class="mainlevel" id="mainlevel_04">
      <a href="teacher/tea_notice.php"> 公告信息</a>
 <ul id="sub_04">
    
    </ul>
    </li>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		   <li class="mainlevel" id="mainlevel_04">
      <a href="student/stu_notice.php"> 公告信息</a>
 <ul id="sub_04">
    
    </ul>
    </li>
		  <?php }?>
          
          
      
    <?php
           if($_SESSION['type']==1)
		   {?>
		   <li class="mainlevel" id="mainlevel_05">
      <a href="teacher/tea_upload.php"> 资源下载</a>
   <ul id="sub_05">
    
    </ul>
    </li>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		<li class="mainlevel" id="mainlevel_05">
      <a href="student/resource.php"> 资源下载</a>
   <ul id="sub_05">
    
    </ul>
    </li>
     <?php }?>
     
     
     <?php
           if($_SESSION['type']==1)
		   {?>
		   <li class="mainlevel" id="mainlevel_05">
      <a href="teacher/newwork.php"> 创建作业</a>
   <ul id="sub_05">
    
    </ul>
    </li>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		<li class="mainlevel" id="mainlevel_05">
      <a href="student/onlineworklist.php"> 在线作业</a>
   <ul id="sub_05">
    
    </ul>
    </li>
     <?php }?>

    </ul>
  
  
  
  </div>
  <div class="meun_2">
  <?php
           if($_SESSION['type']==1)
		   {?>
		    <a>您好！<?=$User_realname?></a>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		   <a>您好！<?=$User_realname?></a>
		  <?php }?>
          
          <?php
               if($_SESSION['type']!=2&&$_SESSION['type']!=1)
			   {?>
				    <a>您好！游客</a>
			   <?php }?>
  
  
  
  </div>
  <div class="main">
    <div class="left">
      <div class="box_1">
        <div class="left_title">新闻信息</div>
        <div class="left_news">
          <ul>
            <li><a href="#" class="hover">学校简介</a></li>
            <li><a>学院信息</a></li>
            <li><a>联系我们</a></li>
          </ul>
        </div>
      </div>
      <div class="box_1">
        <div class="left_title">日历</div>
        <div class="left_nr" >
        <div id="calendar"></div> 
          <script src="rili/jquery.min.js"></script> 
          <script src="rili/jquery-ui-datepicker.min.js"></script> 
<script> 
	$('#calendar').datepicker({
		inline: true,
		firstDay: 1,
		showOtherMonths: true,
		dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
	});
</script> 
        </div>
      </div>
    </div>
    <div class="right">
      <div class="right_title"><b>北京理工大学</b>
        <div>首页 > 了解我们 > <span>学校简介</span></div>
      </div>
      <div class="xiangqing">
        <div class="laiyuan">来源：www.bit.edu.cn     发布时间：2012-04-26</div>
        北京理工大学： <br />
        <br />
        北京理工大学，简称北理工，英文为Beijing Institute of Technology，缩写为BIT<br />
        北京理工大学是“理工为主，工理文协调发展”的全国重点大学<br />
        隶属于中华人民共和国工业和信息化部<br />
        首批设立研究生院，是首批“211工程”和“985工程”重点建设高校<br />
        该校前身是1940年创建于延安的延安自然科学院，是中国共产党创办的第一所理工科大学<br />
        后转战华北，更名为华北大学工学院<br />
        新中国成立后迁入北京，与著名的中法大学合并<br />
        是新中国历史上第一所新型的、正规化的重工业大学，更名为北京工业学院<br />
        1988年，定名为北京理工大学</div>
    </div>
    <div class="clear"></div>
    <div class="huoban">
      <div class="huoban_title"><img src="images/title_2.gif" /></div>
      <div class="huoban_nr">
      <ul>
        <li><a href="http://www2.hrbust.edu.cn/xueyuan/com/lssx/index.htm"><img src="images/1.png" /></a></li>
          <li><a href="http://59.67.71.237:8080/dis/"><img src="images/2.png" /></a></li>
          <li><a href="http://61.150.69.30/ec/C60/kcms-1.htm"><img src="images/3.png" /></a></li>
          <li><a href="http://202.115.138.30/ec3.0/C235/kcms-1.htm"><img src="images/4.png" /></a></li>
          <li><a href="http://jwc.ahu.edu.cn/ec2007/C136/kcms-5.htm"><img src="images/5.png" /></a></li>
          </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="bottom">北京理工大学软件学院<br/>
    版权所有<a></a> </div>
</div>
<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
