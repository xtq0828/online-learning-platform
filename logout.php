<?php
	session_start();
    include_once("sql_connect.php");
    include_once("my_msg.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>离散数学在线学习系统</title>
<?php
    $_SESSION['logouttime']=time();
	$studytime=($_SESSION['logouttime']-$_SESSION['logintime'])/60;
    $sqlstr="select Stu_login from stu_model where Stu_no=".$_SESSION['user_no']."";
	$result = mysql_query($sqlstr,$link);
	$times=mysql_fetch_row($result);
	$sqlstr="select Stu_studytime from stu_model where Stu_no=".$_SESSION['user_no']."";
	$result = mysql_query($sqlstr,$link);
	$lastaverage=mysql_fetch_row($result);
	$averagetime=floor((($times[0]-1)*$lastaverage[0]+$studytime)/$times[0]);
	$sqlstr="update stu_model set Stu_studytime=".$averagetime." where Stu_no=".$_SESSION['user_no']."";
	$result = mysql_query($sqlstr,$link);
	mysql_free_result($result);
    mysql_close($link);
    unset($_SESSION['user_no']);
	unset($_SESSION['type']);
    session_destroy();//释放所有session
	my_msg2("你已成功注销帐户！");
    my_header("login.php");//自动跳到首页
?>