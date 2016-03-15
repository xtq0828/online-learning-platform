<?php
    session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>答题页</title>
<style  type="text/css">
.texthidden{display:none;}
</style>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<script>
$(document).ready(function(){

	$('.bianji').click(function(){

		var item=$(this);
		var textarea=item.next('textarea');
		var id=textarea.attr('id');
		var count=textarea.next('div').children('textarea').attr('id');
		window.open('http://localhost/lisan1/studentckeditor.php?id='+id+'&count='+count+'','','','');		

	})

	$('[name=save]').click(function(){
					 $.ajax({
			
			             type:"post",
			
			             data:$('#form1').serialize(),
			
			             url:"studenttemp.php",
			
			             success:function(data){
			
			            alert(data);
			
			          }
			
			        }) 
			})
	
})
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
	my_msg("您不在线上！","../login.php");
}

if(isset($_GET['papersid'])){
	
	
	$sqlstr="select * from topic where papers_id='".$_GET['papersid']."' ";
	$result = mysql_query($sqlstr,$link);
	
	while($row=mysql_fetch_array($result))
	{
		$shitiArray[]=$row;
	}
	
	//判断题目是否上线
	$sql="select papers_title,IsBegin from papers  where papers_id='".$_GET['papersid']."'";
	$IsBegin = mysql_query($sql,$link);
	$IsBeginArray=mysql_fetch_array($IsBegin);
	
	if($IsBeginArray['IsBegin']!='1'){
		my_msg("题目错误，请返回","onlineworklist.php");
	}
	
	//读取已经保存过的答案
	$sqltemp="select * from student_temp where user_no='".$_SESSION['user_no']."' and papers_id='".$_GET['papersid']."'";
	$resulttemp = mysql_query($sqltemp,$link);
	
	while($rowtemp=mysql_fetch_array($resulttemp))
	{
		$tempArray[$rowtemp[topic_id]]=$rowtemp['studentanswer'];
	}
}else{
	my_msg("请保持参数的完整性","onlineworklist.php");
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
     <div class="news_title" style="font-size:15px; font-weight:bold;">"<?php echo $IsBeginArray['papers_title']; ?>"答题</div>
     
     
     <div class="news" >
     <form id="form1" action="onlineworkanswer.php" method="post" >
	      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	      
	      <?php
			if(!isset($shitiArray)){ ?>
				<tr ><td colspan="3" style="font-weight:bold" >没有题目，请点击<a style="color:red; text-decoration:underline"   href="onlineworklist.php">返回</a></td></tr>
				</table>
			<?php  }else{
	       $i=1; foreach($shitiArray as $value){  
	      				 if($value['content_type']=='1'){?>
	      		<tr >
                 <td colspan="3" style="font-weight:bold" ><?php  echo $i,"、","(单选)",$value['content']; ?></td>
	      		 <td  style="font-weight:bold">分值：<?php echo $value['score']; ?></td>	      				
	      		</tr>
		        <tr>
			  		<td width="25%" height="50"><input type="radio"  <?php if($tempArray[$value['topic_id']]=='A'){echo "checked";} ?>  name="danxuan<?php echo $i; ?>" value="A" /><span style="font-weight:bold;">A:</span><?php echo $value['A'];  ?></td>
			      	 <td width="25%"  ><input type="radio"   <?php if($tempArray[$value['topic_id']]=='B'){echo "checked";} ?> name="danxuan<?php echo $i; ?>" value="B" /><span style="font-weight:bold;">B:</span><?php echo $value['B'];  ?></td>
			        <td width="25%" ><input type="radio"  <?php if($tempArray[$value['topic_id']]=='C'){echo "checked";} ?> name="danxuan<?php echo $i; ?>" value="C" /><span style="font-weight:bold;">C:</span><?php echo $value['C'];  ?></td>
					<td width="25%" ><input type="radio" <?php if($tempArray[$value['topic_id']]=='D'){echo "checked";} ?> name="danxuan<?php echo $i; ?>" value="D" /><span style="font-weight:bold;">D:</span><?php echo $value['D'];  ?></td>
		   		</tr> 
		   		<tr style="parding-boottom:5px;"><td style="border-bottom: 1px dashed #84888A;" colspan=4  ></td></tr>
		   		
		   		<?php }elseif($value['content_type']=='2'){  echo $tempArray[$value['topic_id']];  ?>
		   		<tr><td colspan="3"  style="font-weight:bold; margin-top:5px;"><?php  echo $i,"、","(多选)",$value['content'];?></td>
		   		<td  style="font-weight:bold">分值：<?php echo $value['score']; ?></td></tr></tr>
		         <tr>
			  		<td width="25%" height="50"><input type="checkbox"  <?php if(strpos($tempArray[$value['topic_id']],'A')!==false){echo "checked";} ?> name="duoxuan<?php echo $i; ?>[]" value="A" /><span style="font-weight:bold;">A:</span><?php echo $value['A'];  ?></td>
			      	 <td width="25%"  ><input type="checkbox"  <?php if(strpos($tempArray[$value['topic_id']],'B')!==false){echo "checked";} ?> name="duoxuan<?php echo $i; ?>[]" value="B" /><span style="font-weight:bold;">B:</span><?php echo $value['B'];  ?></td>
			        <td width="25%" ><input type="checkbox"  <?php if(strpos($tempArray[$value['topic_id']],'C')!==false){echo "checked";} ?> name="duoxuan<?php echo $i; ?>[]" value="C" /><span style="font-weight:bold;">C:</span><?php echo $value['C'];  ?></td>
					<td width="25%" ><input type="checkbox"  <?php if(strpos($tempArray[$value['topic_id']],'D')!==false){echo "checked";} ?> name="duoxuan<?php echo $i; ?>[]" value="D" /><span style="font-weight:bold;">D:</span><?php echo $value['D'];  ?></td>
		   		</tr> 
		   		<tr><td style="border-bottom: 1px dashed #84888A; " colspan=4></td></tr>
		   		<?php }elseif($value['content_type']=='3'){?>
		   		
		   		<tr><td colspan="3"  style="font-weight:bold"><?php  echo $i,"、","(判断)",$value['content']; ?></td>
		   		<td  style="font-weight:bold">分值：<?php echo $value['score']; ?></td></tr></tr>
		         <tr>
			  		<td width="25%" height="50"><input type="radio"  <?php  if($tempArray[$value['topic_id']]=='1'){echo "checked";} ?>  name="panduan<?php echo $i; ?>" value="1" /><span style="font-weight:bold;">A:</span>正确</td>
			      	 <td width="25%"  ><input type="radio"  <?php  if($tempArray[$value['topic_id']]=='0'){echo "checked";} ?>  name="panduan<?php echo $i; ?>" value="0" /><span style="font-weight:bold;">B:</span>错误</td>
			        
		   		</tr> 
		   		<tr><td style="border-bottom: 1px dashed #84888A; " colspan=4></td></tr>
		   		
		   		<?php }elseif($value['content_type']=='4'){?>
		   		<tr><td colspan="3"  style="font-weight:bold"><?php  echo $i,"、","(填空)",$value['content']; ?></td>
		   		<td  style="font-weight:bold">分值：<?php echo $value['score']; ?></td></tr></tr>
		         <tr>
			  		<td width="25%" height="50" colspan='3'>
			  			<img name="bjqtiankongbu" type="image"  class="bianji"  src="../images/keypad.png"  />
                        <textarea name="tiankong<?php echo $i; ?>" id="tiankong<?php echo $i; ?>" rows="10" cols="80" style="width: 600px; height: 70px" ><?php  if($tempArray[$value['topic_id']]){echo $tempArray[$value['topic_id']];} ?></textarea>
                        <div style="display:none">
                        <textarea id="mathml<?php echo $i; ?>" name="mathml<?php echo $i; ?>"></textarea>
                        </div>    			  		
			  		</td>
		   		</tr> 
		   		<tr><td style="border-bottom: 1px dashed #84888A; " colspan=4></td></tr>
		   		<?php } $i++; }  ?>
	        </table>  
	        <input type="hidden"  name="papersid"  value="<?php echo $_GET['papersid']; ?>" />
	        <input type="submit" name="提交答案" value="提交答案" />
	        <input type="button" name="save" value="保存暂不提交" />
	        <?php } ?>
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
    <div class="clear"></div>
  </div>
  <div class="bottom">北京理工大学<br />
    版权所有<a></a></div>

<script src="js/meun.js" type="text/javascript"></script>
</body>
</html>
