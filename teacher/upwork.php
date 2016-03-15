<?php session_start();  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

 include_once("../sql_connect.php");
  include_once("../my_msg.php");
  mysql_query("set names utf8");
  $sqlstr="select * from user where User_no =".$_SESSION['user_no'];
	$result = mysql_query($sqlstr,$link);

	$row = mysql_fetch_array($result, MYSQL_BOTH);

if(mysql_num_rows ($result)==1 ){
	$User_realname= $row["User_realname"];
	$User_no= $row["User_no"];
	$User_class= $row["User_class"];
}else{
	session_destroy();
	my_msg("该用户不存在","login.html");
}

if(isset($_POST['sub'])){
	//更新作业单元表
	$paperstime=strtotime($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
	$sqlstr="update  papers set papers_title='".$_POST['pname']."',papers_time='".$paperstime."' where papers_id='".$_POST['pid']."' ";
	
	$result = mysql_query($sqlstr,$link);
	
	if($result){
		my_msg('修改成功','teachworklist.php');
	}else{
		my_msg('悲催~修改失败','teachworklist.php');
	}
	}else{
			
		echo "数据错误，请点击返回";
		echo "<br/>";
		echo "<a href='teachworklist.php'>返回</a>";
	}
