<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['khid']))
{
	$query="delete sys_khpm where flid=".$_POST['khidb'];
	include("./inc/xexec.php");
	$query="insert into sys_khpm(flid,cpid,bh,mc,dw,gg,jies) select ".$_POST['khidb'].",cpid,bh,mc,dw,gg,jies from sys_khpm where flid=".$_POST['khid'];
	include("./inc/xexec.php");
	echo "<script language=javascript>layer_show('��ܰ��ʾ','I_Tis.php?tis=1','','');</script>";//��ʾ�ɹ��˳�
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr><td align=center height="40">&nbsp;</td></tr>
<tr><td align=center height="40"><span class="c-red">*</span><a href="javascript:;" onclick="kh2()"><font color=blue>ѡȡ�ͻ�����A��</font></a><input id="khid" name="khid" type="hidden" value=""><input type="text" class="input-text"  readonly id="khmc"  name="khmc" placeholder="ѡȡ�ͻ���ƷA" onkeydown="if(event.keyCode==13) kh2();" onclick="kh2()" style="width: 210px;"></td></tr>
<tr><td align=center height="40">||</td></tr>
<tr><td align=center height="40">||</td></tr>
<tr><td align=center height="40">V</td></tr>
<tr><td align=center height="40"><span class="c-red">*</span><a href="javascript:;" onclick="kh3()"><font color=blue>�����ͻ�����B��</font></a><input id="khidb" name="khidb" type="hidden" value=""><input type="text" class="input-text"  readonly id="khmcb"  name="khmcb" placeholder="�����ͻ���ƷB" onkeydown="if(event.keyCode==13) kh3();" onclick="kh3()" style="width: 210px;"></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>&nbsp;</td></tr>

<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script lanuage="javascript">
function sub()
{
	if(window.Frm.khid.value=="")
		layer.msg('ѡȡ�ͻ���ƷA����Ϊ��!',{shade:false});
	else if(window.Frm.khidb.value=="")
		layer.msg('�����ͻ���ƷB����Ϊ��!',{shade:false});
	else
	{
		window.Frm.submit();
      }
}
function kh2()
{
	layer_show2("�ͻ�ѡȡ","Select_Kh_S2.php","400","460"); //���һ�������Ǹ�һ����ʶ�� 
} 
function kh3()
{
	layer_show2("�ͻ�ѡȡ","Select_Kh_S3.php","400","460"); //���һ�������Ǹ�һ����ʶ�� 
} 
function exit()
{
	parent.layer.closeAll();
}
window.Frm.khmc.focus();
window.Frm.khmc.select();
</script>
