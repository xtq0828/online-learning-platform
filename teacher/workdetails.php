<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>作业详情</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<link rel="StyleSheet"  href="../ASCIIMathML.js" type="text/javascript"/>
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<script type="text/javascript" src="../ASCIIMathML.js"></script>
<style  type="text/css">
 .duoxuan   { display:none; }
 .panduan  { display:none; }
 .tiankong { display:none; }

</style>
<script type="text/javascript" src="http://localhost/fck/fckeditor.js"></script>
 


<script>
$(document).ready(function(){

		$('[name=sub1]').click(function(){
			
			$cc=$('[name=papers_title]').val();
			if(!$cc){
							alert('标题不能为空');
							return false;
						}
			});

			//$content_type=$('[name=content_type]:checked').val();
		   
			$('[name=content_type]').click(function(){
				$content_type=$('[name=content_type]:checked').val();
				if($content_type=='danx'){
						$('.danxuan').css({ "display":"block"});
						$('.duoxuan').css({ "display":"none"});
						$('.panduan').css({ "display":"none"});
						$('.tiankong').css({ "display":"none"});
					}
				if($content_type=='duox'){
					$('.danxuan').css({ "display":"none"});
					$('.duoxuan').css({ "display":"block"});
					$('.panduan').css({ "display":"none"});
					$('.tiankong').css({ "display":"none"});
				}
				if($content_type=='pand'){
					$('.danxuan').css({ "display":"none"});
					$('.duoxuan').css({ "display":"none"});
					$('.panduan').css({ "display":"block"});
					$('.tiankong').css({ "display":"none"});
				}
				if($content_type=='tiank'){
					$('.danxuan').css({ "display":"none"});
					$('.duoxuan').css({ "display":"none"});
					$('.panduan').css({ "display":"none"});
					$('.tiankong').css({ "display":"block"});
				}
				
				})
				
			
	
	 
	});

</script>
</head>
<body>
<?php
    
	include_once("../sql_connect.php");
  include_once("../my_msg.php");
  //my_msg2($_SESSION['user_no']);
  mysql_query("set names utf8");
  $sqlstr="select * from user where User_no =".$_SESSION['user_no'];
	$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_array($result, MYSQL_BOTH);

if(mysql_num_rows ($result)==1 ){
	$User_realname= $row["User_realname"];
	$User_no= $row["User_no"];
}else{
	session_destroy();
	my_msg("该用户不存在","login.php");
}
mysql_free_result($result);

$sqlstr="select * from notice Order by Notice_time DESC";
	$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_row($result);
    $new_notice="<a href='notice_content.php?id=".$row[0]."'>".$row[2]."</a>";
	$new_notice_time= $row[3];
	$new_notice_name= $row[4];
	
	$notice="
	<tr>
  		<td width=\"48%\" height=\"18\"><a href='notice_content.php?id=".$row[0]."'>".$row[1]."</a></td>
       <td width=\"27%\">".$row[4]."</td>
        <td width=\"25%\" align=\"center\">".$row[3]."</td>
   </tr>";
	while($row=mysql_fetch_row($result))
	{
		$notice=$notice."
	<tr>
  		<td width=\"48%\" height=\"18\"><a href='notice_content.php?id=".$row[0]."'>".$row[1]."</a></td>
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
        <div class="news_title">
        <span>新建作业:</div>
       
        
        
         <?php if(!isset($_SESSION['papers _id'])){ ?>
          <form name="form1" method="post" action="newworkupdate.php">
         添加章节 : <input type="text" name="papers_title" /> <br/> <br/>
         截止日期：<select name="year">
         							<option value="2012">2012</option>
         							<option value="2013">2013</option>
         					</select>&nbsp;年
         					<select name="month">
         						<?php for($i=1;$i<=12;$i++){ ?>
         							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         						<?php } ?>
         					</select>&nbsp;月
         					<select name="day">
         						<?php for($i=1;$i<=31;$i++){ ?>
         							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         						<?php } ?>
         					</select>&nbsp;日&nbsp;&nbsp;00:00
         					<br/><br/>
         			<input type="submit" name="sub1" value="开始编写题目" />
         	</form>
         <br/>
         <?php }else{ ?>
         <div style="font-weight:bold; font-size:15px;">第<?php echo isset($_SESSION['topic_number'])?$_SESSION['topic_number']:1; ?>题：</div>
         <br/><br/>
        <span class="type">
         	请选择作业类型： 
         	<input type="radio" name="content_type" value="danx" checked>单选</input>
         	<input type="radio" name="content_type" value="duox">多选</input>
         	<input type="radio" name="content_type" value="pand">判断题</input>
         	<input type="radio" name="content_type" value="tiank">填空题</input>
         </span>
         <br/><br/>
        
         
         <div class="danxuan">
         <form name="form2" method="post" action="newworkupdate.php">
         
         		题目： <textarea name="danxuantimu"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项A: <textarea name="danxuana"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项B: <textarea name="danxuanb"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项C: <textarea name="danxuanc"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项D: <textarea name="danxuand"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		正确答案: A:<input type="radio"  name="danxuandaan" value="A"/>&nbsp;&nbsp;&nbsp;&nbsp;B:<input type="radio" name="danxuandaan" value="B" />&nbsp;&nbsp;&nbsp;&nbsp;
         						C:<input type="radio" name="danxuandaan"  value="C"/>&nbsp;&nbsp;&nbsp;&nbsp;D:<input type="radio" name="danxuandaan" value="D" />
         		<br/><br/>
         		输入分值:<input type="text" name="danxuanfen" />分
         		<br/><br/>
         		<input type="submit" name="sub2" value="提交单选" />
         </form>
         </div>
         
         <div class="duoxuan">
         <form name="form2" method="post" action="newworkupdate.php">
         		题目： <textarea name="duoxuantimu"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项A: <textarea name="duoxuana"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项B:  <textarea name="duoxuanb"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项C:  <textarea name="duoxuanc"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		选项D:  <textarea name="duoxuand"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		正确答案: A:<input type="checkbox" name="duoxuandaan[]" value="A" />&nbsp;&nbsp;&nbsp;&nbsp;B:<input type="checkbox" name="duoxuandaan[]"  value="B"  />&nbsp;&nbsp;&nbsp;&nbsp;
         						C:<input type="checkbox"  name="duoxuandaan[]"  value="C" />&nbsp;&nbsp;&nbsp;&nbsp;D:<input type="checkbox"  name="duoxuandaan[]"  value="D" />
         		<br/><br/>
         		输入分值:<input type="text" name="duoxuanfen" />分
         		<br/><br/>
         		<input type="submit" name="sub3" value="提交多选" />
         		
         		
         	</form>
         </div>
         
         <div class="panduan">
         <form name="form3" method="post" action="newworkupdate.php">
         		题&nbsp;&nbsp;&nbsp;目： <textarea name="panduantimu"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/>
         		
         		<br/>
         		正确答案: 命题正确:<input type="radio"   name="panduandaan" value='1' />&nbsp;&nbsp;&nbsp;&nbsp;命题错误:<input type="radio"  name="panduandaan"  value="0" />&nbsp;&nbsp;&nbsp;&nbsp;
         		<br/><br/>
         		<input type="submit" name="sub4" value="提交判断" />
         	</form>
         </div>
         
         <div class="tiankong">
         <form name="form1" method="post" action="newworkupdate.php">
         		题&nbsp;&nbsp;&nbsp;目： <textarea name="tiankongtimu"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		
         		正确答案: <textarea name="tiankongdaan"  rows="10" cols="80" style="width: 600px; height: 70px" ></textarea>
         		<br/><br/>
         		<input type="submit" name="sub5" value="提交填空" />
         	</form>
         </div>
         <br/>
         <br/>
          <?php }?>
         
         </form>
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
