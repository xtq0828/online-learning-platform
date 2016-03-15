<?php
    session_start();
	$lifeTime = 1200;
    setcookie(session_name(), session_id(), time() + $lifeTime, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php 
include_once("../sql_connect.php");
include_once("../my_msg.php");
mysql_query("set names utf8");

function minanswer($a, $b){
	return $a < $b ? $a : $b;
}
if(isset($_POST['papersid'])){


	$sqlstr="select * from topic where papers_id='".$_POST['papersid']."'";
	
	$result = mysql_query($sqlstr,$link);

	while($row=mysql_fetch_array($result))
	{
		$shitiArray[]=$row;
	}
	//定义总分
	$totalPoints=0;
	$i=1;
	foreach($shitiArray as $value){
		$IsYes='0';
		if($value['content_type']=='1'){
			$studentAnswer=$_POST["danxuan$i"];
			 	if($value['answer']==$_POST["danxuan$i"]){
			 		$totalPoints=$totalPoints+$value['score'];
			 		$IsYes='1';
			 	}
		}
		elseif($value['content_type']=='2'){
			$studentAnswer= implode('', $_POST["duoxuan$i"]);
			if($value['answer']==$studentAnswer){
				$totalPoints=$totalPoints+$value['score'];
				$IsYes='1';
			}
		}elseif($value['content_type']=='3'){
			
			$studentAnswer= $_POST["panduan$i"];
			if($value['answer']==$studentAnswer){
				$totalPoints=$totalPoints+$value['score'];
				$IsYes='1';
			}
		}elseif($value['content_type']=='4'){
			if(isset($_POST["mathml$i"])&&$_POST["mathml$i"]!=''){
			$studentAnswer= $_POST["mathml$i"];
			}
			else{$studentAnswer= $_POST["tiankong$i"];}
			$arr1 = str_split($studentAnswer);
			$arr2 = str_split($value['answer']);
			$sLength = strlen($studentAnswer);
			$aLength = strlen($value['answer']);
			$arr = array(array());
			for($k = 0; $k < $sLength + 1; $k++){
				$arr[$k][0] = $k;
			}
			for($k = 0; $k < $aLength + 1; $k++){
				$arr[0][$k] = $k;
			}
			for($k = 1; $k < $sLength + 1; $k++){
				for($j = 1; $j < $aLength + 1; $j++){
					$d;
					$temp = minanswer($arr[$k-1][$j] + 1, $arr[$k][$j-1] + 1);
					//echo $temp;
					if($arr1[$k-1]==$arr2[$j-1]){
						$d = 0;
					}
					else{
						$d = 1;
					}
					//echo $d;
					$arr[$k][$j]=minanswer($temp, $arr[$k-1][$j-1] + $d);
					
				}
				//echo "<br>";
			}
			//for($k = 0; $k < $aLength + 1; $k++){
				for($j = 0; $j < $sLength + 1; $j++){
					echo $arr[$k][$j];
				}
			//}
			echo "<br>";
			if($arr[$sLength][$aLength]==0){
			$totalPoints=$totalPoints+$value['score'];
			$IsYes='1';
			}
			//if($value['answer']==$studentAnswer){
				//$totalPoints=$totalPoints+$value['score'];
				//$IsYes='1';
			//}
		}
		$time=time();
		//将答案插入数据库,$_POST['papersid'],$value['topic_id']
		$sqlinsert="insert into student_answer(user_no,papers_id,topic_id,studentanswer,IsYes,score,anTime,topic_type) values ('".$_SESSION[user_no]."','".$_POST[papersid]."','".$value[topic_id]."','".$studentAnswer."','".$IsYes."','".$value[score]."','".$time."','".$value[topic_type]."')";
		mysql_query($sqlinsert,$link);
		$i++;
	}
	$sqlpapers="insert into student_papers (User_no,papers_id,score,addtime) value ($_SESSION[user_no],$_POST[papersid],$totalPoints,$time)";
	mysql_query($sqlpapers,$link);
	
	if($totalPoints>=80){
		$tishi="您的得分是".$totalPoints;
	}elseif($totalPoints>=60){
		$tishi="您的得分是".$totalPoints;
	}else{
		$tishi="您的得分是".$totalPoints;
	}
	
	my_msg($tishi,"onlineworklist.php");

}else{
	my_msg("请保持参数的完整性","onlineworklist.php");
}



mysql_free_result($result);
mysql_close($link);