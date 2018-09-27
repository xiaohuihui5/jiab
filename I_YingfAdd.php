<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$query="select distinct unit.id,unit.shortname from sys_jhdh dh,sys_unit unit where dh.id in(".$_REQUEST['dh_id'].") and dh.unit=unit.id";//查询供应商
$result=sqlsrv_query($conn,$query);
$gys_sl=0;
while($line=sqlsrv_fetch_array($result))
{
	$gys_sl+=1;
	$gysmc=$line[1];
	$gysid=$line[0];
}       
sqlsrv_free_stmt($result);
if($gys_sl>1)//选了多个供应商的单
	echo "<font color=red size=4><b>生成供应商付款单每次只能选择一个供应商的采购单,您选择了多个供应商采购单,请关闭该页面并重新选择单据!</b></font>";
else
{
$query="select sum(dh.zf*sj.shisje) from sys_jhsj sj,sys_jhdh dh where dh.id=sj.dhid and dh.id in(".$_REQUEST['dh_id'].")";//查询应付金额
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$je=$line[0];
}       
sqlsrv_free_stmt($result);

if(isset($_POST['dt1']))
{
	$syslx=1;
	$IBZ=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$query="insert into sys_fuksj(rq,fukrq,gysid,fukdh,yingfk,shifk,lury,bz,lx) values('".date('Y-m-d')."','".$_POST['dt1']."',".$_POST['gysid'].",'".$_REQUEST['dh_id']."',".$_POST['yingfk'].",".$_POST['shifk'].",'".$_SESSION['uname']."',".$IBZ.",$syslx)";
	include("./inc/xexec.php");
	$query="update sys_jhdh set zt=100 where id in(".$_REQUEST['dh_id'].")";
	include("./inc/xexec.php");
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
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
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Sel();}}</script>
<script language="javascript" src="xSelkhMohu.js"></script>
</head>
<BODY >
<form name="IFrm" method="POST" action="">
<table>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>供应商名：<input type="hidden" value="<?php echo $gysid;?>" name="gysid" id="gysid"><input type="text" disabled value="<?php echo $gysmc;?>" class="input-text" onclick="this.select();" style="width: 210px"></td></tr>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>付款日期：<input type="text" class="input-text" name="dt1" id="dt1" value="<?php echo date('Y-m-d');?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>应付总额：<input type="text" readonly value="<?php echo $je;?>" class="input-text" onclick="this.select();" onkeydown="if(event.keyCode==13) window.IFrm.shifk.focus();" style="width: 210px;"  id="yingfk" name="yingfk"></td></tr>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>实付总额：<input type="text" value="<?php echo $je;?>" class="input-text" onclick="this.select();" onkeydown="if(event.keyCode==13) window.IFrm.bz.focus();" style="width: 210px;"  id="shifk" name="shifk"></td></tr>
<tr><td align=center>备&nbsp;&nbsp;&nbsp;注<br><textarea rows="6" name="bz" cols="33" class="textarea" style="width:320px;"></textarea></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.IFrm.shifk.value=="")
		layer.msg('请填实际付款金额!',{shade:false});
	else
		window.IFrm.submit();
}
function exit()
{
	parent.layer.closeAll();
}
window.IFrm.shifk.focus();
window.IFrm.shifk.select();
</script>
<?php 
}//else end
?>
