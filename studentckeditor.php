<html>
<head>
<title>Sample CKEditor Site</title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script>
var editor = null;
window.onload = function(){
editor = CKEDITOR.replace('editor1'); //参数'editor1'是textarea元素的name属性值，而非id属性值	
}
function getCookie(name) 
{ 
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg))
 
        return unescape(arr[2]); 
    else 
        return null; 
} 
function insert(){
editor.updateElement();
window.opener.document.getElementById('<?php echo $_GET['id'] ?>').innerHTML=document.getElementById('editor1').value;
//alert(document.cookie);  
window.opener.document.getElementById('<?php echo $_GET['count'] ?>').innerHTML=getCookie("mathml");
window.close();
}
</script>
</head>
<body>
My Editor:<br/>
<textarea id="editor1" name="editor1"></textarea>
<input type="submit" onClick="insert()"/>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
</html>