<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>离散数学在线学习系统</title>
</head>

<?php 

require_once 'phpexcelreader/reader.php'; 
require_once("../sql_connect.php"); 
  require_once("../my_msg.php");
  
$data = new Spreadsheet_Excel_Reader(); 
$data->setOutputEncoding('GBK'); 

$data->read('test.xls'); 

error_reporting(E_ALL ^ E_NOTICE);
mysql_query("set names GBK");


$sqlstr="select * from user where User_no =".$_SESSION['user_no'];
$result = mysql_query($sqlstr,$link);
$row = mysql_fetch_array($result, MYSQL_BOTH);
$User_realname= $row["User_realname"];



for ($i = 2; $i<=$data->sheets[0]['numRows']; $i++) { 
$sqlstr="INSERT INTO user (User_no,User_realname,User_class,User_teacher) VALUES ('". 
$data->sheets[0]['cells'][$i][1]."','". 
$data->sheets[0]['cells'][$i][2]."','". 
$data->sheets[0]['cells'][$i][3]."','".$User_realname."')"; 
echo $sqlstr.'<br/>'; 
$result = mysql_query($sqlstr,$link);
} 

for ($i = 2; $i<=$data->sheets[0]['numRows']; $i++) { 

$sqlstr="INSERT INTO stu_model (Stu_no) VALUES ('". 
$data->sheets[0]['cells'][$i][1]."')"; 
echo $sqlstr.'<br/>'; 
$result = mysql_query($sqlstr,$link);
} 

for ($i = 2; $i<=$data->sheets[0]['numRows']; $i++) { 

$sqlstr="INSERT INTO model_detial (Stu_no) VALUES ('". 
$data->sheets[0]['cells'][$i][1]."')"; 
echo $sqlstr.'<br/>'; 
$result = mysql_query($sqlstr,$link);
} 
my_msg("添加成功",'add_stu.php');
?> 
