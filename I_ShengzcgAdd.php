<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$query='select gongsids from sys_user where empid='.$_SESSION['empid'];//取得有操作权限的业务点
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
if($line[0]!="")
	$TJ=" and id in(".$line[0].")";
sqlsrv_free_stmt($result);

if(isset($_POST['dt2']))
{
	$syslx=9;
	$IBZ=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$YF=$_POST['yunf']==""?"null":$_POST['yunf'];
	$SH=$_POST['koush']==""?"null":$_POST['koush'];
	$query="insert into sys_maozdh(dh,dhrq,gysid,lury,yunf,zzl,koush,bz,zf,lx,zt,gongsid) values('".getdh($_POST['dt2'],$syslx)."','".$_POST['dt2']."',".$_POST['gysid'].",'".$_SESSION['uname']."',".$YF.",".$_POST['zzl'].",".$SH.",".$IBZ.",-1,$syslx,0,".$_POST['gongsid'].")";
	include("./inc/xexec.php");
	$query="select max(id) from sys_maozdh where lx=".$syslx;
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$dan=$line[0];
	sqlsrv_free_stmt($result);
	echo "<script language=javascript>window.parent.Frm.submit();window.parent.hqlist.mx(".$dan.");parent.layer.closeAll();</script>";
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
<script language="javascript" src="xSelgysMohu.js"></script>
</head>
<BODY >
<form name="IFrm" method="POST" action="">
<table>
<tr>
	<td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>业务分点：
		<select class="select" size="1" id="gongsid" name="gongsid" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.dt2.focus();" style="width:210px;height:30px;">
			<?php 
			$query='select id,fenlmc from sys_maozfd where id>0 '.$TJ.' order by id';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>采购日期：<input type="text" class="input-text" name="dt2" id="dt2" value="<?php echo date('Y-m-d',strtotime("+1 day"));?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;&nbsp;<span class="c-red">*</span><a href="javascript:;" onclick="Sel()"><font color=blue>[F9]供应商：</font></a><input type="hidden" value="" id="gysid" name="gysid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish();"   title="请输入关键字"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) {startRequest(this.value,0);}" style="width: 210px;"  id="spdm" name="spdm"></td></tr>
<tr><td align=center height="40"><span class="c-red">*</span>回场总重/斤：<input type="text" class="input-text" name="zzl" id="zzl" value="" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运费：<input type="text" class="input-text" name="yunf" id="yunf" value="" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;扣损耗/元：<input type="text" class="input-text" name="koush" id="koush" value="" style="width:210px;"></td>
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
	if(window.IFrm.gysid.value=="")
		layer.msg('请选择供应商!',{shade:false});
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
