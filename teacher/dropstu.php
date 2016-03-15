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
 
	$sqlstr="delete from user where User_no=".$_GET["id"];
	$result = mysql_query($sqlstr,$link);
	$sqlstr="delete from stu_model where Stu_no=".$_GET["id"];
	$result = mysql_query($sqlstr,$link);
	$sqlstr="delete from model_detial where Stu_no=".$_GET["id"];
	$result = mysql_query($sqlstr,$link);
	my_msg2("删除学生成功！");
    my_header("stu_xinxi.php");
    


  


mysql_free_result($result);
mysql_close($link);


?>