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
function show(){document.getElementById("menu").style.display="block";
if(timesi==0){document.getElementById("menu").style.left=document.getElementById("menu").offsetLeft*1-60;timesi=1;}}
function hide(){document.getElementById("menu").style.display="none";}
</script>
</head>
<body>
<?php
$menuright=menuright(35);//取得菜单权限
$tit='毛猪业务 <span class="c-gray en">&gt;</span> 分割精加工';
$lur='<div class="text-c">
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="供应商选取" readonly  onclick="layer_show2(\'供应商选取\',\'Select_Gys_Md.php\',\'700\',\'600\')">
<select class="select-box" style="width:65px;height:31px;text-align:center;" name="zt"><option value="">-状态-</option><option value="1">已审</option><option value="0">未审</option></select>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="I_Shengcjg.php"  class="btn radius"> 生产加工</a>
 <a href="I_Shengcjg_a.php"  class="btn radius"> 边猪精加工</a>
 <a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 分割精加工</a>
</span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="Tis();" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; 导&nbsp;&nbsp;出</a> <a onclick="Tis();" class="btn radius"><img border=0 src=im/dy.png>&nbsp;&nbsp;打&nbsp;&nbsp;印</a> </span> ';
$cha='';
$lie=',日期,时间,供应商,品种,分割边猪数,分割边猪重,带耳头骨,碎油,板油,备注,状态,改';
$wid=',8%,4%,15%,6%,10%,10%,9%,9%,9%,12%,6%,2%';
$tis='';
$xuh=',2,3,4,5,6,7,8,9,10';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
