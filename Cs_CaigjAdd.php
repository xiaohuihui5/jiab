<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['dt1']))
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$IBZ=$_POST['bz']==""?"null":"'".$_POST['bz']."'";//备注空转null
	$syslx=26;
	$query="insert into sys_selljg(dh,unitid,brq,erq,lx,beiz,lury,dhrq) values('".getdh($_POST['dt1'],$syslx)."',".$_POST['khflid'].",'".$_POST['dt1']."','".$_POST['dt2']."',".$syslx.",".$IBZ.",'".$_SESSION['uname']."','".date('Y-m-d')."')";
	include("./inc/xexec.php");
	$query="select max(id) from sys_selljg where lx=".$syslx;
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
<title>新增供应商采购价格表</title>
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
<script language="javascript" src="xSelGysMohu.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Sel();}}</script>
</head>
<BODY >
<form name="IFrm" method="POST" action="">
<table>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>作用日期：<input type="text" class="input-text" name="dt1" id="dt1" value="<?php echo $_SESSION['DT1'];?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>结束日期：<input type="text" class="input-text" name="dt2" id="dt2" value="<?php echo $_SESSION['DT2'];?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=center height="40"><span class="c-red">*</span><a href="javascript:;" onclick="Sel();"><font color=blue>[F9]供应商：</font></a><input type="hidden" value="" name="khflid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish()"   title="请输入关键字"  onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) startRequest(this.value,0)" style="width: 210px;"  id="spdm" name="spdm"> </td></tr>
<tr><td align=center>备&nbsp;&nbsp;&nbsp;注<br><textarea rows="6" name="bz" cols="33" class="textarea" style="width:290px;"></textarea></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
</td></tr>
</TABLE>
</form>
</body>
</html>
<script lanuage="javascript">
function sub()
{
	if(window.IFrm.khflid.value=="")
		layer.msg('请选择供应商!',{shade:false});
	else
	{
		window.IFrm.submit();
      }
}
function startRequest(spbh,id)//如果传产品id进来直接得到，否则模糊搜索
{
	createXMLHttpRequest();
	xmlHttp.open("post","xSelGysAjax.php",true);//提交返回结果的php页面
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
			window.IFrm.khflid.value=arrTmp[0];
			window.IFrm.spdm.value=arrTmp[1];
			sub();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//传递给php页面的参数
}
function Sel()
{
	layer_show2("供应商选取","Cs_Select_Gys_S.php","400","460"); //最后一个参数是给一个标识符 
} 
function exit()
{
	parent.layer.closeAll();
}
window.IFrm.spdm.focus();
window.IFrm.spdm.select();
</script>
