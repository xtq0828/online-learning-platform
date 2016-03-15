<?php session_start();  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/alixixi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../rili/calendar.css" media="screen"> 
<link rel="StyleSheet" href="../css/dtree.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
</head>
<?php
include_once("../sql_connect.php");
include_once("../my_msg.php");
mysql_query("set names utf8");
echo $_COOKIE['mathml'];
if(isset($_POST['sub1'])){
	
	if(isset($_POST['papers_title'])){
	
		$paperstime=strtotime($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
		$sqlstr="insert into papers (papers_title,papers_userid,papers_time,IsBegin)  values ('".strip_tags($_POST['papers_title'])."'  , '".$_SESSION['user_no']."' ,'".$paperstime."' ,'1')";
	
		$result = mysql_query($sqlstr,$link);
	
		if($result){
			$_SESSION['papers _id']=mysql_insert_id();
			my_msg('添加成功','newwork.php');
		}else{
			my_msg('添加失败，请重新添加','newwork.php');
		}}else{
			
			echo "数据错误，请点击返回";
			echo "<br/>";
			echo "<a href='newwork.php'>返回</a>";
		}
	
}elseif(isset($_POST['sub2'])){
	
			if(isset($_POST['danxuandaan'])&&$_POST['danxuandaan']!=''){
			
				/**
					$content_type='1';
					$danxuntimu= $_POST['danxuantimu'];
					$danxuana   = $_POST['danxuana'];
					$danxuanb   = $_POST['danxuanb'];
					$danxuanc   = $_POST['danxuanc'];
					$danxuand   = $_POST['danxuand'];
					$danxuandaan=$_POST['danxuandaan']; **/
				if(isset($_POST['papersid'])||isset($_SESSION['papers _id'])){
					$papersid= isset($_POST['papersid'])? $_POST['papersid']:$_SESSION['papers _id'];
				}
				if(isset($_POST['topic_id'])){
					$sqlstr="update topic set content='".$_POST['danxuantimu']."',A='".$_POST['danxuana']."',B='".$_POST['danxuanb']."',C='".$_POST['danxuanc']."',D='".$_POST['danxuand']."',answer='".$_POST['danxuandaan']."',score='".$_POST['danxuanfen']."',type='".$_POST['type']."' WHERE topic_id='".$_POST['topic_id']."'";
					
					mysql_query($sqlstr,$link);
					my_msg('单选操作成功',"newwork.php?tid=".$_POST['topic_id']);
					exit;
					
				}else{
					$sqlstr="insert into topic (papers_id,content,content_type,A,B,C,D,answer,score,topic_type)  values ('".$papersid."'  , '".strip_tags($_POST['danxuantimu'])."' ,'1','".$_POST['danxuana']."','".$_POST['danxuanb']."','".$_POST['danxuanc']."','".$_POST['danxuand']."','".$_POST['danxuandaan']."','".$_POST['danxuanfen']."','".$_POST['type']."')";
				}
				$result = mysql_query($sqlstr,$link);
				
				if($result){
					if(isset($_POST['url'])){
						my_msg('单选添加成功','newwork.php?'.$_POST['url']);
					}
					$_SESSION['topic_number']=isset($_SESSION['topic_number'])?$_SESSION['topic_number']+1:2;
					my_msg('单选添加成功','newwork.php');
				}else{
					my_msg('添加失败，请重新添加','newwork.php');
				}
			
			}else{
			
			echo "数据错误，请点击返回";
			echo "<br/>";
			echo "<a href='newwork.php'>返回</a>";
		}
	
	}elseif(isset($_POST['sub3'])){
		if(isset($_POST['duoxuandaan'])&&count($_POST['duoxuandaan'])!=0){
		$duoxuandaan=implode('' , $_POST['duoxuandaan']);
		if(isset($_POST['papersid'])||isset($_SESSION['papers _id'])){
			$papersid= isset($_POST['papersid'])? $_POST['papersid']:$_SESSION['papers _id'];
		}
		if(isset($_POST['topic_id'])){
			$sqlstr="update topic set content='".$_POST['duoxuantimu']."',A='".$_POST['duoxuana']."',B='".$_POST['duoxuanb']."',C='".$_POST['duoxuanc']."',D='".$_POST['duoxuand']."',answer='".$duoxuandaan."',score='".$_POST['duoxuanfen']."',type='".$_POST['type']."' WHERE topic_id='".$_POST['topic_id']."'";
			
			mysql_query($sqlstr,$link);
			my_msg('多选操作成功',"newwork.php?tid=".$_POST['topic_id']);
			exit;
		}else{
			$sqlstr="insert into topic (papers_id,content,content_type,A,B,C,D,answer,score,topic_type) values ('".$papersid."'  , '".$_POST['duoxuantimu']."' ,'2','".$_POST['duoxuana']."','".$_POST['duoxuanb']."','".$_POST['duoxuanc']."','".$_POST['duoxuand']."','".$duoxuandaan."','".$_POST['duoxuanfen']."','".$_POST['type']."')";
			
		}
		$result = mysql_query($sqlstr,$link);
		if($result){
			if(isset($_POST['url'])){
				my_msg('多选添加成功','newwork.php?'.$_POST['url']);
			}
			$_SESSION['topic_number']=isset($_SESSION['topic_number'])?$_SESSION['topic_number']+1:2;
			my_msg('多选操作成功','newwork.php');
		}else{
			my_msg('操作失败，请重新添加','newwork.php');
		}}else{
			
			echo "数据错误，请点击返回";
			echo "<br/>";
			echo "<a href='newwork.php'>返回</a>";
		}
	
	}elseif(isset($_POST['sub4'])){
		if(isset($_POST['panduandaan'])&&$_POST['panduandaan']!=''){
			if(isset($_POST['papersid'])||isset($_SESSION['papers _id'])){
				$papersid= isset($_POST['papersid'])? $_POST['papersid']:$_SESSION['papers _id'];
			}
			if(isset($_POST['topic_id'])){
				$sqlstr="update topic set content='".$_POST['panduantimu']."',answer='".$_POST['panduandaan']."',score='".$_POST['panduanfen']."',type='".$_POST['type']."' WHERE topic_id='".$_POST['topic_id']."'";
				mysql_query($sqlstr,$link);
				my_msg('判断操作成功',"newwork.php?tid=".$_POST['topic_id']);
				exit;
			}else{
					$sqlstr="insert into topic (papers_id,content,content_type,answer,score,topic_type) values ('".$papersid."'  , '".$_POST['panduantimu']."' ,'3','".$_POST['panduandaan']."','".$_POST['panduanfen']."','".$_POST['type']."')";
			}
			$result = mysql_query($sqlstr,$link);
			if($result){
				if(isset($_POST['url'])){
					my_msg('判断添加成功','newwork.php?'.$_POST['url']);
				}
				$_SESSION['topic_number']=isset($_SESSION['topic_number'])?$_SESSION['topic_number']+1:2;
				my_msg('判断题添加成功','newwork.php');
			}else{
				my_msg('添加失败，请重新添加','newwork.php');
			}}else{
			
			echo "数据错误，请点击返回";
			echo "<br/>";
			echo "<a href='newwork.php'>返回</a>";
		}
		
	}elseif(isset($_POST['sub5'])){
		if(isset($_POST['mathml'])&&$_POST['mathml']!=''){
			if(isset($_POST['papersid'])||isset($_SESSION['papers _id'])){
				$papersid= isset($_POST['papersid'])? $_POST['papersid']:$_SESSION['papers _id'];
			}
			if(isset($_POST['topic_id'])){
				$sqlstr="update topic set content='".$_POST['tiankongtimu']."',answer='".$_POST['mathml']."',score='".$_POST['tiankongfen']."',type='".$_POST['type']."' WHERE topic_id='".$_POST['topic_id']."' ";
				mysql_query($sqlstr,$link);
				my_msg('填空操作成功',"newwork.php?tid=".$_POST['topic_id']);
				exit;
			}else{
				$sqlstr="insert into topic (papers_id,content,content_type,answer,score,topic_type) values ('".$papersid."'  , '".$_POST['tiankongtimu']."' ,'4','".$_POST['mathml']."','".$_POST['tiankongfen']."','".$_POST['type']."')";
			}
			$result = mysql_query($sqlstr,$link);
			if($result){
				if(isset($_POST['url'])){
				my_msg('填空添加成功','newwork.php?'.$_POST['url']);
			}
			$_SESSION['topic_number']=isset($_SESSION['topic_number'])?$_SESSION['topic_number']+1:2;
			my_msg('填空题添加成功','newwork.php');
			}else{
				my_msg('添加失败，请重新添加','newwork.php');
			}
		}
		else if(isset($_POST['tiankongdaan'])&&$_POST['tiankongdaan']!=''){
			if(isset($_POST['papersid'])||isset($_SESSION['papers _id'])){
				$papersid= isset($_POST['papersid'])? $_POST['papersid']:$_SESSION['papers _id'];
			}
			if(isset($_POST['topic_id'])){
				$sqlstr="update topic set content='".$_POST['tiankongtimu']."',answer='".$_POST['tiankongdaan']."',score='".$_POST['tiankongfen']."',type='".$_POST['type']."' WHERE topic_id='".$_POST['topic_id']."' ";
				mysql_query($sqlstr,$link);
				my_msg('填空操作成功',"newwork.php?tid=".$_POST['topic_id']);
				exit;
				}else{
					$sqlstr="insert into topic (papers_id,content,content_type,answer,score,topic_type) values ('".$papersid."'  , '".$_POST['tiankongtimu']."' ,'4','".$_POST['tiankongdaan']."','".$_POST['tiankongfen']."','".$_POST['type']."')";
				}
				$result = mysql_query($sqlstr,$link);
				if($result){
					if(isset($_POST['url'])){
					my_msg('填空添加成功','newwork.php?'.$_POST['url']);
				}
				$_SESSION['topic_number']=isset($_SESSION['topic_number'])?$_SESSION['topic_number']+1:2;
				my_msg('填空题添加成功','newwork.php');
				}else{
				my_msg('添加失败，请重新添加','newwork.php');
				}
			}else{
				echo "数据错误，请点击返回";
			    echo "<br/>";
			    echo "<a href='newwork.php'>返回</a>";
			}
		}
	

?>
