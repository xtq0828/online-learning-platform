<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加公告</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<link rel="StyleSheet"  href="../ASCIIMathML.js" type="text/javascript"/>
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<script type="text/javascript" src="../ASCIIMathML.js"></script>
</head>
<body>

<?php
    
	include_once("../sql_connect.php");
  include_once("../my_msg.php");
  //my_msg2($_SESSION['user_no']);
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
              <input name="input" type="image" src="../images/img_63.gif" onclick="javascript:window.location.href='add_stu.php'"/>
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
    <div class="right">
      <form action="addnotice_chk.php" method="post"><img src="../images/img_8.gif" style="float:left"/>
<div class="news">公告题目：<textarea name="Notice_title" id="Notice_title" rows="1" cols="80"></textarea></div>
      <div class="news">公告内容：<textarea name="Notice_content" id="Notice_content" rows="10" cols="80"></textarea>
    <input  style="float:left" name="input" type="image" src="../images/img_65.gif"></form>
    <input  name="input" type="image" src="../images/img_66.gif" onclick="javascript:window.location.href='tea_notice.php'"></div>
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
  <div class="bottom">北京理工大学<br />
    版权所<a></a></div>
</div>
<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
