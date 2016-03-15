<?php
	session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>离散数学在线学习系统</title>
</head>


<?php

  date_default_timezone_set('Asia/Shanghai');

  include_once("../sql_connect.php");
  include_once("../my_msg.php");
  
  if($_GET["type"]==2){
	$sqlstr="delete from notice where Notice_ID=".$_GET["id"];
	$result = mysql_query($sqlstr,$link);
	my_msg2("删除公告成功！");
    my_header("tea_notice.php");
}
else{
    if ($_POST['Notice_title']=='' or $_POST['Notice_content']==''){
	my_msg2("字段不可空白");
	my_header("notice_content.php?id=".$_GET["id"]);
}
else
{
mysql_query("set names utf8");
  $sqlstr="select * from user where User_no =".$_SESSION['user_no'];
	$result = mysql_query($sqlstr,$link);
	$row = mysql_fetch_array($result, MYSQL_BOTH);
if(mysql_num_rows ($result)==1 ){
	$User_realname= $row["User_realname"];
	$User_no= $row["User_no"];
}else{
	session_destroy();
	my_msg("你还没有登陆","../login.php");
}


$sqlstr="update notice set Notice_title='".$_POST['Notice_title']."',Notice_content='"
.$_POST['Notice_content']."' where Notice_ID=".$_GET["id"];
$result = mysql_query($sqlstr,$link);
my_msg2("修改公告成功！");
my_header("notice_content.php?id=".$_GET["id"]);
}
mysql_free_result($result);
mysql_close($link);

}
?>