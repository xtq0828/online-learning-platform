 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>资源上传下载</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />


</head>

<?php
$max_file_size=2*1024*1024;   //上传文件大小限制, 单位BYTE
$destination_folder="../upload/"; //上传文件路径
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
//是否存在文件
{ 
echo "<font color='red'>文件不存在！</font>";
exit;
}

$file = $_FILES["upfile"];
if($max_file_size < $file["size"])
//检查文件大小
{
echo "<font color='red'>文件太大！</font>";
exit;
  }



if(!file_exists($destination_folder))
mkdir($destination_folder);

$filename=$file["tmp_name"];
 

$pinfo=pathinfo($file["name"]);
$ftype=$pinfo[extension];
$destination = $destination_folder.$file["name"];
$destination=iconv("utf-8","gbk",$destination);
if (file_exists($destination) && $overwrite != true)
{
     echo "<font color='red'>同名文件已经存在了！</a>";
     exit;
  }

if(!move_uploaded_file ($filename, $destination))
{
   echo "<font color='red'>移动文件出错！</a>";
     exit;
  }

$pinfo=pathinfo($destination);
$fname=$pinfo[basename];
echo " <font color=red>已经成功上传</font><br>文件名: <font color=blue>".$destination_folder.$file["name"]."</font><br>";
}



?>



