<?php
session_start();
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
<link rel="StyleSheet"  href="../ASCIIMathML.js" type="text/javascript"/>
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
<script type="text/javascript" src="../ASCIIMathML.js"></script>
<script type="text/javascript">
var file;
var i=0;
var myDate = new Date();
var minute=myDate.getMinutes();
var hour = myDate.getHours(); 
var time1=60*hour+minute;   
window.onunload = onunload_handler;    
function onunload_handler(){   
var myDate2 = new Date();
var minute=myDate2.getMinutes();
var hour = myDate2.getHours(); 
var time2=60*hour+minute; 
document.getElementById("time").value=time2-time1;
}
function init()
{
	document.getElementById("inputText2").value="";
}
function Bold()
        {
		var Ftext=document.selection.createRange();
        Ftext.execCommand("Bold");
		Ftext.execCommand("BackColor",true,"#FFFF00");
		document.getElementById("inputText2").value=document.getElementById("inputText2").value+Ftext.text+"\r\n";

        }
function Bold1()
        {
		var Ftext=document.selection.createRange();
        Ftext.execCommand("Bold");
		Ftext.execCommand("BackColor",true,"");

        }
		function insert(s) {
			var obj = document.getElementById("inputText2");
if(document.selection) { 
obj.focus(); 
var sel=document.selection.createRange(); 
document.selection.empty(); 
sel.text = s; 
} else { 
var prefix, main, suffix; 
prefix = obj.value.substring(0, obj.selectionStart); 
main = obj.value.substring(obj.selectionStart, obj.selectionEnd); 
suffix = obj.value.substring(obj.selectionEnd); 
obj.value = prefix + s + suffix; 
} 
obj.focus(); 
		}
	var listnum=0;
  var menu_height;
  var menu_width;
  var menu_left;
  var menu_top;
  var topMar = 1;
  var leftMar = -2;
  var space = 1;
  var isvisible;
  
function listbox(listname,buttonname,valuename)
  {//
  this.listname=listname
  this.buttonname=buttonname
  this.valuename=valuename
  }
function listaction(obj,action,showlist,scroll,tw)
  {
  num=obj.id.charAt(obj.id.length-1)
  if (!scroll) {scroll=0}
  if (!tw) {tw=105}
  listbox=eval(lb[num].listname)
  listbutton=eval(lb[num].buttonname)
  listvalue=eval(lb[num].valuename)
  switch (action)
  {
  case 0:
  listbox.className="getlist";listbutton.className="listover"
  break;
  case 1:
  if (listbox.gf=="0")
  {listbox.className="lostlist";listbutton.className="menubar"}
  break;
  case 2:
  for (i=0;i<lb.length;i++)
  {
  if (num!=i.toString()){
  nlistbox=eval(lb[i].listname)
  nlistbutton=eval(lb[i].buttonname)
  nlistvalue=eval(lb[i].valuename)
  nlistbox.className="lostlist";nlistbutton.className="menubar"
  nlistbox.gf="0"
  }
  }
  ShowMenu(listbox,showlist,tw,scroll);listbox.className="getlist";listbox.gf="1"
  listnum=num;
  break;
  }
  }
function HideMenu()
  {
  var mX;
  var mY;
  var vDiv;
  var mDiv;
  if (isvisible == true)
  {
  vDiv = document.all("listDiv");
  mX = window.event.clientX + document.body.scrollLeft;
  mY = window.event.clientY + document.body.scrollTop;
  if ((mX < parseInt(vDiv.style.left)) || (mX > parseInt(vDiv.style.left)+vDiv.offsetWidth) ||
  (mY < parseInt(vDiv.style.top)-menu_height) || (mY > parseInt(vDiv.style.top)+vDiv.offsetHeight)) {
  vDiv.style.visibility = "hidden";
  isvisible = false;
  }
  }
  if (isvisible==false)
  {
  for (i=0;i<lb.length;i++)
  {
  listbox=eval(lb[i].listname)
  listbutton=eval(lb[i].buttonname)
  listvalue=eval(lb[i].valuename)
  listbox.className="lostlist";listbutton.className="menubar"
  listbox.gf="0"
  }
  }
  }
function ShowMenu(obj,vMnuCode,tWidth,scroll) {
  vMnuCode = "<table id='submenu' cellspacing=0 cellpadding=0 bgcolor=#ffffff border=0 style='width:"+tWidth +";border-collapse: collapse' class='listDiv'><tr height=23><td nowrap align=left>" +
  vMnuCode + "</td></tr></table>";
  menu_height = obj.offsetHeight;
  menu_width = obj.offsetWidth;
  menu_left = obj.offsetLeft + leftMar+2;
  menu_top = obj.offsetTop + topMar + menu_height + space-3;
  vParent = obj.offsetParent;
  while (vParent.tagName.toUpperCase() != "BODY")
  {
  menu_left += vParent.offsetLeft;
  menu_top += vParent.offsetTop;
  vParent = vParent.offsetParent;
  }
  listDiv.innerHTML = vMnuCode;
  listDiv.style.top = menu_top;
  listDiv.style.left = menu_left;
  if (scroll==0) {listDiv.style.overflow="visible";listDiv.style.width=tWidth}
  else {listDiv.style.overflow="scroll";listDiv.style.width=tWidth+18}
  listDiv.style.visibility = "visible";
  var cssopaction=submenu.filters[0].opacity
  submenu.filters[0].opacity=0;
  submenu.filters[1].Apply();
  submenu.filters[0].opacity=100;
  submenu.filters[1].Play();
  isvisible = true;
  }
function menuitem(lightcolor,normalcolor,icon,title,url)
  {
  this.lightcolor=lightcolor
  this.normalcolor=normalcolor
  this.icon=icon
  this.title=title
  this.url=url
  }
function bulidmenu(arrayname)
  {
  var menuarray=eval(arrayname)
  menucontent='<table border="0" width="100%">'
  for (i=0;i<menuarray.length;i++)
  {
  if (menuarray[i].title!="_line")
  {
  if (menuarray[i].url!="_disable"){css="getitem"}else{css="lostitem"}
  if (menuarray[i].icon.length==0)
  {
  content='<table cellspacing="0" cellpadding="0"><tr><td style="text-indent:4px" class="'+css+'">'+menuarray[i].title+'</td></tr></table>'
  }
  else
  {
  content='<table cellspacing="0" cellpadding="0"><tr><td width="20" nowrap><img src="'+menuarray[i].icon+'"></td><td class="'+css+'">'+menuarray[i].title+'</td></tr></table>'
  }
  if (menuarray[i].url!="_disable"){
  menucontent=menucontent+'<tr><td height=16 style="cursor:default" onmouseover="style.backgroundColor=\''+ menuarray[i].lightcolor+'\'" onmouseout="style.backgroundColor=\''+ menuarray[i].normalcolor+'\'" onclick="Golist(\''+menuarray[i].title+'\')">'+content+'</td></tr>'
  }
  else
  {
  menucontent=menucontent+'<tr><td height=16 style="fitler:gray">'+content+'</td></tr>'
  }
  }
  else
  {
  menucontent=menucontent+'<tr><td height=4><img src="images/dock.gif" width="99%" height=1></td></tr>'
  }
  }
  menucontent=menucontent+"</table>"
  return menucontent
  }
  function HL_Menu(obj,state)
  {
  switch (state)
  {
  case 0:
  obj.className="menuover"
  break;
  case 1:
  obj.className="menuup"
  break;
  }
  }
  var lb=new Array()
  lb[0]=new listbox('listbox0','listbutton0','listvalue0')
  lb[1]=new listbox('listbox1','listbutton1','listvalue1')
  var list1=new Array()
  list1[0]=new menuitem("#B1CBE4","","","ListItem1","")
  list1[1]=new menuitem("#B1CBE4","","","ListItem2","")
  list1[2]=new menuitem("#B1CBE4","","","ListItem3","")
  list1[3]=new menuitem("#B1CBE4","","","ListItem4","")
  list1[4]=new menuitem("#B1CBE4","","","ListItem5","")
  list1[5]=new menuitem("#B1CBE4","","","ListItem6","")
  list1[6]=new menuitem("#B1CBE4","","","ListItem7","")
  list1[7]=new menuitem("#B1CBE4","","","ListItem8","")
  list1[8]=new menuitem("#B1CBE4","","","ListItem9","")
  list1[9]=new menuitem("#B1CBE4","","","ListItem10","")
blist1=bulidmenu("list1")
var list2=new Array()
  list2[0]=new menuitem("#B1CBE4","","","字体1","")
  list2[1]=new menuitem("#B1CBE4","","","字体2","")
  list2[2]=new menuitem("#B1CBE4","","","字体3","")
  list2[3]=new menuitem("#B1CBE4","","","字体4","")
  list2[4]=new menuitem("#B1CBE4","","","字体5","")
  list2[5]=new menuitem("#B1CBE4","","","字体6","")
  list2[6]=new menuitem("#B1CBE4","","","字体7","")
  list2[7]=new menuitem("#B1CBE4","","","字体8","")
  list2[8]=new menuitem("#B1CBE4","","","字体9","")
  list2[9]=new menuitem("#B1CBE4","","","字体10","")
blist2=bulidmenu("list2")
  function Golist(text)
  {
  listvalue=eval(lb[listnum].valuename)
  listvalue.innerText=text
  vDiv = document.all("listDiv");
  vDiv.style.visibility = "hidden";
  isvisible = false;
  } 
 </script>
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
<body onload="init()">

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
        <div class="left_title">目录</div>
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
      <div class="right_title1"></div>
        <div class="left" id="myDiv">
         <?php
$dir="../keben/wendang"; //这里输入其它路径
//PHP遍历文件夹下所有文件
$handle=opendir($dir."."); 
while (false !== ($file = readdir($handle)))
{
if ($file != "." && $file != "..") { 
$file1 = iconv('GB2312','UTF-8',$file);
$file1 = explode(' ',$file1);
$phpself =$_SERVER['PHP_SELF'];
 $str = end(explode("/",$phpself));
 $str=explode('.php',$str);
  if ($str[0]==$file1[0])
  {
	  $file="../keben/wendang/".$file;
	  $con=file_get_contents($file);
	  $con=preg_replace('/\n|\r\n/','geiwoba',$con);
	 echo"<script>
	 var str = '$con'.replace(/geiwoba/g,'\\n');
	if (AMnames.length==0) initSymbols(); 
  var outnode = document.getElementById('myDiv');
  outnode.innerHTML='';
  var newp=document.createElement('p');
    newp.innerText=str;
    outnode.appendChild(newp);
  AMprocessNode(outnode);
	</script>"; 
  }  
  }
}

		?>
       </div>
       <div class="clear"></div>
       <div class="right_title1"></div>
       <input type="button" value="高 亮" onclick="Bold()" />
       <input type="button" value="取消高亮" onclick="Bold1()" />
       <div class="right" id=listDiv style='border:1px #636563 solid;VISIBILITY: hidden;POSITION: absolute;overflow:scroll;height:150'></div>

 <table  class="right" border="0" cellspacing="0" cellpadding="0" height="44">
     <tr>
    <td></td>
    <td width="5"></td>
    <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">

    </td>
 
      
     
  <tr>
 <td height="44">
   <table border="1" width="100" id="table32" cellspacing="0" cellpadding="4" bgcolor="#F7F7F7" style="border-collapse: collapse">
  <tr>
    <td height="34" class="menubar">
   <table border="0" width="100%" id="table33" cellspacing="0" cellpadding="0">
     <tr>
    <td width="10" nowrap>
      <table border="0" width="2" cellspacing="0" cellpadding="1" id="table34">
     <tr>
       <td><img style="border:1px inset" height="1" width="1"></td>
     </tr>
     <tr>
       <td><img style="border:1px inset" height="1" width="1"></td>
     </tr>
     <tr>
       <td><img style="border:1px inset" height="1" width="1"></td>
     </tr>
     <tr>
       <td><img style="border:1px inset" height="1" width="1"></td>
     </tr>
      </table>
    </td>
    <td width="78" nowrap><div id="listbox0" class="lostfocus" gf="0" onmouseover='listaction(this,0)' onmouseout='listaction(this,1)' onclick='listaction(this,2,blist1,0)' style="cursor:default">
      <table border="0" cellpadding="0" cellspacing="0" width="100" height="18" id="table35">
     <tr>
       <td valign="center" style="text-indent:4px"><font size="2" face="Verdana"><span id="listvalue0"> </span></font></td>
       <td width="12" align="center" class="menubar" id="listbutton0">
      <table border="0" cellpadding="0" style="border-collapse: collapse" id="table36">
        <tr height="1">
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
        </tr>
        <tr height="1">
       <td></td>
       <td bgcolor="#000000"></td>
       <td bgcolor="#000000"></td>
       <td bgcolor="#000000"></td>
       <td></td>
        </tr>
        <tr height="1">
       <td></td>
       <td></td>
       <td bgcolor="#000000"></td>
       <td></td>
       <td></td>
        </tr>
      </table>
       </td>
     </tr>
      </table>
    </div></td>
    <td width="78" nowrap><div id="listbox1" class="lostfocus" gf="0" onmouseover='listaction(this,0)' onmouseout='listaction(this,1)' onclick='listaction(this,2,blist2,1,100)' style="cursor:default">
      <table border="0" cellpadding="0" cellspacing="0" width="100" height="18" id="table37">
     <tr>
       <td valign="center" style="text-indent:4px"><font size="2" face="Verdana"><span id="listvalue1"> </span></font></td>
       <td width="12" align="center" class="menubar" id="listbutton1">
      <table border="0" cellpadding="0" style="border-collapse: collapse" id="table38">
        <tr height="1">
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
       <td width="1" bgcolor="#000000"></td>
        </tr>
       <tr height="1">
       <td></td>
       <td bgcolor="#000000"></td>
       <td bgcolor="#000000"></td>
       <td bgcolor="#000000"></td>
       <td></td>
        </tr>
        <tr height="1">
       <td></td>
       <td></td>
       <td bgcolor="#000000"></td>
       <td></td>
       <td></td>
        </tr>
      </table>
       </td>
     </tr>
      </table>
    </div></td>
    <td width="4" nowrap></td>
    <td width="5" nowrap><img style="border:1px inset" height=14 width=0></td>
   <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem" align=center onClick="insert('sube')"><b>⊆</b></td>
     </tr>
      </table>
      
    </td>
  <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem" align=center onClick="insert('supe')"><b>⊇</b></td>
     </tr>
      </table>
      
    </td>
   <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem" align=center onClick="insert('sub')"><b>⊂</b></td>
     </tr>
      </table>
      
    </td>
     <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem" align=center onClick="insert('sup')"><b>⊃</b></td>
     </tr>
      </table>
      
    </td>
    <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('not')"><b>¬</b></td>
     </tr>
      </table>
      
    </td>
    <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('AA')"><b>∀</b></td>
     </tr>
      </table>
      
    </td>
    <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('EE')"><b>∃</b></td>
     </tr>
      </table>
      
    </td>
    <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('in')"><b>∈</b></td>
     </tr>
      </table>
      
    </td>
       <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('!in')"><b>∉</b></td>
     </tr>
      </table>
    </td>
     <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('<=>')"><b>⇔</b></td>
     </tr>
      </table>
      
    </td>
     <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('=>')"><b>=></b></td>
     </tr>
      </table>
      
    </td>
       <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('nnn')"><b>∩</b></td>
     </tr>
      </table>
      
    </td>
    <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('uuu')"><b>∪</b></td>
     </tr>
      </table>
      
    </td>
 
         <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('or')"><b>∨</b></td>
     </tr>
      </table>
      
    </td>
         <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('and')"><b>∧</b></td>
     </tr>
      </table>
      
    </td>
     <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('P')"><b>P</b></td>
     </tr>
      </table>
      
    </td>
     <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('Q')"><b>Q</b></td>
     </tr>
      </table>
      
    </td>
     <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('R')"><b>R</b></td>
     </tr>
      </table>
      
    </td>
       <td nowrap align="center" onmouseover="HL_Menu(this,0)" onmouseout="HL_Menu(this,1)" class="menuup">
      <table cellspacing="0" cellpadding="0" id="table41" width="16">
     <tr>
       <td nowrap></td>
       <td class="leftitem"  align=center onClick="insert('S')"><b>S</b></td>
     </tr>
      </table>
      
    </td>
    <td width="100%" nowrap></td>
     </tr>
   </table>
    </td>
  </tr>
   </table>
 </td>
  </tr>
</table>
    <form class="right" action="tijiao.php" method="post"> 
    <?php
    $phpself =$_SERVER['PHP_SELF'];
 $str = end(explode("/",$phpself));
 $str=explode('.php',$str);
 ?>
    <input type="text" name="xuhao" id="xuhao" value="<?php echo $str[0]?>" style="display:none"/> 
    <input type="text" name="time" id="time" style="display:none"/> 
       <textarea id="inputText2" name="inputText2" rows="12" cols="83"></textarea>
    </div>
     <div class="right">
     <input type="submit" value="提交" onclick="onunload_handler()"/>
     </form>
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
