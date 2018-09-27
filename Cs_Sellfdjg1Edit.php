<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['dt1']))
{
	$IBZ=$_POST['bz']==""?"null":"'".$_POST['bz']."'";//备注空转null
	$query="update sys_selljg set brq='".$_POST['dt1']."',erq='".$_POST['dt2']."',unitid=".$_POST['khid'].",beiz=".$IBZ." where id=".$_POST['dhid'];
	include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
	}
}
else
{
	$query="select b.shortname,a.id,a.dh,CONVERT(varchar(10),a.brq,120),CONVERT(varchar(10),a.erq,120),case len(a.beiz) when 0 then null else a.beiz end,a.unitid from sys_selljg a,sys_unit b where a.unitid=b.id and a.id=".$_REQUEST['dhid'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$DH=$line[2];
	$BRQ=$line[3];
	$ERQ=$line[4];
	$UNIT=$line[6];
	$BZ=$line[5];
	$UNITmc=$line[0];
	sqlsrv_free_stmt($result);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />

<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script language="javascript" src="xSelkhMohu.js"></script>
</head>
<BODY >
<form name="IFrm" method="POST" action="">
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid">
<table>
<tr><td align=center height="40"><span class="c-red">*</span>作用日期：<input type="text" class="input-text" name="dt1" id="dt1" value="<?php echo $BRQ;?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40"><span class="c-red">*</span>结束日期：<input type="text" class="input-text" name="dt2" id="dt2" value="<?php echo $ERQ;?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40"><span class="c-red">*</span>客户名称：<input type="hidden" value="<?php echo $UNIT;?>" name="khid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish()" value="<?php echo $UNITmc;?>" title="请输入关键字"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) startRequest(this.value,0)" style="width: 210px;"  id="spdm" name="spdm"></td></tr>
<tr><td align=center>备&nbsp;&nbsp;&nbsp;注<br><textarea rows="6" name="bz" cols="33" class="textarea" style="width:290px;"><?php echo $BZ;?></textarea></td></tr>
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
	if(window.IFrm.khid.value=="")
		layer.msg('请选择客户!',{shade:false});
	else
	{
		window.IFrm.submit();
      }
}
function startRequest(spbh,id)//如果传产品id进来直接得到，否则模糊搜索
{
	createXMLHttpRequest();
	xmlHttp.open("post","Cs_SellfdjgAddAjax.php",true);//提交返回结果的php页面
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
			window.IFrm.khid.value=arrTmp[0];
			window.IFrm.spdm.value=arrTmp[1];
			sub();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//传递给php页面的参数
}

function exit()
{
	parent.layer.closeAll();
}
window.IFrm.spdm.focus();
window.IFrm.spdm.select();
</script>
