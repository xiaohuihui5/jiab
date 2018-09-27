<?php 
include("./inc/xhead.php");
if(isset($_REQUEST['zhug']))//cpid(35,32,33,59)
{
	$query="insert into sys_jiagnz(cpid,zhongl,lx,pinz) values(35,".$_POST['zhug'].",1,".$_REQUEST['pinz'].")";
	sqlsrv_query($conn,$query);

	$query="insert into sys_jiagnz(cpid,zhongl,lx,pinz) values(32,".$_POST['zhud'].",1,".$_REQUEST['pinz'].")";
	sqlsrv_query($conn,$query);

	$query="insert into sys_jiagnz(cpid,zhongl,lx,pinz) values(33,".$_POST['zhux'].",1,".$_REQUEST['pinz'].")";
	sqlsrv_query($conn,$query);

	$query="insert into sys_jiagnz(cpid,zhongl,lx,pinz) values(59,".$_POST['zhul'].",1,".$_REQUEST['pinz'].")";
	sqlsrv_query($conn,$query);
	echo "<script language=javascript>parent.layer.closeAll();</script>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>生产加工--内脏明细</title>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<script language="javascript" src="./inc/xmy.js?i=2"></script>
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
	<td colspan=2>当前录入生猪品种:
		<select disabled class="select" size="1" style="width: 210px;height:30px;" name="pz" id="pz">
		<?php 
		$query="select id,mc from sys_cp where id=".$_REQUEST['pinz'];
		$result=sqlsrv_query($conn,$query);
		while($line=sqlsrv_fetch_array($result))
		{
			echo "<option value=".$line[0].">".$line[1]."</option>";
		}       
		sqlsrv_free_stmt($result);
		?>
		</select>
	</td>
</tr>
<tr>
	<td width="30%" align=right height="40">猪肝:</td>
	<td width="70%"><input class="input-text"  placeholder="" name="zhug" value="" onkeydown="if(event.keyCode==13)window.Frm.zhud.select();" onkeyup="window.Frm.zzl.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value" style="width: 210px" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="30%" align=right height="40">猪肚:</td>
	<td width="70%"><input class="input-text"  placeholder="" name="zhud" value="" onkeydown="if(event.keyCode==13)window.Frm.zhux.select();" onkeyup="window.Frm.zzl.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value" style="width: 210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="30%" align=right height="40">猪心:</td>
	<td width="70%"><input class="input-text"  placeholder="" name="zhux" value="" onkeydown="if(event.keyCode==13)window.Frm.zhul.select();" onkeyup="window.Frm.zzl.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value" style="width: 210px;" onfocus="this.select();"></td>
</tr>
<tr>
	<td width="30%" align=right height="40">猪俐:</td>
	<td width="70%"><input name="zzl" type="hidden" value=""><input class="input-text"  placeholder="" name="zhul" value="" onkeydown="if(event.keyCode==13)sub();" onkeyup="window.Frm.zzl.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value;" style="width: 210px;" onfocus="this.select();"></td>
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
	if(window.Frm.zhug.value=="")
		layer.msg('猪肝重量不能为空，可以填0!',{shade:false});
	else if(window.Frm.zhud.value=="")
		layer.msg('猪肚重量不能为空，可以填0!',{shade:false});
	else if(window.Frm.zhux.value=="")
		layer.msg('猪心重量不能为空，可以填0!',{shade:false});
	else if(window.Frm.zhul.value=="")
		layer.msg('猪俐重量不能为空，可以填0!',{shade:false});
	else
	{
		parent.IFrm.neiz1.value=window.Frm.zzl.value;
		parent.IFrm.fengs.focus();
		window.Frm.submit();
	}
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.zhug.focus();
window.Frm.zhug.select();
</script>


