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
<style  type="text/css">
#myDiv{ 
    
    height:500px;                                     /*调整显示区的高*/ 
    line-height:18px; 
    overflow-pageINdex:hidden; 
    overflow:auto; 
    word-break:break-all; 
} 
</style>
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
/*
 * 教师查看学生分数表
 */
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
	my_msg("该用户不存在","../login.php");
}
$sqlstr="select *  from student_papers group by User_no";

$result = mysql_query($sqlstr,$link);

while($row=mysql_fetch_array($result))
{
	$rows[]=$row;
}
//查询试卷数量
$sqlpapers="select * from papers";
$resultpapers = mysql_query($sqlpapers,$link);
while($rowpapers=mysql_fetch_array($resultpapers, MYSQL_BOTH))
{
	$rowspap[]=$rowpapers;
}
//框的宽度
$width=floor(70/count($rowspap));
//查询学生列表
$sqlstudentlist="select User_no,User_realname from user where User_typeid='2'";
$resultstudentlist = mysql_query($sqlstudentlist,$link);
while($rowstudentlist=mysql_fetch_array($resultstudentlist, MYSQL_BOTH))
{
	$rowsstudentlist[]=$rowstudentlist;
}
//查询学生成绩
$sqlstudentscore="select * from student_papers";
$resultstudentscore = mysql_query($sqlstudentscore,$link);
while($rowstudentscore=mysql_fetch_array($resultstudentscore, MYSQL_BOTH))
{
	$rowsstudentscore[$rowstudentscore['User_no']][$rowstudentscore['papers_id']]=$rowstudentscore['score'];
}
//查询最高分和最低分
foreach ($rowsstudentscore as $key=>$value){
	$max[$key]=max($value);
	$min[$key]=min($value);
}

//查询学生最高题型
$sqltixing="select san.User_no,topic.content_type,sum(san.score) as he from `student_answer` as san left join topic as topic on san.topic_id=topic.topic_id where san.`IsYes`='1' group by topic.`content_type`,san.User_no";
$resultixing = mysql_query($sqltixing,$link);
while($rowstixing=mysql_fetch_array($resultixing, MYSQL_BOTH))
	{
		$rowstixingarray[$rowstixing['User_no']][$rowstixing['content_type']]=$rowstixing[he];
	}
	
	foreach ($rowstixingarray as $key=>$value){
		$usertixing[$key]=array_search(max($value),$value);
	}
	
//查询学生总成绩
// $sqlhe="select User_no,sum(score) as he from `student_papers` group by `User_no`  ";
// $resulthe = mysql_query($sqlhe,$link);
// while($rowshe=mysql_fetch_array($resulthe, MYSQL_BOTH))
// {
// 	$rowshearray[]=$rowshe;
// }
// print_r($rowshearray);
$mingti=0;
$weici=0;
$jihe=0;
$sqlshijuan="select papers_id from papers";
$resultshijuan=mysql_query($sqlshijuan,$link);
while($rowsshijuanlist=mysql_fetch_array($resultshijuan))
{
	$rowsshijuan[]=$rowsshijuanlist;
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
      <div class="news">
        <div class="news_title"><span style="display:block; width:400px;">学生作业情况:</span><span><a style="font-weight:blod;color:red;" href="newwork.php" >新建作业</a></span><a style="font-weight:blod; color:red;"href="teachworklist.php">查看作业列表</a></div>
       
         <div id="myDiv" class="news" style="height:500px;">
     
	      <table border="1" cellspacing="0" cellpadding="0" style="text-align:center">
	     		<tr>
				<td style="text-align:center" rowspan="2">学生学号</td>
				<td rowspan="2">学生姓名</td>
				<td colspan="<?php echo count($rowspap); ?>">学生各章节成绩</td>
				<td colspan="2">分析</td>
                </tr>
                <tr>
			    <?php foreach($rowspap as $pap){ ?>
	      	    <td><?php echo  $pap['papers_title'];?></td>
	      		<?php } ?>
	      	    <td>得分最高题型</td>
	      	    <td>总成绩</td>
				</tr>
                
	      		<?php 
	      		
	      		foreach ($rowsstudentlist as $student){  ?>
		      		<tr>
                    <td><?php echo $student['User_no']; ?></td>
                    <td><?php echo $student['User_realname']; ?></td>
		      				<?php 
		      				$heightscore=0;
		      				$lowscore=0;
		      				foreach($rowspap as $pap){ ?>
		      				<td><?php if(isset($rowsstudentscore[$student['User_no']][$pap['papers_id']])){ ?><a href="studentworkdeta.php?user=<?php echo $student['User_no']; ?>&&papers=<?php echo $pap['papers_id']; ?>"><?php echo $rowsstudentscore[$student['User_no']][$pap['papers_id']]; ?></a> <?php if($max[$student['User_no']]==$rowsstudentscore[$student['User_no']][$pap['papers_id']]){ echo "<span style='color:blue;'>最高分</span>"; }if($min[$student['User_no']]==$rowsstudentscore[$student['User_no']][$pap['papers_id']]){ echo "<span style='color:red;'>最低分</span>"; }}else{ echo "未答题"; } ?></td>
		      				<?php 
		      					//获取总分
		      					$rowsstudentscore[$student['User_no']]['he']+=$rowsstudentscore[$student['User_no']][$pap['papers_id']];  
								} ?>
		      			
	      				<td><?php
										switch ($usertixing[$student['User_no']]){
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
	      				
	      				?></td>
		      			<td><?php echo $rowsstudentscore[$student['User_no']]['he']; ?></td>
		      		</tr>
		      	<?php }?>
		        
	        </table>  
            <?php echo "<br/>" ?>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <?php foreach($rowsshijuan as $shijuan){ 
	  $mingti=0;
      $weici=0;
      $jihe=0;
	  $sqlanswer="select * from student_answer where papers_id=".$shijuan['papers_id'];
	  $resultanswer=mysql_query($sqlanswer,$link);
	  while($rowsanswerlist=mysql_fetch_array($resultanswer))
	  {
		  if($rowsanswerlist['IsYes']=='0'){
			  if(strcmp($rowsanswerlist['topic_type'],"命题逻辑")==0){
				  $mingti=$mingti+$rowsanswerlist['score'];
			  }
			  if(strcmp($rowsanswerlist['topic_type'],"谓词逻辑")==0){
				  $weici=$weici+$rowsanswerlist['score'];
			  }
			  if(strcmp($rowsanswerlist['topic_type'],"集合与关系")==0){
				  $jihe=$jihe+$rowsanswerlist['score'];
			  }
		  }
	  }?>
      <tr>
      <img src="../teacherpicture.php?mingti=<?php echo $mingti; ?>&&weici=<?php echo $weici; ?>&&jihe=<?php echo $jihe; ?>" />
      </tr>
      <?php
      mysql_free_result($result);
      mysql_close($link); } ?>
      </table>
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
  <div class="bottom"> 北京理工大学软件学院<br/>版权所有<a></a></div>
<script src="js/meun.js" type="text/javascript"></script>
</div>
</body>
</html>

