<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<html>
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
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<script language="javascript">
var timesi=0;//window.event.clientX;此处两函数用于审核弹出下拉框
function show(){document.getElementById("menu1").style.display="block";
if(timesi==0){document.getElementById("menu1").style.left=document.getElementById("menu1").offsetLeft*1-60;timesi=1;}}
function hide(){document.getElementById("menu1").style.display="none";}
</script>
</head>
<body>
<?php
$menuright=menuright(25);//取得菜单权限
$tit='毛猪业务 <span class="c-gray en">&gt;</span> 毛猪采购';
$lur='<div class="text-c"><input name="setsh" type="hidden" value="100">
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT1'].'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT2'].'"/>
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="供应商选取" readonly  onclick="layer_show2(\'供应商选取\',\'Select_Gys_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-状态-</option><option value="1">已审</option><option value="0">未审</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 毛猪采购</a></span>';
$lnk.='<span class="r">';
if($menuright>2)//审核
$lnk.='<div onMouseMove="show()" onMouseOut="hide()" style="background:#01121ff" class="btn radius">批量审核▼<br>
    <div id="menu1" style="position:absolute;display:none;margin-top:6px;margin-left:20px;width:130;text-align:left;line-height:25px;background-color:#ffffff;border:1px solid #3980AF">
     <a href="javascript:s_all(1)"><font color=blue>·列表单都审核通过</a><br>
     <a href="javascript:s_all(0)"><font color=blue>·列表单审核不过</a>
    </div></div> <a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> 新增采购单[F9]</a> '; 
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
if($menuright>2)
{
$lie=',日期,供应商,品种,头数,出场重,到场重,出场价,到场价,运杂费,应付猪款,路损(斤/头),车牌号/备注,制单人,状态,打印,改,删';
$wid=',7%,6%,5%,5%,7%,7%,6%,6%,7%,7%,7%,13%,5%,4%,4%,2%,2%';
}
else
{
$lie=',日期,供应商,品种,头数,出场重,到场重,出场价,到场价,运杂费,应付猪款,路损(斤/头),车牌号/备注,制单人,状态,打印,改,删';
$wid=',7%,6%,5%,5%,7%,7%,6%,6%,7%,7%,7%,13%,5%,4%,4%,2%,2%';
}
$tis='';
$xuh=',,3,4,5,6,7,8,9,10,11,12,13';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
<script language ="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('新增毛猪采购单','<?php echo $xiam;?>Add.php','450','720'); //最后一个参数是给一个标识符 
} 
</script>
