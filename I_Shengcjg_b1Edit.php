<?php 
include("./inc/xhead.php");
//取得生产加工数据信息
$query="select CONVERT(varchar(10),jg.jiagrq,120),jg.unit,jg.fengs,jg.fengz,jg.daietg,jg.bany,jg.suiy,jg.fgbz,jg.fgzt,jg.fgbianzs,jg.fgbianzz from sys_jiagsc jg where jg.id=".$_REQUEST['id'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$jgrq=$line[0];
$unit=$line[1];
$fengs=$line[2];
$fengz=$line[3];
$daietg=$line[4];
$bany=$line[5];
$suiy=$line[6];
$fgbz=$line[7];
$fgzt=$line[8];
$sl1=$line[9];
$zl1=$line[10];
sqlsrv_free_stmt($result);
//取得生产加工数据信息
if(isset($_POST['daietg']))
{
	$query="update sys_jiagsc set fgbianzs=".$_POST['sl1'].",fgbianzz=".$_POST['zl1'].",daietg=".$_POST['daietg'].",suiy=".$_POST['suiy'].",bany=".$_POST['bany'].",fgbz='".$_POST['bz']."',fgzt=0 where id=".$_REQUEST['id'];
	$query=str_replace(",,",",0,",$query);
	$query=str_replace(",,",",0,",$query);
	include("./inc/xexec.php");
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:398;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
</head>
<BODY>
<form name="Frm" method="POST" action="">
<table width="95%">
<tr>
	<td width="35%" align=right height="40">加工日期：<input type="hidden" value="<?php echo $fgzt;?>" name="fgzt"></td>
	<td><input class="input-text" name="dt1" id="dt1" type="text" value="<?php echo $jgrq;?>" readonly style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">供应商：</td>
	<td><input class="input-text" name="unit" id="unit" type="text" value="<?php echo $unit;?>" readonly style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">分割边猪数：</td>
	<td><input class="input-text" name="sl" value="<?php echo $fengs;?>" readonly onkeydown="if(event.keyCode==13)window.Frm.zl.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">分割边猪重：</td>
	<td><input class="input-text" name="zl" value="<?php echo $fengz;?>" readonly onkeydown="if(event.keyCode==13)window.Frm.sl1.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>车间边猪数：</td>
	<td><input class="input-text" name="sl1" id="sl1" value="<?php echo $sl1;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zl1.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>车间边猪重：</td>
	<td><input class="input-text" name="zl1" id="zl1" value="<?php echo $zl1;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.daietg.focus();else if(event.keyCode==38)window.Frm.sl1.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>带耳头骨：</td>
	<td><input class="input-text" name="daietg" id="daietg" value="<?php echo $daietg;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bany.focus();else if(event.keyCode==38)window.Frm.zl1.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>板油：</td>
	<td><input class="input-text" name="bany" value="<?php echo $bany;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.suiy.focus();else if(event.keyCode==38)window.Frm.daietg.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>碎油：</td>
	<td><input class="input-text" name="suiy" value="<?php echo $suiy;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bz.focus();else if(event.keyCode==38)window.Frm.bany.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">备&nbsp;&nbsp;&nbsp;&nbsp;注：</td>
	<td><input class="input-text" name="bz" value="<?php echo $fgbz;?>" onkeydown="if(event.keyCode==13)sub();else if(event.keyCode==38)window.Frm.suiy.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.Frm.fgzt.value==1)
		layer.msg('此分割数据已经审核，不能再操作！',{shade:false})
	else
	{
	if(window.Frm.sl1.value=="")
		layer.msg('车间边猪数不能为空！',{shade:false});
	else if(window.Frm.zl1.value=="")
		layer.msg('车间边猪重不能为空！',{shade:false});
	else if(window.Frm.daietg.value=="")
		layer.msg('带耳头骨不能为空！',{shade:false});
	else if(window.Frm.bany.value=="")
		layer.msg('板油不能为空！',{shade:false});
	else if(window.Frm.suiy.value=="")
		layer.msg('碎油不能为空！',{shade:false});
	else
		window.Frm.submit();
	}
}
function exit()
{
	parent.layer.closeAll();
}
var tt=document.getElementById('sl1');
if(tt){document.getElementById('sl1').select();document.getElementById('sl1').focus();}
</script>


