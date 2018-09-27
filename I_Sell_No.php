<?php 
require('./inc/xhead.php');
$DHLX=date('Y-m-d',strtotime("+1 day"))."每日送货-未下单客户";
?>
<HTML>
<HEAD>
<title><?php echo $DHLX;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</HEAD>
<body bottomMargin="0" leftMargin="0" topMargin="0" rightMargin="0">
<TABLE width="100%" cellSpacing="0" cellPadding="0" border="0">
<tr><td height=20 align=center><b><font color=red><?php echo $DHLX;?></b></td></tr>
</table>
<table border="1" cellpadding="0" style="word-break:break-all" cellspacing="0" style="border-collapse: collapse; FONT-SIZE: 10pt; LINE-HEIGHT: 18px; FONT-FAMILY: 宋体" bordercolor="#6595d6" width="100%">
<?php 
$_SESSION['mac']="select 1,b.fenlmc,a.usercode+'--'+a.shortname from sys_unit a,sys_khfenl b where a.yn=1 and a.typeb=b.id  and a.mode=2 and a.meirsh=1 and a.id not in(select unit from sys_jhdh where lx=2 and dhrq='".date('Y-m-d',strtotime("+1 day"))."')  order by b.fenlmc,a.shortname";
$_SESSION['mac'].="#".",0,0";
$_SESSION['mac'].="#".",50%,50%";
$_SESSION['mac'].="#".",left,left";
$_SESSION['mac'].="#".",客户名称,分店名称";
$_SESSION['mac'].="#"."表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
include("./inc/xdis.php");
?>
</table>

<TABLE width="100%" cellSpacing="0" cellPadding="0" border="0">
<tr><td align=center>
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;关闭&nbsp;&nbsp;" onclick="window.close()">
</td></tr>
</TABLE>
</form>
</body>
</HTML>
