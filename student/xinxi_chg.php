<?php
	session_start();
    $lifeTime = 1200;
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
  
  

    if ($_POST['Stu_no']=='' || $_POST['Stu_name']==''||$_POST['Stu_class']==''||$_POST['Stu_password']==''){
	my_msg2("字段不可空白");
	my_header("xinxi.php?id=".$_GET["id"]);
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
	my_msg("您不在线上！","../login.php");
}


$sqlstr="update user set User_no='".$_POST['Stu_no']."',User_realname='"
.$_POST['Stu_name']."',User_class='"
.$_POST['Stu_class']."',User_mail='"
.$_POST['Stu_mail']."',User_nickname='"
.$_POST['Stu_nick']."',User_password='"
.$_POST['Stu_password']."' where ID=".$_GET["id"];
$result = mysql_query($sqlstr,$link);

$sqlstr="update model_detial set Stu_habit='".$_POST['Stu_habit']."' where Stu_no=".$_POST['Stu_no'];
$result = mysql_query($sqlstr,$link);

my_msg2("学生信息修改成功！");
my_header("xinxi.php?id=".$_GET["id"]);
}
mysql_free_result($result);
mysql_close($link);


?>