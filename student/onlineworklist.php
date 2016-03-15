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
<link rel="StyleSheet"  href="../ASCIIMathML.js" type="text/javascript"/>
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<script type="text/javascript" src="../ASCIIMathML.js"></script>
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
$sqlstr="select * from papers as p left join user as u on p.papers_userid=u.User_no where IsBegin='1' order by papers_id desc";

	$result = mysql_query($sqlstr,$link);

	while($row=mysql_fetch_array($result))
	{
		$rows[]=$row;
	}
	
//查询用户是否答题过
$sqlsp="select * from student_papers where User_no=".$_SESSION['user_no']."";

$resultsp = mysql_query($sqlsp,$link);

while($rowsp=mysql_fetch_array($resultsp))
{
	$spArray[$rowsp['papers_id']]=$rowsp['score'];
}

if(isset($spArray)){
	$psArray=array_flip($spArray);
}else{
	$psArray=array();
}

//查询用户得分最高的章节和得分最低的章节
$sqlmax="select pp.papers_title,sp.score as gao from student_papers as sp left join papers as pp on sp.papers_id=pp.papers_id where User_no=".$_SESSION['user_no']." order by score  desc limit 0,1";
$resultmax = mysql_query($sqlmax,$link);
$rowsmax=mysql_fetch_array($resultmax);


//查询用户得分最高的章节和得分最低的章节
$sqlmin="select pp.papers_title,sp.score as gao from student_papers as sp left join papers as pp on sp.papers_id=pp.papers_id where User_no=".$_SESSION['user_no']." order by score  limit 0,1";
$resultmin = mysql_query($sqlmin,$link);
$rowsmin=mysql_fetch_array($resultmin);


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
		    <a>您好！<?=$User_realname?></a></div>
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
	      <?php foreach($rows as $value){  ?>
	      		<tr ><td style="font-weight:bold;height:30px; ">
	      		<?php  if(time()<$value['papers_time']&&!in_array($value['papers_id'],$psArray) ){ ?>
	      				<a href="onlinework.php?papersid=<?php echo $value['papers_id']; ?>" style="color:red"><?php echo  $value['papers_title']; ?></a>
	      		<?php }else{?>
	      				<span><?php echo  $value['papers_title']; } ?></span>
	      				</td>
	      				<td>出题人：<?php echo $value['User_realname']; ?></td>
	      				<td><?php if(time()<$value['papers_time']){ echo "答题截止时间：",date('Y-m-d H:i:s',$value['papers_time']);}else{ echo "已超过最后答题时间"; } ?></td>
                        <td><a href="detailedanswer.php?papersid=<?php echo $value['papers_id']; ?>" style="color:red">查看详细答题情况</a></td>
	      				<td><?php if(in_array($value['papers_id'],$psArray) ){ echo "分数：",$spArray[$value['papers_id']],"分"; }else{ ?>状态：未答题<?php } ?></td>
	      		</tr>
		         
		   		<tr style="parding-boottom:5px;"><td style="border-bottom: 1px dashed #84888A;" colspan=4  ></td></tr>
		   		
		   <?php } ?>		
		   </table>  
	     
      </div>
    
      
      
      </div>
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
  <div class="bottom">北京理工大学<br />
    版权所有<a></a></div>

<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
