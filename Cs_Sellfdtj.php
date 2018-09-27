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
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Add();}}</script>
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(20);//取得菜单权限
$tit='基础资料 <span class="c-gray en">&gt;</span> 设置销售价格';
$lur='<div class="text-c"><input id="khflid" name="khflid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="客户分类" readonly  onclick="layer_show2(\'客户分类选取\',\'Select_KhFl_Md.php\',\'700\',\'600\')"/><input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="Cs_Sellfljg.php"  class="btn radius"> 按分类设价</a> <a href="Cs_Sellfdjg.php"  class="btn radius"> 按客户设价</a> <a href="Cs_Sellfdtj.php"  class="btn radius"><img border=0 src=im/zhuy.png> 按客户特价</a></span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> 新增价格表[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
if($menuright>1)//区分权限
{
	$lie=",序,单号,制单日期,客户名称,作用起日,结束日期,制单,备注,复,改,删";
	$wid=",4%,11%,10%,20%,10%,10%,6%,16%,5%,4%,4%";
}
else
{
	$lie=",序,单号,制单日期,客户名称,作用起日,结束日期,制单人,备注";
	$wid=",4%,15%,10%,21%,15%,15%,10%,10%";
}
$xuh=',,3,4,5,6,7,8';
$tis="<font color=red>销售录入时系统按客户特价、客户价格、分类价格先后顺序匹配价格.";
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('新增客户报价表','<?php echo $xiam;?>Add.php','500','500'); //最后一个参数是给一个标识符 
} 
</script>
