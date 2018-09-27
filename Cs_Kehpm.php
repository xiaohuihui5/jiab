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
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(21);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 客户品名';
$lur='<div class="text-c">
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="客户分类选取" readonly  onclick="layer_show2(\'客户分类选取\',\'select_khfenl_s.php\',\'500\',\'500\')">
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="产品选取" readonly  onclick="layer_show2(\'产品选取\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 客户品名</a> </span> ';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="javascript:update1()" class="btn radius">保存【F8】</a> <a onclick="layer_show2(\'添加客户分类品名\',\''.$xiam.'Add.php\',\'800\',\'800\')" class="btn radius"><img border=0 src=im/add.png> 添客户分类品名</a> 
<a onclick="layer_show(\'复制客户品名\',\''.$xiam.'Copy.php\',\'600\',\'500\')" class="btn radius"> 复制品名</a> ';
$lnk.='<a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a>
</span> ';
$cha='';
if($menuright>1)//录入权限
{
	$lie=',序,分类名称,客户品名编号,客户品名,客户条码,结算,换算值,单位,规格,标准品名编号,公司产品,单位,删';
	$wid=',3%,10%,8%,22%,13%,4%,4%,4%,7%,8%,9%,4%,4%';
}
else//查询权限
{
	$lie=',序,分类名称,客户品名编号,客户品名,客户条码,结算,换算值,单位,规格,标准品名编号,公司产品,单位';
	$wid=',4%,9%,9%,18%,8%,4%,4%,10%,8%,10%,12%,4%';
}
$xuh=',,3,4,5,6';
$tis='<font color=red>查询时按产品分类、产品代码排序';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language=javascript>
function update1()//提交明细保存
{ 
	window.hqlist.Frm.submit();
	//javascript:location.replace(location.href);//不跳转刷新
}
</script>