<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/jquery-1.7.2.js"  type="text/javascript" ></script>
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教师作业列表</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<link rel="StyleSheet"  href="../ASCIIMathML.js" type="text/javascript"/>
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<script type="text/javascript" src="../ASCIIMathML.js"></script>



<style  type="text/css"></style>

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
	my_msg("该用户不存在","login.html");
}
$pid=$_GET['pid'];
//查询当前试卷信息
$sqlstr="select *  from papers  where papers_id='".$pid."'";

	$result = mysql_query($sqlstr,$link);

	$row=mysql_fetch_array($result);
	
	
$nowtime=	date('Y-m-d H:i:s',$row['papers_time']);

$row['year']=substr($nowtime,0,4);
$row['month']=substr($nowtime,5,2);
$row['day']=substr($nowtime,8,2);


	




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
      <div class="box_1">
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
        
      </div>
      <div class="box_1">
        <div class="left_title">日历</div>
        <div class="left_nr" >
        <div id="calendar"></div> 
          <script src="../rili/jquery.min.js"></script> 
          <script src="../rili/jquery-ui-datepicker.min.js"></script> 

        </div>
      </div>
    </div>
    <div class="right">
      <img src="../images/img_8.gif" style="float:left"/>
      <div class="news">
        <div class="news_title">
        <span  style="display:block; width:400px;">作业列表:</span><span><a style="font-weight:blod; color:red;"   href="newwork.php" >新建作业</a></span><a style="font-weight:blod; color:red;" href="studentscore.php">查看学生答题情况</a></div>
       
         <div class="news" style="height:500px;">
       <form  method="post"  action="upwork.php" >
	      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	    
	      		<tr style="height:50px;" ><td>作业标题：</td><td style="font-weight:bold;height:30px; "><input type="text" name="pname" value="<?php echo $row['papers_title']; ?>" /></td></tr>
	      		
	      		<tr  style="height:20px;"><td>截止时间：</td>			
	      		<td>
	      				<select name="year">
         							<option value="2012"  <?php if($row['papers_title']=='2012'){echo "selected";} ?>>2012</option>
         							<option value="2013" <?php if($row['papers_title']=='2013'){echo "selected";} ?>>2013</option>
         					</select>&nbsp;年
         					<select name="month">
         						<?php for($i=1;$i<=12;$i++){ ?>
         							<option value="<?php echo $i; ?>" <?php if($row['month']==$i){echo "selected";} ?>><?php echo $i; ?></option>
         						<?php } ?>
         					</select>&nbsp;月
         					<select name="day">
         						<?php for($i=1;$i<=31;$i++){ ?>
         							<option value="<?php echo $i; ?>" <?php if($row['day']==$i){echo "selected";} ?>><?php echo $i; ?></option>
         						<?php } ?>
         					</select>&nbsp;日&nbsp;&nbsp;00:00
         					<input type="hidden"  name="pid" value="<?php echo $row['papers_id'];  ?>" />
	      		
	      		</td></tr>
	      		
		         
		   	<tr ><td><input type="submit"  name="sub" value="提交"/></td></tr>	
		   		
		  
		   		
	        </table>  
	     </form>
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
  </div>
  <div class="bottom"> 北京理工大学软件学院<br />
    版权所有<a></a> </div>
</div>
<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
