<?php
    session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公告信息</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<style>
#myDiv{ 
    height:350px;                                     /*调整显示区的高*/ 
    line-height:18px; 
    overflow-pageINdex:hidden; 
    overflow:auto;
    word-break:break-all; 
} 
</style>

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
	$User_class= $row["User_class"];
}else{
	session_destroy();
	my_msg("您不在线上！","../login.php");
}
mysql_free_result($result);

$sqlstr="select * from notice Order by Notice_time DESC";
	$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_row($result);
    $new_notice=$row[2];
	$new_notice_time= $row[3];
	$new_notice_name= $row[4];
	
	$notice="
	<tr>
  		<td width=\"48%\" height=\"18\"><a href='stu_notice_content.php?id=".$row[0]."'>".$row[1]."</a></td>
       <td width=\"27%\">".$row[4]."</td>
        <td width=\"25%\" align=\"center\">".$row[3]."</td>
   </tr>";
	while($row=mysql_fetch_row($result))
	{
		$notice=$notice."
	<tr>
  		<td width=\"48%\" height=\"18\"><a href='stu_notice_content.php?id=".$row[0]."'>".$row[1]."</a></td>
       <td width=\"27%\">".$row[4]."</td>
        <td width=\"25%\" align=\"center\">".$row[3]."</td>
   </tr>";
	}
	

mysql_free_result($result);

mysql_close($link);
?>
<div class="zhong">
  
  <div class="banner"><img src="../images/img_2.gif" /></div>
  <div class="menu">
   <ul id="nav">
      <li class="mainlevel" id="mainlevel_01"><a href="stu_index.php">首页</a>
       <ul id="sub_01">
    
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_02"><a href="../xiangqing.php">了解我们</a>
    <ul id="sub_02">
    
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_03"><a>课程学习</a>
    <ul id="sub_03">
    <li><a href="stu_kecheng.php">自学课程</a></li>
    <li><a href="biji.php">查看学习情况</a></li>
    
    </ul>
    </li>
    
  <li class="mainlevel" id="mainlevel_04"><a href="stu_notice.php">公告信息</a>
    <ul id="sub_04">
    
    </ul>
    </li>
    
        <li class="mainlevel" id="mainlevel_07"><a href="resource.php">资源下载</a>
    <ul id="sub_07">
    
    </ul>
    </li>
    
    <li class="mainlevel" id="mainlevel_05"><a href="onlineworklist.php">在线作业</a>
    <ul id="sub_05">
   
    </ul>
    </li>
    
    </ul>
  
  
  
  </div>

  <div class="meun_2">
		   <a>您好！<?=$User_realname?></a>
		  </div>
  <div class="main">
    <div class="left">
      <div class="left_title">会员中心</div>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="32%" height="37" valign="middle">学号：</td>
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
            <td height="37" valign="middle">班级：</td>
            <td valign="middle">
              <?=$User_class?>
             </td>
          </tr>
          <tr>
            <td colspan="2">
             <input name="input" type="image" src="../images/img_64.gif" onclick="javascript:window.location.href='../logout.php'">
            </td>
          </tr>
          </table>
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
      <div class="right_title"><img src="../images/title_11.gif" />
        
      </div>
      <div class="liebiao">
        <div id="myDiv"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <?=$notice?>
          
        </table></div>
          <div class="clear"></div>
        </ul>
      </div>
      
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
  <div class="bottom">北京理工大学软件学院<br/>
    版权所有<a></a> </div>
</div>
<script src="../js/meun.js" type="text/javascript"></script>
</body>
</html>
