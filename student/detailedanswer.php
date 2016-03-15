<?php
    session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>作业列表</title>
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
	    $User_class= $row["User_class"];
	}
	else{
		session_destroy();
	    my_msg("您不在线上！","../login.php");
	}

  $sqlstr="select * from student_answer where papers_id='".$_GET['papersid']."' and user_no='".$_SESSION[user_no]."'";
  $result = mysql_query($sqlstr,$link);
  if(mysql_num_rows($result) < 1){
	  my_msg("未做答此试卷","onlineworklist.php");
  }
  
  while($row=mysql_fetch_array($result))
  {
	  $shitiArray[]=$row;
  }
  $mingti=0;
  $weici=0;
  $jihe=0;
  
  foreach($shitiArray as $value){
	  if(strcmp($value['topic_type'],"命题逻辑")==0&&$value['IsYes']=='0'){
		  $mingti=$mingti+$value['score'];
	  }
	  if(strcmp($value['topic_type'],"谓词逻辑")==0&&$value['IsYes']=='0'){
		  $weici=$weici+$value['score'];
	  }
	  if(strcmp($value['topic_type'],"集合与关系")==0&&$value['IsYes']=='0'){
		  $jihe=$jihe+$value['score'];
	  }
  }
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

  <div class="meun_2"><a>您好！<?=$User_realname?></a></div>
			
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
     <img src="../images/img_8.gif" style="float:left"/>
     <div class="news_title" style="font-size:15px; font-weight:bold;">作业列表</div>     
     <div class="news" style="height:500px;">
	 <table width="100%"  border="0" cellspacing="0" cellpadding="0">
     <tr>
     <center><img src="../studentpicture.php?mingti=<?php echo $mingti; ?>&&weici=<?php echo $weici; ?>&&jihe=<?php echo $jihe; ?>" /></center>
     </tr>
     <tr>
     <?php $i=1;foreach($shitiArray as $value){ ?>
     <?php if($value['IsYes']=='0'){ ?>
     <td>第<?php echo $i ?>题正确答案（
     <?php
	 $i++;
	 $sqlstr="select content from topic where papers_id='".$_GET['papersid']."' and topic_id='".$value['topic_id']."'";          $result = mysql_query($sqlstr,$link);
	 $content=mysql_fetch_array($result);
	 echo $content['content'];
	 ?>）：<?php
	 $answersqlstr="select answer from topic where topic_id='".$value['topic_id']."'";
     $answerresult=mysql_query($answersqlstr,$link);
	 $answerrow=mysql_fetch_array($answerresult);
	 echo $answerrow['answer'] ?></td>
     <?php }}
	 mysql_free_result($result);
	 mysql_free_result($answerresult);
	 mysql_close($link);?>
     </tr>	
	 </table>  
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
	
  </div>
  
  <div class="bottom">北京理工大学<br/>版权所有<a></a></div>

<script src="js/meun.js" type="text/javascript"></script>
</div>
</body>
</html>
