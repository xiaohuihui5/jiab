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
$menuright=menuright(16);//取得菜单权限
$tit='销售管理 <span class="c-gray en">&gt;</span> 销售退货录入';
$lur='<div class="text-c">
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>

<input id="khflid" name="khflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="客户分类" readonly onclick="layer_show2(\'客户分类选取\',\'Select_KhFl_Md.php\',\'700\',\'600\')">  
<input id="khjgid" name="khxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="客户线路" readonly onclick="layer_show2(\'客户线路选取\',\'Select_KhXl_Md.php\',\'700\',\'600\')">  
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="客户选取" readonly  onclick="layer_show2(\'客户选取\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-状态-</option><option value="1">已审</option><option value="0,9">未审</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 订单管理</a> <a href="javascript:openwindow2(\''.$xiam.'_No.php\',500,680)" class="btn radius"> 未下单客户</a></span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> 新退货单[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
if($menuright>1)//区分权限
{
	$lie=',序,单号,客户名称,备注,退货日期,退货量,退货金额,制单人,状态,改,删';
	$wid=',4%,10%,16%,24%,10%,10%,10%,6%,4%,3%,3%';
}
else
{
	$lie=',序,单号,客户名称,备注,退货日期,退货量,退货金额,制单人,状态';
	$wid=',4%,10%,16%,24%,10%,10%,10%,9%,7%';
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
	layer_show2('新增销售退货单','<?php echo $xiam;?>Add.php','500','500'); //最后一个参数是给一个标识符 
} 
</script>
