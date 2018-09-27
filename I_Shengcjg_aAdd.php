<?php 
include("./inc/xhead.php");
//取得生产加工数据信息
$query="select CONVERT(varchar(10),jg.jiagrq,120),jg.unit,jg.bianzs,jg.bianzz,jg.zhuangt from sys_jiagsc jg where jg.lx=1 and jg.id=".$_REQUEST['id'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$jgrq=$line[0];
$unit=$line[1];
$bianzs=$line[2];
$bianzz=$line[3];
$zt=$line[4];
sqlsrv_free_stmt($result);

$query="select bz.zhut,bz.zhuj,bz.bany,bz.suiy,bz.sl,bz.zl,bz.bz from sys_bzjiag bz where bz.lx=1 and bz.jiagscid=".$_REQUEST['id'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$zhut=$line[0];
$zhuj=$line[1];
$bany=$line[2];
$suiy=$line[3];
$sl=$line[4];
$zl=$line[5];
$bz=$line[6];
sqlsrv_free_stmt($result);
//取得生产加工数据信息
if(isset($_POST['sl']))
{
	$query="if exists (select id from sys_bzjiag where jiagscid=".$_REQUEST['id'].")
update sys_bzjiag set sl=".$_POST['sl'].",zl=".$_POST['zl'].",zhut=".$_POST['zhut'].",zhuj=".$_POST['zhuj'].",bany=".$_POST['bany'].",suiy=".$_POST['suiy'].",bz='".$_POST['bz']."' where jiagscid=".$_REQUEST['id']." else
insert into sys_bzjiag(jiagscid,sl,zl,zhut,zhuj,bany,suiy,zhuangt,bz,lx) values (".$_REQUEST['id'].",".$_POST['sl'].",".$_POST['zl'].",".$_POST['zhut'].",".$_POST['zhuj'].",".$_POST['bany'].",".$_POST['suiy'].",0,'".$_POST['bz']."',1)";
	$query=str_replace("=,","=0,",$query);
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
	<td width="35%" align=right height="40">加工日期：<input class="input-text" type="hidden" value="<?php echo $zt;?>" name="zt"></td>
	<td><input class="input-text" name="dt1" id="dt1" type="text" value="<?php echo $jgrq;?>" readonly style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">供应商：</td>
	<td><input class="input-text" name="unit" id="unit" type="text" value="<?php echo $unit;?>" readonly style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">边猪数：</td>
	<td><input class="input-text" name="bianzs" value="<?php echo $bianzs;?>" readonly onkeydown="if(event.keyCode==13)window.Frm.bianzz.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">边猪重：</td>
	<td><input class="input-text" name="bianzz" value="<?php echo $bianzz;?>" readonly onkeydown="if(event.keyCode==13)window.Frm.sl.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>加工后边猪数：</td>
	<td><input class="input-text" name="sl" value="<?php echo $sl==''?$bianzs:$sl;?>" onkeydown="if(event.keyCode==13)window.Frm.zl.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>加工后边猪重：</td>
	<td><input class="input-text" name="zl" value="<?php echo $zl;?>" onkeydown="if(event.keyCode==13)window.Frm.zhut.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>猪头：</td>
	<td><input class="input-text" name="zhut" value="<?php echo $zhut;?>" onkeydown="if(event.keyCode==13)window.Frm.zhuj.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>猪脚：</td>
	<td><input class="input-text" name="zhuj" value="<?php echo $zhuj;?>" onkeydown="if(event.keyCode==13)window.Frm.bany.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>板油：</td>
	<td><input class="input-text" name="bany" value="<?php echo $bany;?>" onkeydown="if(event.keyCode==13)window.Frm.suiy.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>碎油：</td>
	<td><input class="input-text" name="suiy" value="<?php echo $suiy;?>" onkeydown="if(event.keyCode==13)window.Frm.bz.focus();" style="width:210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">备&nbsp;&nbsp;&nbsp;&nbsp;注：</td>
	<td><input class="input-text" name="bz" value="<?php echo $bz;?>" onkeydown="if(event.keyCode==13)sub()" style="width:210px;" onfocus="this.select();"></td>
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
	if(window.Frm.zt.value==1)
		layer.msg('此边猪精加工数据已经审核，不能执行此操作！',{shade:false});
	else
	{
	if(window.Frm.sl.value=="")
		layer.msg('加工边猪数不能为空！',{shade:false});
	else if(window.Frm.zl.value=="")
		layer.msg('加工边猪重不能为空！',{shade:false});
	else if(window.Frm.zhut.value=="")
		layer.msg('猪头不能为空！',{shade:false});
	else if(window.Frm.zhuj.value=="")
		layer.msg('猪脚不能为空！',{shade:false});
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
window.Frm.sl.focus();
window.Frm.sl.select();
</script>


