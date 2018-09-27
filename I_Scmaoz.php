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
<script language="javascript">
var timesi=0;//window.event.clientX;此处两函数用于审核弹出下拉框
function show(){document.getElementById("menu1").style.display="block";
if(timesi==0){document.getElementById("menu1").style.left=document.getElementById("menu1").offsetLeft*1-60;timesi=1;}}
function hide(){document.getElementById("menu1").style.display="none";}
</script>
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(69);//取得菜单权限
$tit='生产管理 <span class="c-gray en">&gt;</span> 生猪入库';
$lur='<div class="text-c"><input name="setsh" type="hidden" value="100">
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 生猪入库</a> <a href="'.$xiam.'_A.php"  class="btn radius"> 生猪出库</a> </span>';
$lnk.='<span class="r">';
if($menuright>2)//审核
$lnk.='<div onMouseMove="show()" onMouseOut="hide()" style="background:#01121ff" class="btn radius">批量审核▼<br>
    <div id="menu1" style="position:absolute;display:none;margin-top:6px;margin-left:20px;width:130;text-align:left;line-height:25px;background-color:#ffffff;border:1px solid #3980AF">
     <a href="javascript:s_all(1)"><font color=blue>·列表单都审核通过</a><br>
     <a href="javascript:s_all(0)"><font color=blue>·列表单审核不过</a>
    </div></div> ';
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> 新增入库单[F9]</a> </span>'; 
$cha='';
$lie=',序,单号,入库日期,头数,入库总量(斤),总金额,制单人,状态,修改,删除';
$wid=',9%,10%,10%,10%,18%,18%,10%,5%,5%,5%';
$tis='点击列名可按对应列排序，点对应行空白处可弹出明细输入、修改窗口!';
$xuh=',,3,4,5,6';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
window.Frm.cxtj.focus();
function Add()
{
	layer_show2('新增入库单','<?php echo $xiam;?>Add.php','500','300'); //最后一个参数是给一个标识符 
} 
</script>
