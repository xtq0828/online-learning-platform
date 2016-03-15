<?php
session_start();
include_once("../sql_connect.php");
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
$sql="delete  from topic where topic_id='".$_POST['topic_id']."' ";

if(mysql_query($sql,$link)) {
	
	echo "删除成功";
}else{
	echo "删除失败";
}



