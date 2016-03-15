<?php
include_once("../sql_connect.php");
mysql_query("set names utf8");

$online=$_POST['online'];
$paperid=$_POST['paperid'];

	$upsql="update `papers` set IsBegin=$online where papers_id='".$paperid."'";	
	mysql_query($upsql,$link);