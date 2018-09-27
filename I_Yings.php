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
$menuright=menuright(39);//取得菜单权限
$tit='财务管理 <span class="c-gray en">&gt;</span> 应收账款';
$lur='<div class="text-c"><input id="sel" name="sel" type="hidden" value="1">
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="cwflid" name="cwflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cwflmc" name="cwflmc" value="财务分类" readonly onclick="layer_show2(\'财务分类选取\',\'Select_CwFl_Md.php\',\'700\',\'600\')">  
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 销售对账</a> 
<a href="I_Yings_A.php"  class="btn radius"> 对账单收款</a> 
<a href="I_Yings_B.php"  class="btn radius"> 账套收款</a></span>';
$lnk.='<span class="r">';
if($menuright>1)//录入
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> 生成对账单</a></span>'; 
$cha='';
$lie=',序,单号,<input type=checkbox onclick="selall();" style="zoom:100%;">,客户名称,备注,日期,实收金额,审核人';
$wid=',4%,18%,3%,16%,18%,9%,18%,14%';
$xuh=',,3,,5,,7,8,9';
$tis='点击列名可按对应列排序，点对应行空白处可弹出单据明细!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script lanuage="javascript">
window.Frm.cxtj.focus();
function Add()
{
	var s_id="";
	for(var i=1;i<=window.hqlist.Frm.count.value;i++)
	{
		if(s_id=="" && document.frames['hqlist'].document.getElementById('id'+i).checked)
		{
			s_id=document.frames['hqlist'].document.getElementById('id'+i).value;
		}
		else if(document.frames['hqlist'].document.getElementById('id'+i).checked)
		{
			s_id=s_id+','+document.frames['hqlist'].document.getElementById('id'+i).value;
		}
	}
	if(s_id=="")
		layer.msg('您没有选择单据，请选择要生成对账单的销售订单!');
	else
		layer_show2('新增财务对账单','<?php echo $xiam;?>Add.php?dh_id='+s_id,'450','720'); //最后一个参数是给一个标识符 
}
function selall()
{
	if(window.Frm.sel.value==1)
	{
		for(var i=1;i<=window.hqlist.Frm.count.value;i++)
		{
			document.frames['hqlist'].document.getElementById('id'+i).checked=true;
		}
		window.Frm.sel.value=2;
	}
	else
	{
		for(var i=1;i<=window.hqlist.Frm.count.value;i++)
		{
			document.frames['hqlist'].document.getElementById('id'+i).checked=false;
		}
		window.Frm.sel.value=1;
	}
} 
</script>
