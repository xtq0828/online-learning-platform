<?php
error_reporting(0);
$link = mysql_connect('localhost','root','') or 
die ("Could not connect: " . mysql_error());

mysql_select_db("lisan1") or die ("Could not select database");
?>