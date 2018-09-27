<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['khid']))
{
	$query="if exists (select id from sys_khpm where flid=".$_POST['khid']." and cpid=".$_POST['cpid'].") 
	update sys_khpm set huans='".$_POST['huans']."',basecode='".$_POST['code']."',bh='".$_POST['bh']."',mc='".$_POST['mc']."',dw='".$_POST['dw']."',gg='".$_POST['gg']."' where flid=".$_POST['khid']." and cpid=".$_POST['cpid']." else 
	insert into sys_khpm(basecode,huans,flid,cpid,bh,mc,dw,gg) values(".$_POST['code'].",".$_POST['huans'].",".$_POST['khid'].",".$_POST['cpid'].",'".$_POST['bh']."','".$_POST['mc']."','".$_POST['dw']."','".$_POST['gg']."')";
	include("./inc/xexec.php");
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
}
$query="select a.id,a.flid,a.cpid,a.bh,a.mc,a.dw,a.gg,khfenl.fenlmc,cp.mc,a.basecode,a.huans from sys_khpm a,sys_khfenl khfenl,sys_cp cp where a.flid=khfenl.id and a.cpid=cp.id and a.id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$sjid=$line[0];
	$khid=$line[1];
	$cpid=$line[2];
	$bh=$line[3];
	$mc=$line[4];
	$dw=$line[5];
	$gg=$line[6];
	$shortname=$line[7];
	$cpmc=$line[8];
	$code=$line[9];
	$huans=$line[10];
}       
sqlsrv_free_stmt($result);

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
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script type="text/javascript" src="Cs_KehSelpmMohu.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr><td align=center height="40"><span class="c-red">*</span><a href="javascript:;" onclick="kh()"><font color=blue>客户分类：</font></a><input id="khid" name="khid" type="hidden" value="<?php echo $khid;?>"><input type="text" class="input-text"  readonly id="khmc"  name="khmc" value="<?php echo $shortname;?>" placeholder="选取客户名称" onkeydown="if(event.keyCode==13) kh();" onclick="kh()" style="width: 210px;"></td></tr>
<tr><td align=center height="40"><span class="c-red">*</span><a onclick="layer_show2('产品选取','Select_Cp_Sedit.php','500','500')"><font color=blue>公司产品：</font></a><input type="hidden" value="<?php echo $cpid?>" name="cpid" id="cpid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish()"   title="请输入关键字"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) startRequest(this.value,0)" style="width: 210px;"  id="cpmc" name="cpmc" value="<?php echo $cpmc;?>"></td></tr>
<tr><td align=center height="40"><span class="c-red">*</span>客户编号：<input type="text" class="input-text" name="bh" id="bh" value="<?php echo $bh;?>" onkeydown="if(event.keyCode==13) window.Frm.mc.select();" style="width:210px;"></td>
<tr><td align=center height="40"><span class="c-red">*</span>客户品名：<input type="text" class="input-text" name="mc" id="mc" value="<?php echo $mc;?>" onkeydown="if(event.keyCode==13) window.Frm.dw.select();" style="width:210px;"></td>
<tr><td align=center height="40"><span class="c-red"></span>客户条码：<input type="text" class="input-text" name="code" id="code" value="<?php echo $code;?>" onkeydown="if(event.keyCode==13) window.Frm.dw.select();" style="width:210px;"></td>
<tr><td align=center height="40"><span class="c-red">*</span>换算值&nbsp;&nbsp：<input type="text" class="input-text" name="huans" id="huans" value="<?php echo $huans?>"  onkeyup="if(isNaN(value))execCommand('undo');"    onafterpaste="if(isNaN(value))execCommand('undo');" onkeydown="if(event.keyCode==13) window.Frm.dw.select();" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位：<input type="text" class="input-text" name="dw" id="dw" value="<?php echo $dw;?>" onkeydown="if(event.keyCode==13) window.Frm.gg.select();" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;规&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：<input type="text" class="input-text" name="gg" id="gg" value="<?php echo $gg;?>" onkeydown="if(event.keyCode==13) sub();" style="width:210px;"></td>
<tr><td align=center>备&nbsp;&nbsp;&nbsp;注<br><textarea rows="6" name="bz" cols="33" class="textarea" style="width:290px;"></textarea></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script lanuage="javascript">
function sub()
{
	if(window.Frm.khid.value=="")
		layer.msg('客户分类不能为空!',{shade:false});
	else if(window.Frm.cpid.value=="")
		layer.msg('产品名称不能为空!',{shade:false});
	else if(window.Frm.mc.value=="")
		layer.msg('客户品名不能为空!',{shade:false});
	else
	{
		window.Frm.submit();
      }
}
function startRequest(spbh,id)//如果传产品id进来直接得到，否则模糊搜索
{
	createXMLHttpRequest();
	xmlHttp.open("post","Cs_KehSelCpAjax.php",true);//提交返回结果的php页面
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
			window.Frm.cpid.value=arrTmp[0];
			window.Frm.spdm.value=arrTmp[1];
			window.Frm.mc.value=arrTmp[1];
			window.Frm.dw.value=arrTmp[4];
			window.Frm.gg.value=arrTmp[5];
			window.Frm.bh.focus();
			CloseTipDiv();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//传递给php页面的参数
}
function kh()
{
	layer_show2("客户选取","Select_Kh_S.php","500","500"); //最后一个参数是给一个标识符 
} 
function exit()
{
	parent.layer.closeAll();
}
window.Frm.khmc.focus();
window.Frm.khmc.select();
</script>
