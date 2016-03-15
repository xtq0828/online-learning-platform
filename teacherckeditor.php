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
window.opener.document.getElementById('mathml').innerHTML=getCookie("mathml");
window.close();
}
</script>
</head>
<body>
My Editor:<br/>
<textarea id="editor1" name="editor1"></textarea>
<input type="submit" onClick="insert()"/>
</body>
</html>