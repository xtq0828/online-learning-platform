<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生信息</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
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
	my_msg("该用户不存在","../login.php");
}
mysql_free_result($result);
mysql_close($link);
?>
<div class="zhong">
  
  <div class="banner"><img src="../images/img_2.gif" /></div>
  <div class="menu">
    <div class="menusel" style="width:95px;">
      <h2><a href="tea_index.php">首页</a></h2>
    </div>
    <div id="menu1" class="menusel">
       <h2><a href="../xiangqing.php">了解我们</a></h2>
      <div class="position">
        
      </div>
    </div>
    <div id="menu2" class="menusel">
      <h2><a>课程内容</a></h2>
      <div class="position">
        
      </div>
    </div>
    <div id="menu3" class="menusel">
      <h2><a href="tea_notice.php">公告信息</a></h2>
      <div class="position">
        
      </div>
    </div>
    <div id="menu4" class="menusel">
       <h2><a href="tea_upload">资源下载</a></h2>
      <div class="position">
        
      </div>
    </div>
    <div id="menu5" class="menusel">
      <h2><a href="newwork.php">创建作业</a></h2>
      <div class="position">
        
      </div>
    </div>
    <div id="menu6" class="menusel">
      <h2><a>讨论区</a></h2>
      <div class="position">
        
      </div>
    </div>
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
      <form action="addonestu_chk.php" method="post"><img src="../images/img_8.gif" style="float:left"/>
<div class="news">学生姓名：
  <textarea name="Stu_name" id="Stu_name" rows="1" cols="80" ><?=$stu_name?></textarea></div>
      <div class="news">学生学号：
      <textarea name="Stu_no" id="Stu_no" rows="1" cols="80"><?=$stu_no?></textarea></div>
      <div class="news">学生班级：
  <textarea name="Stu_class" id="Stu_class" rows="1" cols="80" ><?=$stu_class?></textarea></div>
  
 
       <input  style="float:left" name="input" type="image" src="../images/img_63.gif"></form>
    <input  name="input" type="image" src="../images/img_66.gif" onclick="javascript:window.location.href='stu_xinxi.php'"></div>
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
    版权所有<a></a></div>

<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
