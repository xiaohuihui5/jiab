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
$menuright=menuright(25);//取得菜单权限
$tit='毛猪业务 <span class="c-gray en">&gt;</span> 毛猪采购录入';
$lur='<div class="text-c">
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="gysflid" name="gysflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysflmc" name="gysflmc" value="供应商分类" readonly onclick="layer_show2(\'供应商分类选取\',\'Select_GysFl_Md.php\',\'700\',\'600\')">    
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="供应商选取" readonly  onclick="layer_show2(\'供应商选取\',\'Select_Gys_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-状态-</option><option value="1">已审</option><option value="0">未审</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 毛猪采购</a></span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="Add2();" class="btn radius"> 生成验收单</a> <a onclick="Add();" class="btn radius"><img border=0 src=im/add.png> 新增采购[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/day.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
if($menuright>0)//区分权限
{
	$lie=',序,毛猪点,单号,供应商名称,备注,采购日期,头数,场外重/斤,回场重/斤,金额,运费,总损耗,头均损耗,扣损耗/元,应付总金额,制单,状态,改,删';
	$wid=',3%,6%,7%,8%,5%,6%,5%,7%,7%,7%,5%,5%,5%,6%,7%,4%,3%,2%,2%';
}
else
{
	$lie=',序,毛猪点,单号,供应商名称,备注,采购日期,头数,场外重/斤,回场重/斤,金额,运费,总损耗,头均损耗,扣损耗/元,应付总金额,制单,状态';
	$wid=',3%,6%,7%,8%,8%,7%,5%,7%,7%,7%,5%,5%,5%,6%,7%,4%,3%';
}
$xuh=',,3,4,5,6,7,8';
$tis='点击列名可按对应列排序，点对应行空白处可弹出明细输入、修改窗口!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('新增毛猪采购单','<?php echo $xiam;?>Add.php','500','500'); //最后一个参数是给一个标识符 
} 
function Add2()
{
	layer_show2('生成毛猪验收单','<?php echo $xiam;?>Add2.php','500','500'); //最后一个参数是给一个标识符 
} 
</script>
