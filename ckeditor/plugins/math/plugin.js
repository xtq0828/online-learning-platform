function setCookie(name,value) 
{ 
    var Days = 30; 
    var exp = new Date(); 
    exp.setTime(exp.getTime() + Days*24*60*60*1000); 
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
} 
CKEDITOR.plugins.add('math',
{
 requires:['dialog','fakeobjects'],
 init:function(editor)
 {
 // 增加按钮
  editor.addCommand('math',new CKEDITOR.dialogCommand('math'));
  editor.ui.addButton('EMath',{label:"EMath",command:'math',icon:this.path+'images/math.jpg'});
  CKEDITOR.dialog.add('math',function(editor)
  {
   return{title:"math formula",minWidth:690,minHeight:230,contents:[{id:"tab1",label:"First Tab",title:"First Tab",elements:[{id:"pagetitle",width:"100%",type:"html",html:'<iframe id="math_frame" name="math_frame" src="./ckeditor/plugins/math/math.html" frameborder="0" scrolling="no" style="width:690;height:200"></iframe>'}]}],
   onOk:function()/**确定按钮:按下后将公式插入到ckeditor*/
   {  
    var mml_string="";
	var oMath;
	if(CKEDITOR.env.ie){oMath=document.math_frame._webeq_popup;}
	else{oMath=document.all.math_frame.contentDocument._webeq_popup;} 
    mml_string=oMath.getMathML();//显示当前的内容
	var mml_html=CKEDITOR.dom.element.createFromHtml(mml_string);
	var str=mml_html.getOuterHtml();
	setCookie("mathml",str);
    editor.focus();
	editor.insertHtml(mml_string);  
	//editor.insertElement(mml_html);     
   },
   onShow:function(){
    if((CKEDITOR.env.ie)){  
     document.math_frame.location.href='./ckeditor/plugins/math/math.html';   
   }else{  
     document.all.math_frame.src='./ckeditor/plugins/math/math.html';   
   }  
   }
  };
 }
);
}
}
);
