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
$menuright=menuright(9);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 供应商资料';
$lur='<div class="text-c">
<input id="gysid" name="gysid" type="hidden"><input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="供应商选取" readonly  onclick="layer_show2(\'供应商选取\',\'Select_Gys_Md.php\',\'700\',\'600\')"/>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_Gys.php"  class="btn radius"><img border=0 src=im/zhuy.png> 供应商资料</a>
<a href="Cs_GysFenl.php"  class="btn radius"> 供应商分类</a> 
</span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="layer_show2(\'新增供应商\',\''.$xiam.'Add.php\',\'700\',\'600\')" class="btn radius"><img border=0 src=im/add.png> 新增供应商</a> '; 
$lnk.='<a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a href="JavaScript:openwindow2(\'xPrint_NoCountdis.php\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
if($menuright>1)//区分权限
{
$lie=",序,分类,编号,供应商名称,联系人,电话,地址,结算,状态,改";
$wid=",4%,10%,6%,14%,8%,8%,38%,4%,4%,4%";
}
else
{
$lie=",序,分类,编号,供应商名称,联系人,电话,地址,结算,状态";
$wid=",4%,10%,6%,14%,8%,8%,42%,4%,4%";
}
$xuh=',,3,4,5,6,7,8,9,10,11';
$tis="<font color=red>点对应行的状态,可启用或禁用对应供应商,禁用后的供应商在录入和查询时不可见";
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
