<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>资源上传下载</title>
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
    date_default_timezone_set('Asia/Shanghai');
	include_once("../sql_connect.php");
  include_once("../my_msg.php");
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

 $sqlstr="select * from resource  Order by Resource_time ASC";
	$result1 = mysql_query($sqlstr,$link);

	while($row=mysql_fetch_row($result1))
	{
		$resource=$resource."
	<tr>
  		<td width=\"30%\" height=\"18\"><a href='../upload/".$row[1]."'>".$row[1]."</a></td>
        <td width=\"15%\" align=\"center\"><a>".$row[2]."</a></td>
        <td width=\"15%\" align=\"center\">".$row[4]."</td>
		<td width=\"10%\" align=\"center\">".(int)($row[3]/1024)."KB</td>	
		<td width=\"10%\" align=\"center\">".$row[5]."</td>	
		<td width=\"10%\" align=\"center\">".$row[6]."</td>	
		<td width=\"10%\" align=\"center\"><a href='dropresource.php?id=".$row[0]."'>删除</a></td>	
   </tr>";
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
              <input name="input2" type="image" src="../images/img_63.gif" onclick="javascript:window.location.href='add_stu.php'"/>
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
        <div class="news_title"><img src="../images/title_12.gif" /></div>
      <form  method="post" enctype="multipart/form-data"> 上传：      <input type="file" name="upfile" /> 
      
      <select name="chapter">
      <option></option>
      <option value="命题逻辑">命题逻辑</option>
      <option value="谓词逻辑">谓词逻辑</option>
      <option value="集合与关系">集合与关系</option>
      <option value="函数">函数</option>
      <option value="代数结构">代数结构</option>
      <option value="格和布尔代数">格和布尔代数</option>
      <option value="图论">图论</option>
      <option value="形式语言与自动机">形式语言与自动机</option>
      <option value="纠错码初步">纠错码初步</option>
      </select>
      
      <select name="type">
      <option value="公共资源">公共资源</option>
      <option value="私有资源">私有资源</option>
      </select>
      
      <input type="submit" name="submit" value="上传" /> 
      </form>
<?php
$max_file_size=2*1024*1024;   //上传文件大小限制, 单位BYTE
$flag=0;
$destination_folder="../upload/"; //上传文件路径
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
    //是否存在文件
	{ 
	    echo "<font color='red'>文件不存在！</font>";
		$flag=1;
	}
	else if($_POST["chapter"]==''){
		echo "<font color='red'>请选择类型！</font>";
		$flag=1;
	}
	if($flag==0){
$file = $_FILES["upfile"];
if($max_file_size < $file["size"])
//检查文件大小
{
echo "<font color='red'>文件太大！</font>";
$flag=1;
  }
if($flag==0){
if(!file_exists($destination_folder)) mkdir($destination_folder);
$filename=$file["tmp_name"];
 $pinfo=pathinfo($file["name"]);
$ftype=$pinfo[extension];
$destination = $destination_folder.$file["name"];
$destination=iconv("utf-8","gbk",$destination);
}
if (file_exists($destination) && $overwrite != true)
{
     echo "<font color='red'>同名文件已经存在了！</font>";
     $flag=1;
  }

if(!move_uploaded_file ($filename, $destination))
{
   echo "<font color='red'>移动文件出错！</font>";
     $flag=1;;
  }
if($flag==0){
$pinfo=pathinfo($destination);
$fname=$pinfo[basename];


$sqlstr="insert into resource (Resource_title,Resource_name,Resource_size,Resource_time,Resource_chapter,Resource_type) values ('".$file["name"]."','".$User_realname."','".$file["size"]."','".date("Y-m-d")."','".$_POST["chapter"]."','".$_POST["type"]."')";

my_msg("成功上传！".$file["name"],'tea_upload.php');
//echo " <font color=red>已经成功上传</font><br>文件名: <font color=blue>".$file["name"]."</font><br>";
	}
	}
	$result = mysql_query($sqlstr,$link);

    mysql_close($link);
}
?>




      </div>
      <div class="news">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
  		<td width="30%" height="18"><a style="font-weight:bold">资源名称</a></td>
       <td width="15%" align="center" style="font-weight:bold">上传人</td>
        <td width="15%" align="center" style="font-weight:bold">上传时间</td>
		<td width="10%" align="center" style="font-weight:bold">大小</td>
        <td width="10%" align="center" style="font-weight:bold">所属章节</td>
        <td width="10%" align="center" style="font-weight:bold">资源类型</td>
        <td width="10%" align="center" style="font-weight:bold"></td>
        
   </tr> 
         
		 <?=$resource?>  
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
  <div class="bottom"> 北京理工大学软件学院<br />
    版权所有<a></a> </div>
</div>
<script src="../js/meun.js" type="text/javascript"></script>
</body>
</html>
