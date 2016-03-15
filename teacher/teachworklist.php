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
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>

<style  type="text/css"></style>
<script>
 $(document).ready(function(){
	
 		$('.online').click(function(){
			 /*
 			$.post("online.php", { username: 'name', password: 'pw' },
 			function (data){
						alert(data);
 	 			});
 	 		}); */
 			paperid=$(this).attr('paperid');
 			$this=$(this);
 			if($this.attr('on')=='0'){
 					$online='0';
 	 			}else{
 	 				$online='1';
 	 	 			}
 			
 		$.ajax({
			
 			type:'post',
			url:'online.php',
			data:{online: $online,paperid:paperid},
			success:function(data){
				window.location.reload()
				}
 	 		});
 		
 		});
 		
 
 });
</script>

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
$sqlstr="select *  from papers    order by papers_id desc";

	$result = mysql_query($sqlstr,$link);

	while($row=mysql_fetch_array($result))
	{
		$sql="select count(topic_id) as num from topic where papers_id='".$row['papers_id']."'";
		$res = mysql_query($sql,$link);
		 $ppcountArray=mysql_fetch_array($res);
		 
		 //获取平均分
		 $sqlscore="select papers_id,avg(score) as scoreavg from student_papers where papers_id='".$row['papers_id']."'";
		 $score = mysql_query($sqlscore,$link);
		 $scoreArray=mysql_fetch_array($score);
		 $row['score']=round($scoreArray['scoreavg'],2);
		 
		 $row['ppcount']=$ppcountArray['num'];
		$rows[]=$row;
		
	}




mysql_free_result($result);
mysql_close($link);

?>

<?php
if(isset($_SESSION['papers _id'])){
unset($_SESSION['papers _id']);
}
if(isset($_SESSION['topic_number'])){
unset($_SESSION['topic_number']);
}
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
      
    </div>
    <div class="right">
      <img src="../images/img_8.gif" style="float:left"/>
      <div class="news">
        <div class="news_title">
        <span  style="display:block; width:400px;">作业列表:</span><span><a style="font-weight:blod; color:red;"   href="newwork.php" >新建作业</a></span><a style="font-weight:blod; color:red;" href="studentscore.php">查看学生答题情况</a></div>
       
         <div class="news" style="height:500px;">
     
	      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	      		<tr style="text-align:center;font-weight:bold;height:30px; " ><td style="">试卷列表</td>
	      				<td>答题截止时间</td>
	      				<td>题目总数</td>
	      				<td>平均分</td>
	      				<td>是否编辑</td>
	      				<td>是否上线</td>
	      		</tr>
	      <?php if(isset($rows)){ foreach($rows as $value){  ?>
	      		<tr style="text-align:center;" ><td style="font-weight:bold;height:30px; "><a href="onlinework.php?papersid=<?php echo  $value['papers_id']; ?>"><?php echo  $value['papers_title']; ?></a></td>
	      				<td><?php echo date('Y-m-d H:i:s',$value['papers_time']); ?></td>
	      				<td>共<?php echo $value['ppcount']; ?>题</td>
	      				<td><?php if( $value['score']){ ?> <a href="studentwork.php?pid=<?php echo $value['papers_id']; ?>" >  <?php echo $value['score']; ?></a> <?php }else{ echo "没有人答题"; }?></td>
	      				<td><?php if($value['IsBegin']==0){ ?><a href="updateteachwork.php?pid=<?php echo $value['papers_id']; ?>" >编辑</a><?php }else{ echo "  "; }?></td>
	      				<td><?php if($value['IsBegin']==0){ ?><input type="button"  paperid="<?php echo $value['papers_id']; ?>"  class="online"  on="1"   value="上线" /><?php }else{ ?><input type="button"   paperid="<?php echo $value['papers_id']; ?>"  class="online"  on="0" value="下线" /><?php }?></td>
	      		</tr>
		         
		   		<tr style="parding-boottom:5px;"><td style="border-bottom: 1px dashed #84888A;" colspan=4  ></td></tr>
		   		
		   <?php }}?>		
		   		
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
  </div>
  <div class="bottom"> 北京理工大学软件学院<br />
    版权所有<a></a> </div>
</div>
<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
