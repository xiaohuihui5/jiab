<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['dt2']))
{
	$syslx=5;
	$IBZ=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$YYF=$_POST['yunf']==""?"null":$_POST['yunf'];
	$KSH=$_POST['koush']==""?"null":$_POST['koush'];
	if($_POST['dt2']==$_POST['odt2'])//修改日期的时候单号也要跟着改,否则单号会出现混乱sys_dh表ges=2的不用修改单号
		$query="update sys_maozdh set dhrq='".$_POST['dt2']."',gysid=".$_POST['gysid'].",zzl=".$_POST['zzl'].",koush=".$KSH.",yunf=".$YYF.",bz=".$IBZ." where id=".$_POST['dhid']."";
	else
		$query="update sys_maozdh set dh='".getdh($_POST['dt2'],$syslx)."',dhrq='".$_POST['dt2']."',gysid=".$_POST['gysid'].",zzl=".$_POST['zzl'].",koush=".$KSH.",yunf=".$YYF.",bz=".$IBZ." where id=".$_POST['dhid']."";
	include("./inc/xexec.php");
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}
else
{
	$query="select b.shortname,a.dh,CONVERT(varchar(10),a.dhrq,120),case len(a.bz) when 0 then null else a.bz end,a.gysid,a.zzl,a.koush,a.yunf from sys_maozdh a,sys_unit b where a.gysid=b.id and a.id=".$_GET['dhid'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$UNITmc=$line[0];
	$DH=$line[1];
	$DHRQ=$line[2];
	$BZ=$line[3];
	$UNIT=$line[4];
	$ZZL=$line[5];
	$SH=$line[6];
	$YF=$line[7];
	sqlsrv_free_stmt($result);
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
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid">
<table>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>采购日期：<input type="hidden" name="odt2" id="odt2" value="<?php echo $DHRQ;?>"><input type="text" class="input-text" name="dt2" id="dt2" value="<?php echo $DHRQ;?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;&nbsp;<span class="c-red">*</span><a href="javascript:;" onclick="Sel()"><font color=blue>[F9]供应商：</font></a><input type="hidden" id="gysid" name="gysid" value="<?php echo $UNIT;?>"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish();"   title="请输入关键字"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) {startRequest(this.value,0);}" style="width: 210px;"  id="spdm" name="spdm" value="<?php echo $UNITmc;?>"></td></tr>
<tr><td align=center height="40"><span class="c-red">*</span>回场总重/斤：<input type="text" class="input-text" name="zzl" id="zzl" style="width:210px;" value="<?php echo $ZZL;?>"></td>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运费：<input type="text" class="input-text" name="yunf" id="yunf" style="width:210px;" value="<?php echo $YF;?>"></td>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;扣损耗/元：<input type="text" class="input-text" name="koush" id="koush" style="width:210px;" value="<?php echo $SH;?>"></td>
<tr><td align=center>备&nbsp;&nbsp;&nbsp;注<br><textarea rows="6" name="bz" cols="33" class="textarea" style="width:320px;"><?php echo $BZ;?></textarea></td></tr>
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
	if(window.IFrm.gysid.value=="")
		layer.msg('请选择供应商名称!',{shade:false});
	else if(window.IFrm.zzl.value=="")
		layer.msg('请录入回场总重量!',{shade:false});
	else
		window.IFrm.submit();
}
function startRequest(spbh,id)//如果传产品id进来直接得到，否则模糊搜索
{
//alert(spbh);
	createXMLHttpRequest();
	xmlHttp.open("post","xgysAjax.php",true);//提交返回结果的php页面
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-Type","text/xml");
	xmlHttp.setRequestHeader("Content-Type","gb2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState == 4)
		{
			if (xmlHttp.status == 200)
			{
			var arrTmp= xmlHttp.responseText.split("@");
			window.IFrm.gysid.value=arrTmp[0];
			window.IFrm.spdm.value=arrTmp[1];
			sub();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//传递给php页面的参数
}
function Sel()
{
	layer_show2("供应商选取","I_Select_gys_S.php","400","460"); //最后一个参数是给一个标识符 
} 
function exit()
{
	parent.layer.closeAll();
}
window.IFrm.spdm.focus();
window.IFrm.spdm.select();
</script>
