<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/jquery-1.7.2.js"  type="text/javascript" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>答题页</title>
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
  $sqlstr="select * from user where User_no =".$_SESSION['user_no']." and User_typeid='1' ";
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

if(isset($_GET['user'])&&isset($_GET['papers'])){
	
	//查看学生答题列表
	$sqlstr="select * from student_answer as sa left join topic as tp on sa.topic_id=tp.topic_id where sa.papers_id='".$_GET['papers']."' and sa.user_no='".$_GET['user']."' ";
	$result = mysql_query($sqlstr,$link);
	
	while($row=mysql_fetch_array($result))
	{
		$shitiArray[]=$row;
	}
	
	//获取作业章节
	$sql="select papers_title,IsBegin from papers  where papers_id='".$_GET['papers']."'";
	$IsBegin = mysql_query($sql,$link);
	$IsBeginArray=mysql_fetch_array($IsBegin);
	
	//查询学生总分
	$sqlallscore="select sp.score,us.User_nickname from student_papers as sp left join user as us on sp.User_no=us.User_no where sp.User_no='".$_GET['user']."' and papers_id='".$_GET['papers']."' ";
	$resultallscore = mysql_query($sqlallscore,$link);
	$rowallscore=mysql_fetch_array($resultallscore);
	
}else{
	my_msg("请保持参数的完整性","/student/onlineworklist.php");
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
     <div class="news_title" ><span style="font-size:15px; font-weight:bold;"  style="display:block; width:400px;"><?php echo $IsBeginArray['papers_title'],'-------',$rowallscore['User_realname'],'得分：',$rowallscore['score'],'分'; ?></span>
     
     </div>
     
     
     <div class="news" >
     
	      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	      
	      <?php
			if(!isset($shitiArray)){ ?>
				<tr ><td colspan="3" style="font-weight:bold" >没有题目，请点击<a style="color:red; text-decoration:underline"   href="teachworklist.php">返回</a></td>
						
				</tr>
				</table>
			<?php  }else{
	       $i=1; foreach($shitiArray as $value){  
	      				 if($value['content_type']=='1'){     			?>
	      		<tr ><td colspan="2" style="font-weight:bold" ><?php  echo $i,"、","(单选)",$value['content']; ?></td>
	      				<td  style="font-weight:bold ; ">分值：<?php echo $value['score']; ?>&nbsp;&nbsp;&nbsp;&nbsp;答案：<?php echo $value['answer']; ?>&nbsp;&nbsp;&nbsp;&nbsp;回答：<?php if($value['IsYes']=='1'){ echo "对了";}else{ echo "错了" ;} ?></td>
	      				<td   style="font-weight:bold"><?php if($IsBeginArray['IsBegin']=='0'){ ?><a href="newwork.php?tid=<?php echo $value['topic_id'];?>" >修改</a><a href="javascript:void(0);"  class="del"  topic_id="<?php echo $value['topic_id'];  ?>">删除</a><?php } ?></td></tr>
		         <tr>
			  		<td width="25%" height="50"><input type="radio" name="danxuan<?php echo $i; ?>" value="A" /><span style="font-weight:bold;">A:</span><?php echo $value['A'];  ?></td>
			      	 <td width="25%"  ><input type="radio" name="danxuan<?php echo $i; ?>" value="B" /><span style="font-weight:bold;">B:</span><?php echo $value['B'];  ?></td>
			        <td width="25%" ><input type="radio" name="danxuan<?php echo $i; ?>" value="C" /><span style="font-weight:bold;">C:</span><?php echo $value['C'];  ?></td>
					<td width="25%" ><input type="radio" name="danxuan<?php echo $i; ?>" value="D" /><span style="font-weight:bold;">D:</span><?php echo $value['D'];  ?></td>
		   		</tr> 
		   		<tr style="parding-boottom:5px;"><td style="border-bottom: 1px dashed #84888A;" colspan=4  ></td></tr>
		   		
		   		<?php }elseif($value['content_type']=='2'){ ?>
		   		<tr><td colspan="2"  style="font-weight:bold; margin-top:5px;"><?php  echo $i,"、","(多选)",$value['content']; ?></td>
		   		<td  style="font-weight:bold">分值：<?php echo $value['score']; ?>&nbsp;&nbsp;&nbsp;&nbsp;答案：<?php echo $value['answer']; ?>&nbsp;&nbsp;&nbsp;&nbsp;回答：<?php if($value['IsYes']=='1'){ echo "对了";}else{ echo "错了" ;} ?></td>
		   		<td  style="font-weight:bold"><?php if($IsBeginArray['IsBegin']=='0'){ ?><a href="newwork.php?tid=<?php echo $value['topic_id'];?>" >修改</a><a href="javascript:void(0);"  class="del"  topic_id="<?php echo $value['topic_id'];  ?>">删除</a><?php }?></td></tr></tr>
		         <tr>
			  		<td width="25%" height="50"><input type="checkbox" name="duoxuan<?php echo $i; ?>[]" value="A" /><span style="font-weight:bold;">A:</span><?php echo $value['A'];  ?></td>
			      	 <td width="25%"  ><input type="checkbox" name="duoxuan<?php echo $i; ?>[]" value="B" /><span style="font-weight:bold;">B:</span><?php echo $value['B'];  ?></td>
			        <td width="25%" ><input type="checkbox" name="duoxuan<?php echo $i; ?>[]" value="C" /><span style="font-weight:bold;">C:</span><?php echo $value['C'];  ?></td>
					<td width="25%" ><input type="checkbox" name="duoxuan<?php echo $i; ?>[]" value="D" /><span style="font-weight:bold;">D:</span><?php echo $value['D'];  ?></td>
		   		</tr> 
		   		<tr><td style="border-bottom: 1px dashed #84888A; " colspan=4></td></tr>
		   		<?php }elseif($value['content_type']=='3'){?>
		   		
		   		<tr><td colspan="2"  style="font-weight:bold"><?php  echo $i,"、","(判断)",$value['content']; ?></td>
		   		<td  style="font-weight:bold" >分值：<?php echo $value['score']; ?>&nbsp;&nbsp;&nbsp;&nbsp;答案：<?php echo $value['answer']; ?>&nbsp;&nbsp;&nbsp;&nbsp;回答：<?php if($value['IsYes']=='1'){ echo "对了";}else{ echo "错了" ;} ?></td>
		   			<td  style="font-weight:bold"><?php if($IsBeginArray['IsBegin']=='0'){ ?><a href="newwork.php?tid=<?php echo $value['topic_id'];?>" >修改</a><a href="javascript:void(0);"  class="del"  topic_id="<?php echo $value['topic_id'];  ?>">删除</a><?php }?></td></tr></tr>
		         
		        
		         <tr>
			  		<td width="25%" height="50"><input type="radio" name="panduan<?php echo $i; ?>" value="1" /><span style="font-weight:bold;">A:</span>正确</td>
			      	 <td width="25%"  ><input type="radio" name="panduan<?php echo $i; ?>" value="0" /><span style="font-weight:bold;">B:</span>错误</td>
			        
		   		</tr> 
		   		<tr><td style="border-bottom: 1px dashed #84888A; " colspan=4></td></tr>
		   		
		   		<?php }elseif($value['content_type']=='4'){?>
		   		<tr><td colspan="2"  style="font-weight:bold"><?php  echo $i,"、","(填空)",$value['content']; ?></td>
		   		<td  style="font-weight:bold">分值：<?php echo $value['score']; ?>&nbsp;&nbsp;&nbsp;&nbsp;答案：<?php echo $value['answer']; ?>&nbsp;&nbsp;&nbsp;&nbsp;回答：<?php if($value['IsYes']=='1'){ echo "对了";}else{ echo "错了" ;} ?></td>
		   			<td  style="font-weight:bold"><?php if($IsBeginArray['IsBegin']=='0'){ ?><a href="newwork.php?tid=<?php echo $value['topic_id'];?>" >修改</a><a href="javascript:void(0);"  class="del"  topic_id="<?php echo $value['topic_id'];  ?>">删除</a><?php }?></td></tr></tr>
		         
		   		</tr>
		         <tr>
			  		<td width="25%" height="50"><input type="text" name="tiankong<?php echo $i; ?>" /></td>
		   		</tr> 
		   		<tr><td style="border-bottom: 1px dashed #84888A; " colspan=4></td></tr>
		   		<?php } $i++; }  ?>
	        </table>  
	        <input type="hidden"  name="papersid"  value="<?php echo $_GET['papersid']; ?>" />
	        
	        <?php } ?>
	     
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
