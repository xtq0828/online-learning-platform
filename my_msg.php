<?php
Function my_header($redirect){
	echo "<script language=\"javascript\">"; 
	echo "location.href='".$redirect."'"; 
	echo "</script>"; 
	return;
	}

Function my_msg($msg,$redirect){
	echo "<SCRIPT Language=javascript>";
	echo "window.alert('".$msg."')"; 
	echo "</SCRIPT>";
	echo "<script language=\"javascript\">"; 
	echo "location.href='".$redirect."'"; 
	echo "</script>"; 
	return;
}
Function my_msg2($msg){
	echo "<SCRIPT Language=javascript>";
	echo "window.alert('".$msg."')"; 
	echo "</SCRIPT>";
	return;
}
?>
