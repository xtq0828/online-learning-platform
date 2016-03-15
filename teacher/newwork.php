<?php
session_start();

    
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
	my_msg("您不在线上！","../login.php");
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

//如果是断点添加题目
if(isset($_GET['papersid'])){
	
	//判断此章节是否存在
	$sqlpanum="SELECT COUNT(papers_id) as num FROM papers WHERE papers_id=".$_GET['papersid'];
	$resultpanum = mysql_query($sqlpanum,$link);
	$rowpanum = mysql_fetch_array($resultpanum, MYSQL_BOTH);
		if($rowpanum['num']<=0){
			my_msg("未设置此章节，点击返回","teachworklist.php");
		}
	//读取章节题目
	$sqlpa="SELECT COUNT(topic_id) as num FROM topic WHERE papers_id=".$_GET['papersid'];
	$resultpa = mysql_query($sqlpa,$link);
	
	$rowpa = mysql_fetch_array($resultpa, MYSQL_BOTH);
	//echo $rowpa['num'];
// 	if($rowpa['num']<=0){
// 		my_msg("此章节为空，或者没有题目","teachworklist.php");
// 	}
}

//如果是修改数据
if(isset($_GET['tid'])){
	$sql="SELECT * FROM topic WHERE topic_id=".$_GET['tid'];
	$resulttopic = mysql_query($sql,$link);
	$rowtopic = mysql_fetch_array($resulttopic, MYSQL_BOTH);
}
mysql_free_result($result);
mysql_close($link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>离散数学在线学习系统</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<style  type="text/css">
.duoxuan{display:none;}
.panduan{display:none;}
.tiankong{display:none;}
.texthidden{display:none;}
</style>
<?php if(isset($_GET['tid'])){  ?>
	<style  type="text/css">
 	
	</style>
<?php }?>

<script>
$(document).ready(function(){

	//textarea 点击编辑显示
	$('.bianji').click(function(){

		var item=$(this);
		var textarea=item.parent('div').next('textarea');
		var id=textarea.attr('id');
		var winOpen=null;
		winOpen=window.open('http://localhost/lisan1/teacherckeditor.php?id='+id+'','','','');		
	})
	
		$('[name=sub1]').click(function(){
			
			$cc=$('[name=papers_title]').val();
			if(!$cc){
							alert('标题不能为空');
							return false;
						}
			});

		
			if(<?php echo   isset($rowtopic['content_type'])?$rowtopic['content_type']:'0'; ?>=='1'){
				$('.danxuan').css({ "display":"block"});
				$('.duoxuan').css({ "display":"none"});
				$('.panduan').css({ "display":"none"});
				$('.tiankong').css({ "display":"none"});
			}
		
			if(<?php echo   isset($rowtopic['content_type'])?$rowtopic['content_type']:'0'; ?>=='2'){
				$('.danxuan').css({ "display":"none"});
				$('.duoxuan').css({ "display":"block"});
				$('.panduan').css({ "display":"none"});
				$('.tiankong').css({ "display":"none"});
			}
			
			if(<?php echo   isset($rowtopic['content_type'])?$rowtopic['content_type']:'0'; ?>=='3'){
				$('.danxuan').css({ "display":"none"});
				$('.duoxuan').css({ "display":"none"});
				$('.panduan').css({ "display":"block"});
				$('.tiankong').css({ "display":"none"});
			}
			if(<?php echo   isset($rowtopic['content_type'])?$rowtopic['content_type']:'0'; ?>=='4'){
				$('.danxuan').css({ "display":"none"});
				$('.duoxuan').css({ "display":"none"});
				$('.panduan').css({ "display":"none"});
				$('.tiankong').css({ "display":"block"});
			}
			
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
  <?php
           if($_SESSION['type']==1)
		   {?>
		    <a>您好！<?=$User_realname?></a>
			 <?php }?>
             <?php
             if($_SESSION['type']==2)
		   {?>
		   <a>您好！<?=$User_realname?></a>
		  <?php }?>
          
          <?php
               if($_SESSION['type']!=2&&$_SESSION['type']!=1)
			   {?>
				    <a>您好！游客</a>
			   <?php }?>
  
  
  
  </div>
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
        <span style="display:block; width:200px;">新建作业:</span><span><a style="font-weight:blod; color:red;"   href="teachworklist.php" >查看作业列表</a></span><a style="font-weight:blod; color:red;" href="studentscore.php">查看学生答题情况</a>
        </div>
       
        
        
         <?php if(!isset($_SESSION['papers _id'])&&!isset($_GET['tid'])&&!isset($_GET['papersid'])){ ?>
          <form name="form1" method="post" action="newworkupdate.php">
         添加章节：<input type="text" name="papers_title" /> <br/> <br/>
         截止日期：<select name="year">
         							<option value="2015">2015</option>
         							<option value="2016">2016</option>
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
         
         <?php if(!isset($_GET['tid'])){ ?>
         <div><span style="font-weight:bold; font-size:15px; width:200px;display:block">第<?php echo (isset($rowpa['num'])&&$rowpa['num']>0)?($rowpa['num']+1):(isset($_SESSION['topic_number'])?$_SESSION['topic_number']:1); ?>题：</span><span style="display:block;float:right;x"><a style="color:red" href="onlinework.php?papersid=<?php echo isset($_GET['papersid'])?$_GET['papersid']:$_SESSION['papers _id']; ?>">查看本章题目>></a></span></div>
         <?php }else{ ?>
         		<div style="font-weight:bold; font-size:15px;">修改题目：</div>
         <?php } ?>
         <br/><br/>
         <?php if(!isset($_GET['tid'])){ ?>
        <span class="type">
         	请选择作业类型： 
         	<input type="radio" name="content_type" value="danx" checked>单选</input>
         	<input type="radio" name="content_type" value="duox">多选</input>
         	<input type="radio" name="content_type" value="pand">判断题</input>
         	<input type="radio" name="content_type" value="tiank">填空题</input>
         </span>
         <?php } ?>
         <br/><br/>
        
         
         <div class="danxuan">
         <form name="form2" method="post" action="newworkupdate.php">
         
         		<div>题目：<?php  if(isset($rowtopic['content'])){  echo  $rowtopic['content']; }?><img name="bjqdanxuantimubu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="danxuantimu" id="danxuantimu" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['content'])){echo  $rowtopic['content'];}?></textarea>
         		<br/><br/>
         		<div>选项A:<?php  if(isset($rowtopic['A'])){ echo  $rowtopic['A']; }?><img name="bjqdanxuanAbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         		 	<textarea name="danxuana" id="danxuana" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['A'])){ echo  $rowtopic['A'];}?></textarea>
         		
         		<br/><br/>
         		<div>选项B: <?php  if(isset($rowtopic['B'])){ echo  $rowtopic['B']; }?><img name="bjqdanxuanBbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="danxuanb" id="danxuanb" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['B'])){ echo  $rowtopic['B'];}?></textarea>
         		
         		<br/><br/>
         		<div>选项C: <?php  if(isset($rowtopic['C'])){ echo  $rowtopic['C']; }?><img name="bjqdanxuanCbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="danxuanc" id="danxuanc" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset( $rowtopic['C'])){ echo  $rowtopic['C'];}?></textarea>
         		
         		<br/><br/>
         	<div>	选项D: <?php  if(isset($rowtopic['D'])){ echo  $rowtopic['D'];} ?><img name="bjqdanxuanDbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="danxuand" id="danxuand" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['D'])){ echo  $rowtopic['D'];}?></textarea>
         		
         		<br/><br/>
         		<?php if(isset($rowtopic['topic_id'])){ ?>
         				<input type="hidden"  name="topic_id" value="<?php echo $rowtopic['topic_id']; ?>" />
         		<?php }?>
         		<?php if(isset($_GET['papersid'])){ ?>
         			<input type="hidden"  name="papersid" value="<?php echo $_GET['papersid']; ?>"/>
         		<?php }?>
         				<input type="hidden"  name="url"  value="<?php echo  $_SERVER['QUERY_STRING']; ?>" />
         		正确答案: A:<input type="radio"  name="danxuandaan" value="A"  <?php if(isset($rowtopic['answer'])&&$rowtopic['answer']=='A'){echo "checked"; }?> />&nbsp;&nbsp;&nbsp;&nbsp;B:<input type="radio" name="danxuandaan" value="B"  <?php if(isset($rowtopic['answer'])&&$rowtopic['answer']=='B'){echo "checked"; }?> />&nbsp;&nbsp;&nbsp;&nbsp;
         						C:<input type="radio" name="danxuandaan"  value="C"  <?php if(isset($rowtopic['answer'])&&$rowtopic['answer']=='C'){echo "checked"; }?> />&nbsp;&nbsp;&nbsp;&nbsp;D:<input type="radio" name="danxuandaan" value="D" <?php if(isset($rowtopic['answer'])&&$rowtopic['answer']=='D'){echo "checked"; }?> />
         		<br/><br/>
         		输入分值:<input type="text" name="danxuanfen"  value="<?php if(isset($rowtopic['score'])){ echo $rowtopic['score']; }?>"/>分
         		<br/><br/>
                输入题目类型:<select name="type">
                <?php if(isset($rowtopic['type'])){?>
				<option value="<?=$rowtopic['type']?>"><?=$rowtopic['type']?></option>
				<?php }else{?>
                <option value="命题逻辑">命题逻辑</option>
         	    <option value="谓词逻辑">谓词逻辑</option>
                <option value="集合与关系">集合与关系</option>
                <?php }?>
         		</select>
         		<br/><br/>
         		<input type="submit" name="sub2" value="提交单选" />
         </form>
         </div>
         
         <div class="duoxuan">
         <form name="form2" method="post" action="newworkupdate.php">
         		<div>题目： <?php  if(isset($rowtopic['content'])){ echo  $rowtopic['content']; }?><img name="bjqduoxuantimubu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="duoxuantimu" id="duoxuantimu" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['content'])){echo  $rowtopic['content'];}?></textarea>
         		
         		<br/><br/>
         		<div>选项A: <?php  if(isset($rowtopic['A'])){ echo  $rowtopic['A']; }?><img name="bjqduoxuanAbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="duoxuana" id="duoxuana" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['A'])){ echo  $rowtopic['A'];}?></textarea>
         		
         		<br/><br/>
         		<div>选项B:  <?php  if(isset($rowtopic['B'])){ echo  $rowtopic['B']; }?><img name="bjqduoxuanBbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="duoxuanb" id="duoxuanb" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['B'])){ echo  $rowtopic['B'];}?></textarea>
         		
         		<br/><br/>
         		<div>选项C:  <?php  if(isset($rowtopic['C'])){ echo  $rowtopic['C']; }?> <img name="bjqduoxuanCbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="duoxuanc" id="duoxuanc" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset( $rowtopic['C'])){ echo  $rowtopic['C'];}?></textarea>
         		
         		<br/><br/>
        <div> 选项D:  <?php  if(isset($rowtopic['D'])){ echo  $rowtopic['D']; }?><img name="bjqduoxuanDbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="duoxuand" id="duoxuand" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['D'])){ echo  $rowtopic['D'];}?></textarea>
         		
         		<br/><br/>
         		<?php if(isset($rowtopic['topic_id'])){ ?>
         				<input type="hidden"  name="topic_id" value="<?php echo $rowtopic['topic_id']; ?>" />
         		<?php }?>
         		<?php if(isset($_GET['papersid'])){ ?>
         			<input type="hidden"  name="papersid" value="<?php echo $_GET['papersid']; ?>"/>
         		<?php }?>
         				<input type="hidden"  name="url"  value="<?php echo  $_SERVER['QUERY_STRING']; ?>" />
         		正确答案: A:<input type="checkbox" name="duoxuandaan[]" value="A"  <?php if(isset($rowtopic['answer'])&&strstr($rowtopic['answer'],'A')){ ?>checked=checked<?php }?> />&nbsp;&nbsp;&nbsp;&nbsp;
         						B:<input type="checkbox" name="duoxuandaan[]"  value="B"  <?php if(isset($rowtopic['answer'])&&strstr($rowtopic['answer'],'B')){ ?>checked=checked<?php }?> />&nbsp;&nbsp;&nbsp;&nbsp;
         						C:<input type="checkbox"  name="duoxuandaan[]"  value="C"  <?php if(isset($rowtopic['answer'])&&strstr($rowtopic['answer'],'C')){ ?>checked=checked<?php }?> />&nbsp;&nbsp;&nbsp;&nbsp;
         						D:<input type="checkbox"  name="duoxuandaan[]"  value="D" <?php if(isset($rowtopic['answer'])&&strstr($rowtopic['answer'],'D')){ ?>checked=checked<?php }?> />
         		<br/><br/>
         		输入分值:<input type="text" name="duoxuanfen"  value="<?php if(isset($rowtopic['score'])){ echo $rowtopic['score']; }?>" />分
         		<br/><br/>
                输入题目类型:<select name="type">
                <?php if(isset($rowtopic['type'])){?>
				<option value="<?=$rowtopic['type']?>"><?=$rowtopic['type']?></option>
				<?php }else{?>
                <option value="命题逻辑">命题逻辑</option>
         	    <option value="谓词逻辑">谓词逻辑</option>
                <option value="集合与关系">集合与关系</option>
                <?php }?>
         		</select>
         		<input type="submit" name="sub3" value="提交多选" />
         		
         		
         	</form>
         </div>
         
         <div class="panduan">
         <form name="form3" method="post" action="newworkupdate.php">
         		<div>题&nbsp;&nbsp;&nbsp;目： <?php  if(isset($rowtopic['content'])){ echo  $rowtopic['content'];}?><img name="bjqpanduantimubu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         			<textarea name="panduantimu" id="panduantimu" rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['content'])){echo  $rowtopic['content'];}?></textarea>
         		
         		<br/><br/>
         		<?php if(isset($rowtopic['topic_id'])){ ?>
         				<input type="hidden"  name="topic_id" value="<?php echo $rowtopic['topic_id']; ?>" />
         		<?php }?>
         		<?php if(isset($_GET['papersid'])){ ?>
         			<input type="hidden"  name="papersid" value="<?php echo $_GET['papersid']; ?>"/>
         		<?php }?>
         				<input type="hidden"  name="url"  value="<?php echo  $_SERVER['QUERY_STRING']; ?>" />
         		正确答案: 命题正确:<input type="radio"   name="panduandaan" value='1'  <?php if(isset($rowtopic['answer'])&&$rowtopic['answer']=='1'){echo "checked"; }?> />&nbsp;&nbsp;&nbsp;&nbsp;
         		命题错误:<input type="radio"  name="panduandaan"  value="0"  <?php if(isset($rowtopic['answer'])&&$rowtopic['answer']=='0'){echo "checked"; }?> />&nbsp;&nbsp;&nbsp;&nbsp;
         		<br/><br/>
         		输入分值:<input type="text" name="panduanfen"  value="<?php if(isset($rowtopic['score'])){ echo $rowtopic['score']; }?>" />分
         		<br/><br/>
                输入题目类型:<select name="type">
                <?php if(isset($rowtopic['type'])){?>
				<option value="<?=$rowtopic['type']?>"><?=$rowtopic['type']?></option>
				<?php }else{?>
                <option value="命题逻辑">命题逻辑</option>
         	    <option value="谓词逻辑">谓词逻辑</option>
                <option value="集合与关系">集合与关系</option>
                <?php }?>
         		</select>
         		<input type="submit" name="sub4" value="提交判断" />
         	</form>
         </div>
         
         <div class="tiankong">
         <form name="form1" method="post" action="newworkupdate.php">
         		<div>题&nbsp;&nbsp;&nbsp;目：<?php  if(isset($rowtopic['content'])){ echo  $rowtopic['content']; }?><img name="bjqtiankongtimubu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         		 <textarea   id="tiankongtimu"   name="tiankongtimu"  rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['content'])){echo  $rowtopic['content'];}?></textarea>
         		
         		<br/><br/>
         		<?php if(isset($rowtopic['topic_id'])){ ?>
         				<input type="hidden"  name="topic_id" value="<?php echo $rowtopic['topic_id']; ?>" />
         		<?php }?>
         		<?php if(isset($_GET['papersid'])){ ?>
         			<input type="hidden"  name="papersid" value="<?php echo $_GET['papersid']; ?>"/>
         		<?php }?>
         				<input type="hidden"  name="url"  value="<?php echo  $_SERVER['QUERY_STRING']; ?>" />
         		<div>正确答案: <?php  if(isset($rowtopic['answer'])){ echo  $rowtopic['answer']; }?><img name="bjqtiankongtdaanbu"  type="image"  class="bianji"  src="../images/keypad.png"  /></div>
         		<textarea  id="tiankongdaan" name="tiankongdaan"  rows="10" cols="80" style="width: 600px; height: 70px" ><?php if(isset($rowtopic['answer'])){echo  $rowtopic['answer'];}?></textarea> 
                <div style="display:none">  
                <textarea name="mathml" id="mathml"></textarea>
                </div>    		
         		<br/><br/>
         		
         		输入分值:<input type="text" name="tiankongfen"  value="<?php if(isset($rowtopic['score'])){ echo $rowtopic['score']; }?>" />分
         		<br/><br/>
                输入题目类型:<select name="type">
                <?php if(isset($rowtopic['type'])){?>
				<option value="<?=$rowtopic['type']?>"><?=$rowtopic['type']?></option>
				<?php }else{?>
                <option value="命题逻辑">命题逻辑</option>
         	    <option value="谓词逻辑">谓词逻辑</option>
                <option value="集合与关系">集合与关系</option>
                <?php }?>
         		</select>
         		<input type="submit" name="sub5" value="提交填空" />         		
         	</form>
         </div>
         <br/>
         <br/>
          <?php }?>
         
         
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