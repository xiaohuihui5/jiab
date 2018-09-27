<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
</head>
<body >
<?php
$menuright=menuright(7);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 生产分类';
if($menuright>1)//录入
	$lur='<div class="text-c">编号:&nbsp;<input type="text" class="input-text" style="width:80px" id="bianh" name="bianh" onkeydown="if(event.keyCode==13){window.Frm.fenlmc.select();}else  if(event.keyCode==39){window.IFrm.fenlmc.select();}">&nbsp;分类名称:&nbsp;<input type="text" class="input-text" style="width:150px"  id="fenlmc" name="fenlmc" onkeydown="if(event.keyCode==13)window.Frm.bil.select();">&nbsp;分割比例:&nbsp;<input type="text" class="input-text" style="width:80px"  id="bil" name="bil" onkeydown="if(event.keyCode==13) sub();">&nbsp; <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;增加&nbsp;&nbsp;" onclick="sub();">';
else
	$lur='<div class="text-c"><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:250px" placeholder="输入关键字模糊搜索" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_Cp.php"  class="btn radius"> 产品资料</a> 
<a href="Cs_CpFenl.php"  class="btn radius"> 一级分类</a> 
<a href="Cs_CpDafl.php"  class="btn radius"> 二级分类</a> 
<a href="Cs_CpSw.php"  class="btn radius"><img border=0 src=im/zhuy.png> 生产分类</a> 
<a href="Cs_Cpxis.php"  class="btn radius">加工系数</a>  </span> <span class="r"><a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=",序,编号,分类名称,分割比例(%),禁用,修改";
$wid=",10%,20%,40%,10%,10%,10%";
$tis="!";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
<script lanuage ="javascript">
function sub()
{
	if($("input[name=fenlmc]").val()=="" || $("input[name=fenlmc]").val()==null)
	{
		parent.layer.msg('新增生产分类名称不得为空', {icon:2,time:1500});
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
