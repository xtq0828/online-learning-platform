<?php
	session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
    include_once("sql_connect.php");
    include_once("my_msg.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>离散数学在线学习系统</title>
</head>


<?php
date_default_timezone_set('Asia/Shanghai');
mysql_query("set names utf8");
if ($_POST['user_no']=='' or $_POST['user_password']==''){
	my_msg("字段不可空白","login.php");
}

$sqlstr="select * from user where User_no =".$_POST['user_no']." and User_password = '".$_POST['user_password']."'";
$result = mysql_query($sqlstr,$link);

$row = mysql_fetch_array($result, MYSQL_BOTH);

if(mysql_num_rows ($result)==1 && $row["User_typeid"]==1){
	$_SESSION['user_no']=$_POST['user_no'];
	$_SESSION['type']=1;
	my_header("teacher/tea_index.php");// 管理员登录
}else if(mysql_num_rows ($result)==1 && $row["User_typeid"]==2){	
	$_SESSION['user_no']=$_POST['user_no'];
	$_SESSION['type']=2;
	$_SESSION['logintime']=time();
	$date["m"]=date("m");
	$sqlstr="select * from stu_model where Stu_no=".$_POST['user_no']."";
	$result = mysql_query($sqlstr,$link);
	if(mysql_fetch_row($result)<1){
		$sqlstr="insert into stu_model (Stu_no, Stu_login, Stu_logintime, Stu_studytime, Stu_month) values ('".$_POST['user_no']."', '1', '".date("Y-m-d")."', '0', '".$date["m"]."')";
		$result = mysql_query($sqlstr,$link);
	}
	
	$sqlstr="update stu_model set Stu_logintime='".date("Y-m-d")."',Stu_login=Stu_login+1 where Stu_no=".$_POST['user_no']." and Stu_logintime!='".date("Y-m-d")."' and Stu_month='".$date["m"]."'";
	$result = mysql_query($sqlstr,$link);
	
	$sqlstr="update stu_model set Stu_logintime='".date("Y-m-d")."',Stu_lastlogin=Stu_login,Stu_lastmonth=Stu_month,Stu_month='".$date["m"]."',Stu_login=1,Stu_studytime=0 where Stu_no=".$_POST['user_no']." and Stu_logintime!='".date("Y-m-d")."' and Stu_month!='".$date["m"]."'";
	$result = mysql_query($sqlstr,$link);
	
	$sqlstr="select * from stu_model where Stu_no =".$_POST['user_no'];
    $result = mysql_query($sqlstr,$link);
	$row = mysql_fetch_row($result);
	$last_login = $row[3];
	if($last_login>=20)
	{
		$sqlstr="update model_detial set Stu_loginhabit='良好的登录习惯' where Stu_no=".$_POST['user_no'];
	    $result = mysql_query($sqlstr,$link);
	}
	else if($last_login>=10)
	{
		$sqlstr="update model_detial set Stu_loginhabit='有待于养成登录习惯' where Stu_no=".$_POST['user_no'];
	    $result = mysql_query($sqlstr,$link);
	}
	else if($last_login!=0)
	{
		$sqlstr="update model_detial set Stu_loginhabit='很少登陆' where Stu_no=".$_POST['user_no'];
	    $result = mysql_query($sqlstr,$link);
	}
	
	my_header("student/stu_index.php");// 会员登录
}else{
	my_msg("登录失败，请重新登录","login.php");
	
}
mysql_free_result($result);
mysql_close($link);
?>
