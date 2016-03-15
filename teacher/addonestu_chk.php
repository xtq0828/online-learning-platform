<?php
	session_start();
	$lifeTime = 1800;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
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
  
  

    if ($_POST['Stu_no']=='' || $_POST['Stu_name']==''||$_POST['Stu_class']==''){
	my_msg2("字段不可空白");
	my_header("addonestu.php");
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






 
$sqlstr="INSERT INTO user (User_no,User_realname,User_class,User_teacher) VALUES ('". 
$_POST['Stu_no']."','". 
$_POST['Stu_name']."','". 
$_POST['Stu_class']."','".$User_realname."')"; 
$result = mysql_query($sqlstr,$link);


$sqlstr="INSERT INTO stu_model (Stu_no) VALUES ('". 
$_POST['Stu_no']."')"; 
$result = mysql_query($sqlstr,$link);


$sqlstr="INSERT INTO model_detial (Stu_no) VALUES ('". 
$_POST['Stu_no']."')"; 

$result = mysql_query($sqlstr,$link);
} 



mysql_free_result($result);
mysql_close($link);

my_msg2("学生信息添加成功！");
my_header("stu_xinxi.php");
?>