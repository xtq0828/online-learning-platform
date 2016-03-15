<?php
session_start();
$lifeTime = 1200;
setcookie(session_name(), session_id(), time() + $lifeTime, "/");

include_once("../sql_connect.php");
include_once("../my_msg.php");
mysql_query("set names utf8");


if(isset($_POST['papersid'])){


	$sqlstr="select * from topic where papers_id='".$_POST['papersid']."' ";
	
	$result = mysql_query($sqlstr,$link);

	while($row=mysql_fetch_array($result))
	{
		$shitiArray[]=$row;
	}
	//定义总分
	$totalPoints=0;
	$i=1;
	//判断是添加还是修改
	$sqlistmp="select count(ST_id) as num from student_temp where user_no='".$_SESSION['user_no']."' and papers_id='".$_POST['papersid']."'";
	$resulttmp = mysql_query($sqlistmp,$link);
	$rowtmp=mysql_fetch_array($resulttmp);
	$tages='0';   //添加状态
	if($rowtmp['num']>0){
		//修改状态
		$tages='1';
	}
	
	foreach($shitiArray as $value){
		
		if($value['content_type']=='1'){
			$studentAnswer=$_POST["danxuan$i"];
			 	
		}
		elseif($value['content_type']=='2'){
			$studentAnswer= implode('', $_POST["duoxuan$i"]);
			
		}elseif($value['content_type']=='3'){
			
			$studentAnswer= $_POST["panduan$i"];
			
		}elseif($value['content_type']=='4'){
			$studentAnswer= trim($_POST["tiankong$i"]);
			
		}
		$time=time();
		
		if($tages=='0'){
		//将答案插入数据库,$_POST['papersid'],$value['topic_id']
			$sqlinsert="insert into  student_temp  (user_no,papers_id,topic_id,studentanswer,anTime) values ($_SESSION[user_no],$_POST[papersid],$value[topic_id],'$studentAnswer',$time)";
		}else{
			$sqlinsert="update student_temp valuse set studentanswer='".$studentAnswer."',anTime='".$time."' where  user_no='".$_SESSION[user_no]."' and  topic_id='".$value[topic_id]."'";
		}
		mysql_query($sqlinsert,$link);
		$i++;
	}
	echo "恭喜，保存成功";

}else{
	my_msg("请保持参数的完整性","onlineworklist.php");
}



mysql_free_result($result);
mysql_close($link);