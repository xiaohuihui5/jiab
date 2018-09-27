<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" /><!--$lur显示模块-->
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<body >
<?php
$menuright=menuright(8);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 客户线路';
if($menuright>1)//录入
	$lur='<div class="text-c">编号:&nbsp;<input type="text" class="input-text" style="width:100px" id="bianh" name="bianh" onkeydown="if(event.keyCode==13){window.Frm.fenlmc.select();}else  if(event.keyCode==39){window.IFrm.fenlmc.select();}">&nbsp;客户线路:&nbsp;<input type="text" class="input-text" style="width:150px"  id="fenlmc" name="fenlmc" onkeydown="if(event.keyCode==13){sub();}">&nbsp; <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;增加&nbsp;&nbsp;" onclick="sub();">';
else
	$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_Kh.php"  class="btn radius"> 客户资料</a> 
<a href="Cs_KhLx.php"  class="btn radius"> 客户类型</a> 
<a href="Cs_KhFenl.php"  class="btn radius"> 客户分类</a> 
<a href="Cs_KhXianl.php"  class="btn radius"><img border=0 src=im/zhuy.png> 客户线路</a> 
<a href="Cs_CwFenl.php"  class="btn radius"> 财务分类</a>  
</span>';
$lnk.=' <span class="r"><a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span>&nbsp;';
$cha='';
$lie=",序,编号,客户线路,含客户数,禁用,修改";
$wid=",10%,20%,50%,10%,5%,5%";
$tis="";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script lanuage ="javascript">
function sub()
{
	if($("input[name=fenlmc]").val()=="" || $("input[name=fenlmc]").val()==null)
	{
		parent.layer.msg('新增打印分组不得为空', {icon:2,time:1500});
		return false;
	}
	else
	{
		window.Frm.submit();
		window.Frm.reset();
		window.Frm.bianh.focus();
	}
}
window.Frm.bianh.focus();
</script>
