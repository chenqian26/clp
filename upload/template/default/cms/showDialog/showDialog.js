
var isIe=(document.all)?true:false;

//设置select的可见状态
function setSelectState(state)
{
var objl=document.getElementsByTagName('select');
for(var i=0;i<objl.length;i++)
{
objl[i].style.visibility=state;
}
}

function mousePosition(ev)
{
if(ev.pageX || ev.pageY)
{
return {x:ev.pageX, y:ev.pageY};
}
return {
x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,y:ev.clientY + document.body.scrollTop - document.body.clientTop
};
}

//弹出方法
function showMessageBox(wTitle,content,x,y,wWidth)
{
closeWindow();
var bWidth=parseInt(document.documentElement.scrollWidth);
var bHeight=parseInt(document.documentElement.scrollHeight);
if(isIe){
setSelectState('hidden');}
var back=document.createElement("div");
back.id="back";
var styleStr="top:0px;left:0px;position:absolute;background:#666;width:"+bWidth+"px;height:"+bHeight+"px;";
styleStr+=(isIe)?"filter:alpha(opacity=0);":"opacity:0;";
back.style.cssText=styleStr;
document.body.appendChild(back);
showBackground(back,50);
var mesW=document.createElement("div");
mesW.id="mesWindow";
mesW.className="mesWindow";
mesW.innerHTML="<div class='mesWindowTop'><table width='100%' height='100%'><tr><td>"+wTitle+"</td><td style='width:1px;'><input type='button' onclick='closeWindow();' title='关闭窗口' class='close' value='关闭' /></td></tr></table></div><div class='mesWindowContent' id='mesWindowContent'>"+content+"</div><div class='mesWindowBottom'></div>";
styleStr="left:"+(((x-wWidth)>0)?(x-wWidth/2):x)+"px;top:"+(y)+"px;position:absolute;width:"+wWidth+"px;";
mesW.style.cssText=styleStr;
document.body.appendChild(mesW);
}

//让背景渐渐变暗
function showBackground(obj,endInt)
{
if(isIe)
{
obj.filters.alpha.opacity+=1;
if(obj.filters.alpha.opacity<endInt)
{
setTimeout(function(){showBackground(obj,endInt)},5);
}
}else{
var al=parseFloat(obj.style.opacity);al+=0.01;
obj.style.opacity=al;
if(al<(endInt/100))
{setTimeout(function(){showBackground(obj,endInt)},5);}
}
}

//关闭窗口
function closeWindow()
{
if(document.getElementById('back')!=null)
{
document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
}
if(document.getElementById('mesWindow')!=null)
{
document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
}
if(isIe){
setSelectState('');}
}

//弹出main
function MessageBox(ev,title,text,type)
{

//var objPos = mousePosition(ev);
var x=$(window).width()/2;
var y=$(window).height()/2;

if(type==0)
{
  messContent="<div style='padding:10px 0 10px 0;text-align:center'>";
  //messContent+="<p>"+text+"</p>"
  var winner_list = eval('(' + text + ')');
  for(var reward in winner_list)
  { 
    messContent+="<table cellpadding='5' cellspacing='10'><caption>"+reward+"</caption>";
    for (group_list in winner_list[reward])
    {
      messContent+="<tr><td>"+group_list+":</td>";
      for (p_list in winner_list[reward][group_list])
      {
        messContent+="<td>"+winner_list[reward][group_list][p_list]+"</td>";
      }
      messContent+="</tr>";
    }
  }

  messContent+="</div>";
}
else if(type==1)
{
  messContent="<div style='padding:20px 0 20px 0;text-align:center'><ul>";
  for (var i=0;i<text.length;i++)
  {
    messContent+="<li><a href='timeline.php?mod=join&fid="+text[i]['fid']+"&pid="+text[i]['join_pid']+"'>"+text[i]['name']+"</a></li>";
  }
  messContent+="</ul></div>";
}

else if(type==2)
{	
	messContent="<div padding:20px 0 20px 0;text-align:center'>";
	messContent+="<form action='cms.php?mod=post&action=new_project' method='post'>";
	messContent+="<p>项目名称: <input type='text' name='name' /></p>";
	messContent+="<p>项目状态: <input type='text' name='sname' /></p>";
	messContent+="<p>项目类型: <input type='text' name='sname' /></p>";
	messContent+="<p>项目人数要求: <input type='text' name='sname' /></p>";
	messContent+="<input type='submit' value='确认' /></form>";
	messContent+="</div>";

}

//<table cellpadding="10" cellspacing="20"><tr><td>test1</td><td>test2</td></tr></table>
showMessageBox(title,messContent,x,y,500);	
}

function new_project()
{
	var x=$(window).width()/2;
	var y=$(window).height()/2;

	messContent="<div padding:20px 0 20px 0;text-align:center'>";
	messContent+="<form action='cms.php?mod=post&action=new_project' method='post'>";
	messContent+="<p>项目名称: <input type='text' name='name' /></p>";
	messContent+="<p>项目状态: <input type='text' name='status' /></p>";
	messContent+="<p>项目类型: <input type='text' name='type' /></p>";
	messContent+="<p>项目人数要求: <input type='text' name='limit_people' /></p>";
	messContent+="<input type='submit' value='确认' /></form>";
	messContent+="</div>";
	showMessageBox('新增项目',messContent,x,y,500);	
}

function update_project(ev)
{
	var x=$(window).width()/2;
	var y=$(window).height()/2;
	var update_id = $(ev).parents().attr('id');
	var type='dianshe';
	var name='';
	var status='';
	var limit_people='';
	var qualification_list ='';
	var competition_list ='';
	var winner_list ='';

	$.ajax({url:"cms.php?mod=ajax&action=select",  type: "POST",  data:{update_id:update_id},async:false , dataType:"json",
            success:function(jsonList){
            	//alert(jsonList[0]['name']);

	type = jsonList[0]['type'];
	name = jsonList[0]['name'];
	status = jsonList[0]['status'];
	limit_people = jsonList[0]['limit_people'];
	qualification_list = jsonList[0]['qualification_list'];
	competition_list = jsonList[0]['competition_list'];
	winner_list= jsonList[0]['winner_list'];
            }
        });



	messContent="<div padding:20px 0 20px 0;text-align:center'>";
	messContent+="<form action='cms.php?mod=ajax&action=update_project' method='post'>";
	messContent+="<p>项目名称: <input style='width:400px;' type='text' name='name' value="+name+" /></p>";
	messContent+="<p>项目状态: <input type='text' name='status' value="+status+" /></p>";
	messContent+="<p>项目类型: <input type='text' name='type' value="+type+" /></p>";
	messContent+="<p>项目人数要求: <input type='text' name='limit_people' value='"+limit_people+"' /></p>";
  messContent+="<p><input type='hidden' name='id' value='"+update_id+"' /></p>";
	messContent+="<input type='submit' value='确认' /></form>";
	messContent+="</div>";
	showMessageBox('修改项目',messContent,x,y,500);	
}

function delete_confirm(ev)
{
	var x=$(window).width()/2;
	var y=$(window).height()/2;
	var name = $(ev).parents().parents().attr('id');
	var delete_id = $(ev).parents().attr('id');
	messContent="<div padding:20px 0 20px 0;text-align:center'>";
	messContent+="<p>你确定删除<strong>"+name+"</strong>，一经删除无法恢复</p>";
	messContent+="<input id="+delete_id+" type='button' value='确认' onclick='delete_ajax(this)'/>";
	messContent+="<input type='button' value='取消' onclick='closeWindow()'/>";
	messContent+="</div>";
	showMessageBox('删除确认',messContent,x,y,500);	

}
function delete_ajax(ev)
{
	
	var delete_id = $(ev).attr('id');
	
	$.ajax({url:"cms.php?mod=ajax&action=delete",  type: "POST",  data:{delete_id:delete_id},async:false , dataType:"text",
            success:function(data,status){
            	closeWindow()
            	location.reload() 
            }
        });

}

function change_project()
{
var obj=document.getElementById('change_project');
var index=obj.selectedIndex; //序号，取当前选中选项的序号
var val = obj.options[index].text;
window.location.href="cms.php?mod=member_profile&index="+index;
/*
$.ajax({
   url:'cms.php?mod=member_profile&index='+index,
   type:"POST",
   cache : false,
   dataType : "json",
   success:function(data) {
        alert("请求成功");
   }
  });
alert(index);
*/
}
