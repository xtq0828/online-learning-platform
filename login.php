<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>离散数学在线学习系统</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<link href="css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="css/dtree.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/slide.js"></script>

</head>
<body>
<?php

    include_once("sql_connect.php");
    include_once("my_msg.php");
    mysql_query("set names utf8");
    $sqlstr="select * from notice Order by Notice_time DESC limit 10 offset 0";
	$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_row($result);
    $new_notice=$row[2];
	$new_notice_time= $row[3];
	$new_notice_name= $row[4];
	
	$notice="
	<tr>
  		<td width=\"48%\" height=\"18\"><a>".$row[1]."</a></td>
       <td width=\"27%\">".$row[4]."</td>
        <td width=\"25%\" align=\"center\">".$row[3]."</td>
   </tr>";
	while($row=mysql_fetch_row($result))
	{
		$notice=$notice."
	<tr>
  		<td width=\"48%\" height=\"18\"><a>".$row[1]."</a></td>
       <td width=\"27%\">".$row[4]."</td>
        <td width=\"25%\" align=\"center\">".$row[3]."</td>
   </tr>";
	}
	

mysql_free_result($result);
mysql_close($link);
?>



<div class="zhong">

  <div class="banner"><img src="images/img_2.gif" /></div>
  <div class="menu">
    <ul id="nav">
    <li class="mainlevel" id="mainlevel_01"><a href="login.php">首页</a>
    <ul id="sub_01">   
    </ul>
    </li>
    <li class="mainlevel" id="mainlevel_02"><a href="xiangqing.php">了解我们</a>
    <ul id="sub_02">   
    </ul>
    </li>    
    </ul>  
  </div>
  
  <div class="main">
    <div class="left">
      <div class="box_1">
        <div class="left_title">会员中心</div>
        <form  action="login_chk.php" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="32%" height="37" valign="middle">用户名：</td>
            <td width="68%" valign="middle">
              <input type="text" name="user_no" id="user_no" class="input_1"/>
            </td>
          </tr>
          <tr>
            <td height="37" valign="middle">密　码：</td>
            <td valign="middle">
              <input type="password" name="user_password" id="user_password" class="input_2"/>
            </td>
          </tr>
          
          <tr>
            <td colspan="2">
              <input name="input" type="image" src="images/img_4.gif" />
              <input name="input" type="image" src="images/img_6.gif" />
            </td>
          </tr>
        </table>
        </form>
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
	});//5//
</script> 
        </div>
      </div>
    </div>
    <div class="right">
      <img src="images/img_8.gif" style="float:left"/>
      <div class="news">
        <div class="news_title"><span><img src="images/title_1.gif" /></span><a>&nbsp;&nbsp;发布人：<?=$new_notice_name?></a><a>时间：<?=$new_notice_time?></a></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="100" style="font-size:20px"><?=$new_notice?></td>
          </tr>
          </table>
      </div>
      <div class="news">
        <div class="news_title"><span><img src="images/title_11.gif" /></span></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <?=$notice?>
          
        </table>
      </div>
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
  </div>
  <div class="bottom"> 北京理工大学软件学院<br />
    版权所有<a></a> </div>
</div>
<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
