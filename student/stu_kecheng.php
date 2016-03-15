<?php
    session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>详细情况</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
</head>
<style>
  .lostfocus { border: 1px #ffffff solid; background-color: #ffffff; font-size: 12px; font-family: Arial; }
  .getfocus { border: 1px #08246B solid;background-color: #ffffff; font-family: Arial; font-size: 12px; }
.menubar {filter:progid:DXImageTransform.Microsoft.Gradient(gradienttype=0, startcolorstr=#F7F7F7, endcolorstr=#DEDBD6)}
  .bodybar {filter:progid:DXImageTransform.Microsoft.Gradient(gradienttype=1, endcolorstr=#F7F7F7, startcolorstr=#DEDBD6)}
  .leftitem { font-family: Arial; font-size: 12px; color: #000000; cursor: hand }
  .getitem { font-family: Arial; font-size: 12px; color: #000000; cursor: default }
  .lostitem { cursor: default; color: #808080; font-size: 12px; font-family: Arial; }
  .menuup { PADDING-LEFT: 4px; PADDING-RIGHT: 4px; CURSOR: hand;}
  .menuover { PADDING-LEFT: 3px; PADDING-RIGHT: 3px; BACKGROUND-COLOR: #B5BED6; BORDER: 1px solid #08246B; CURSOR: hand; }
  .lostlist { border: 1px #ffffff solid; background-color: #ffffff; font-size: 12px; font-family: Arial; }
  .getlist { border: 1px #08246B solid;background-color: #ffffff; font-family: Arial; font-size: 12px; }
.listover {BACKGROUND-COLOR: #B5BED6; BORDER-left:1px solid #08246B}
  .listDiv { filter: alpha(opacity=90,finishopacity=0,style=0) blendtrans(duration=.3); }
  #myDiv{ 
    width:690px;                                      /*调整显示区的宽*/ 
    height:400px;                                     /*调整显示区的高*/ 
    font-size:14px; 
	color:#333333;
    line-height:18px; 
    overflow-pageINdex:hidden; 
    overflow:auto; 
    word-break:break-all; 
} 

</style>
<body">

<?php
  if(isset($_SESSION['user_no']))  
  {
	  include_once("../sql_connect.php");
      include_once("../my_msg.php");
      mysql_query("set names utf8");
      $sqlstr="select * from user where User_no =".$_SESSION['user_no'];
	  $result = mysql_query($sqlstr,$link);
	  $row = mysql_fetch_array($result, MYSQL_BOTH);
      if(mysql_num_rows ($result)==1 ){
	  $User_nickname= $row["User_nickname"];
	  $User_realname= $row["User_realname"];
	  $User_no= $row["User_no"];
	  }
  
mysql_free_result($result);
mysql_close($link);
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
        <div class="left_title">课程目录</div>
        <div class="left_news">
           <div id="dtree"></div>
        <p><a href="javascript: d.openAll();">打开全部</a> | <a href="javascript: d.closeAll();">关闭全部</a></p>
          <script src="../js/dtree.js"></script>
          <?php
		  echo  "<script>d = new dTree('d');d.add(0,-1,'离散数学课程');</script>";
$dir="../keben/wendang"; //这里输入其它路径
//PHP遍历文件夹下所有文件
$handle=opendir($dir."."); 
while (false !== ($file = readdir($handle)))
{
if ($file != "." && $file != "..") { 
$file1 = iconv('GB2312','UTF-8',$file);
$file = explode(' ',$file);
echo  "<script>
var reg = /\.txt$/;      
           var str = '$file1'.replace(reg,'');
		   var m = [];
    var t = '';
    var lastNum = false;
    for(var i=0;i<4;i++){
        var tmp = str.charAt(i);
        if(tmp >= '0' && tmp <= '9'){
                t += tmp;
            lastNum = true;
        }else{
            if(t != ''){
                m.push(t);
                t = '';
            }
            m.push(tmp);
            lastNum = false;
        }
    }
    if(t != ''){
        m.push(t);
		}
		if(m[1]!='.')
		{
	    for(i=0;i<20;i++)
        str=str.replace(i,'');
		d.add((m[0]-1)*20+1,0,'第'+m[0]+'章'+str,'','','','img/book.gif','img/bookopen.gif');
		}
		else 
		d.add((m[0]-1)*20+1+m[2],(m[0]-1)*20+1,str,'../student/'+'$file[0]'+'.php');
		</script>";
}
}
closedir($handle); 
echo  "<script>document.write(d);</script>";
?> 
	
        </div>
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
         <div class="right_title"><b>北京理工大学</b>
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
  <div class="bottom">北京理工大学软件学院<br />
    版权所有<a></a> </div>
</div>
<script src="../js/meun.js" type="text/javascript"></script>
</body>
</html>
