<?php
    session_start();
	$lifeTime = 1800;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生信息</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
</head>
<body>

<?php
    
	include_once("../sql_connect.php");
    include_once("../my_msg.php");
    mysql_query("set names utf8");
    $sqlstr="select * from user where User_no =".$_SESSION['user_no'];
	$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_array($result, MYSQL_BOTH);

if(mysql_num_rows ($result)==1 ){
	$User_realname= $row["User_realname"];
	$User_no= $row["User_no"];
}else{
	session_destroy();
	my_msg("该用户不存在","login.html");
}
mysql_free_result($result);

$sqlstr="select * from user,model_detial where user.User_no=model_detial.Stu_no and user.ID=".$_GET["id"];
$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_row($result);
	$stu_ID=$row[0];
    $stu_name=$row[2];
	$stu_no= $row[1];
	$stu_class=$row[6];
	$stu_adept=$row[14];
	$stu_loginhabit=$row[11];
	$stu_habit=$row[15];

$sqlstr="select * from stu_model,user where stu_model.Stu_no=user.User_no and user.ID=".$_GET["id"];
	$result = mysql_query($sqlstr,$link);
	$row=mysql_fetch_row($result);
	$lastmonthlogin=$row[3];

$sqltixing="select san.User_no,topic.content_type,sum(san.score) as he from `student_answer` as san left join topic as topic on san.topic_id=topic.topic_id where san.`IsYes`='1' group by topic.`content_type`,san.User_no  ";
$resultixing = mysql_query($sqltixing,$link);
while($rowstixing=mysql_fetch_array($resultixing, MYSQL_BOTH))
	{
		$rowstixingarray[$rowstixing['User_no']][$rowstixing['content_type']]=$rowstixing[he];
	}
	
	foreach ($rowstixingarray as $key=>$value){
		$usertixing[$key]=array_search(max($value),$value);
	}

$sqlstr="select * from student_papers where User_no=".$stu_no." Order by score DESC";
$result = mysql_query($sqlstr,$link);
$row = mysql_fetch_row($result);
$x1=$row[2];
$strong_score=$row[3];

$sqlstr="select * from papers where papers_id=".$x1;
$result = mysql_query($sqlstr,$link);
$row = mysql_fetch_row($result);
$stu_strongpoint=$row[1];

$sqlstr="select * from student_papers where User_no=".$stu_no." Order by score ASC";
$result = mysql_query($sqlstr,$link);
$row = mysql_fetch_row($result);
$x2=$row[2];
$weak_score=$row[3];

$sqlstr="select * from papers where papers_id=".$x2;
$result = mysql_query($sqlstr,$link);
$row = mysql_fetch_row($result);
$stu_weakpoint=$row[1];


mysql_free_result($result);
mysql_close($link);
?>
<div class="zhong">
  
  <div class="banner"><img src="../images/img_2.gif" /></div>
   <div class="menu">
   <ul id="nav">
      <li class="mainlevel" id="mainlevel_01"><a href="tea_index.php">首页</a>
       <ul id="sub_01">
    
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_02"><a href="../xiangqing.php">了解我们</a>
    <ul id="sub_02">
    
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_03"><a href="../teacher/kecheng.php">课程学习</a>
    <ul id="sub_03">
    <li><a href="../teacher/kecheng.php?flag=1">添加课程</a></li>
    <li><a href="../teacher/biji.php?flag=2">查看学习情况</a></li>
    
    </ul>
    </li>
    
  <li class="mainlevel" id="mainlevel_04"><a href="tea_notice.php">公告信息</a>
    <ul id="sub_04">
    
    </ul>
    </li>
    
        <li class="mainlevel" id="mainlevel_07"><a href="tea_upload.php">资源下载</a>
    <ul id="sub_07">
    
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_05"><a href="newwork.php">创建作业</a>
    <ul id="sub_05">
   
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_06"><a>讨论区</a>
    <ul id="sub_06">
   
    </ul>
    </li>
    
    </ul>
  
  
  
  </div>

  <div class="meun_2">
		    <a>您好！<?=$User_realname?></a></div>
  <div class="main">
    <div class="left">
     <div class="left_title">会员中心</div>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="32%" height="37" valign="middle">工号：</td>
            <td width="68%" valign="middle">
              <?=$User_no?>
            </td>
          </tr>
          <tr>
            <td height="37" valign="middle">姓名：</td>
            <td valign="middle">
              <?=$User_realname?>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            <input name="input" type="image" src="../images/img_62.gif" onclick="javascript:window.location.href='stu_xinxi.php'"/>
            <input name="input2" type="image" src="../images/img_63.gif" onclick="javascript:window.location.href='add_stu.php'"/>
            <input name="input" type="image" src="../images/img_69.gif" onclick="javascript:window.location.href='stu_model.php'">
               <input name="input" type="image" src="../images/img_64.gif" onclick="javascript:window.location.href='../logout.php'">
            </td>
          </tr>
      </table>
      <div class="box_1">
        <div class="left_title">日历</div>
        <div class="left_nr" >
        <div id="calendar"></div> 
          <script src="../rili/jquery.min.js"></script> 
          <script src="../rili/jquery-ui-datepicker.min.js"></script> 
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
    <div class="right" style="font-size:24px;">
      <img src="../images/img_8.gif" style="float:left"/>
<div class="news"><a style="font-weight:bold">学生姓名：</a>
  <label name="Stu_name" id="Stu_name"><?=$stu_name?></label></div>
      <div class="news"><a style="font-weight:bold">学生学号：</a>
      <label name="Stu_no" id="Stu_no"><?=$stu_no?></label></div>
      <div class="news"><a style="font-weight:bold">学生班级：</a>
  <label name="Stu_class" id="Stu_class"><?=$stu_class?></label></div>
  <div class="news"><a style="font-weight:bold">拿手题型：</a>
  <label name="Stu_adept" id="Stu_adept"><?php
										switch ($usertixing[$stu_no]){
											case 1;
												echo "单选题";
												break;
											case 2;
												echo "多选题";
												break;
											case 3;
												echo "判断题";
												break;
											case 4;
												echo "填空题";
												break;
											default:
												echo "不存在";
												break;
										}
	      				
	      				?></label></div>
  <div class="news"><a style="font-weight:bold">弱项章节：</a>
  <label name="Stu_weakpoint" id="Stu_weakpoint"><?php if(isset($stu_weakpoint)){?><?=$stu_weakpoint?>（该章节学生掌握较差，得分<?=$weak_score?>）<? }else{ echo "学生尚未答题"; }?></label></div>
  <div class="news"><a style="font-weight:bold">强项章节：</a>
  <label name="Stu_strongpoint" id="Stu_strongpoint"><?php if(isset($stu_strongpoint)){?><?=$stu_strongpoint?>（该章节学生掌握较好，得分<?=$strong_score?>）<? }else{ echo "学生尚未答题"; }?></label></div>
  <div class="news"><a style="font-weight:bold">登陆习惯：</a>
  <label name="Stu_loginhabit" id="Stu_loginhabit"><?=$stu_loginhabit?>（该学生上个月登陆了<?=$lastmonthlogin?>天）</label></div>
  <div class="news"><a style="font-weight:bold">兴趣爱好：</a>
  <label name="Stu_habit" id="Stu_habit"><?=$stu_habit?></label>
  
   
    <input style="float:left" name="input" type="image" src="../images/img_66.gif" onclick="javascript:window.location.href='stu_model.php'"></div></div>
    </div>
    <div class="clear"></div>
    <div class="huoban">
      <div class="huoban_title"><img src="../images/title_2.gif" /></div>
      <div class="huoban_nr">
             <ul>
        <li><a href="http://www2.hrbust.edu.cn/xueyuan/com/lssx/index.htm"><img src="../images/1.png" /></a></li>
          <li><a href="http://59.67.71.237:8080/dis/"><img src="../images/2.png" /></a></li>
          <li><a href="http://61.150.69.30/ec/C60/kcms-1.htm"><img src="../images/3.png" /></a></li>
          <li><a href="http://202.115.138.30/ec3.0/C235/kcms-1.htm"><img src="../images/4.png" /></a></li>
          <li><a href="http://jwc.ahu.edu.cn/ec2007/C136/kcms-5.htm"><img src="../images/5.png" /></a></li>
          </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
<div class="bottom">北京理工大学<br/>版权所有<a></a></div>

<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>