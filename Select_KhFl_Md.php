<?php 
require('./inc/xhead.php');
$xiam=current(explode('.',end(explode('/',$_SERVER['PHP_SELF'])))).'1.php';
$tit="�ͻ�����ѡȡ";
?>
<html>
<head>
<title><?php echo $tit;?></title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" href="./inc/new_select_m.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script language="javascript" src="./inc/xSelectajax.js" type="text/javascript" charset="GB2312"></script>
</head>
<body>
<table align="center" style="width:100%; height:420;position:absolute" cellspacing="0" cellpadding="0" border="0">
<tr><td height="30" colspan="3" align=center><b><font color=red><?php echo $tit;?></b></td></tr>
<tr>
<td width="49%" height="100%">
<table cellSpacing="0" cellPadding="0" border="0" class="table1">
<tr>
<td align=center height="10%">
	<select style="width: 275px;font-family: ΢���ź�; font-size: 12px; line-height: 15px;border: 1px #000000 solid" id="cpfl" name="cpfl" onchange="ListLeft()">
		<option value="" style="align:center">-------���ϼ�ѡȡ-------</option>
	</select>
</td>
</tr>
<tr>
<td align=center  height="10%">
	<input id="cxtj"  tabindex="1" name="cxtj"  onkeydown="if(event.keyCode==13) ListLeft()" style="height:30px;width: 210px;font-family: ΢���ź�; font-size: 12px; line-height: 15px;border: 1px #000000 solid">
	<input class="btn btn-primary radius" type="button" value="����" onclick="ListLeft()" style="width: 60px;">
</td>
</tr>
<tr>
<td align=center width="100%" height="80%">
	��ѡ�б�<br>
	<select style="width:275px;height:360px" name="fromBox" onDblClick="LtoR_S()" id="fromBox" size="18" multiple="multiple">
	<?php 
		$query="select cpfenl.id,cpfenl.fenlmc from sys_khfenl cpfenl where cpfenl.yn=1 order by cpfenl.bianh,cpfenl.fenlmc";
		$result=sqlsrv_query($conn,$query);
		while($line=sqlsrv_fetch_array($result))
		{
			echo '<option value="',$line[0],'">',$line[1],'</option>';
		}       
		sqlsrv_free_stmt($result);
		sqlsrv_close($conn);
	?></select>
</td>
</tr>
</table>
</td>
<td width="2%" height="100%" align="center">
<a href="javascript:LtoR_S()" title="�����ѡ�е�����"><b>>></b></a>
<br>
<br>
<a href="JavaScript:LtoR_M()" title="������б�ȫ������"><b>>>></b></a>
<br>
<br>
<br>
<br>
<br>
<a href="JavaScript:RtoL_S()" title="���ұ�ѡ�е�����"><b><<</b></a>
<br>
<br>
<a href="JavaScript:RtoL_M()" title="���ұ��б�ȫ������"><b><<<</b></a>
</td>
<td width="49%" height="100%">
	<table cellSpacing="0" cellPadding="0" border="0" class="table3" height="440px">
	<tr><td align=center >
	<select style="width:300px;height:100%;" name="toBox" onDblClick="RtoL_S()" id="toBox" size="12" multiple="multiple">
	</select>
	</td></tr>
	</table>
</td>
</tr>
<tr>
	<td colspan="3"><div class="tishi">&nbsp;&nbsp;&nbsp;<font color=#696969><b>>></b>�����ѡ������,<b>>>></b>�����ȫ������,�ɰ�סCtrl����ѡ</div></td>
</tr>
<tr>
	<td align=center colspan="3" style="width:100%;">
		<div class="sos">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="SelOk()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
		</div>
	</td>
</tr>
</table>
</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript">
function DisSelect(IdStr,cwho)
{
	CreateSelect("<?php echo $xiam;?>",cwho,"selid="+IdStr+"&cxtj="+document.getElementById('cxtj').value+"&cpfl="+document.getElementById('cpfl').value);//��һ��������ajaxȡֵ��phpҳ��ϵͳ�Զ����,�ڶ�������Ϊ0��ʾ��ʾ���ѡ���,Ϊ1��ʾ�ұ�Ϊ2���Ҷ���ʾ,����������Ϊ�ύ�Ĳ�ѯ����
}
function SelOk()
{

	var s_id="";
	var s_name="";
	for(var num=0;num<document.getElementById('toBox').length;num++)
	if(s_id=="")
	{
		s_id=document.getElementById('toBox').options[num].value;
		s_name=document.getElementById('toBox').options[num].text;
	}
	else
	{
		s_id=s_id+","+document.getElementById('toBox').options[num].value;
		s_name=s_name+","+document.getElementById('toBox').options[num].text;
	}

	if(s_id=="") s_name="�ͻ�����";
	parent.Frm.khflid.value=s_id;
	parent.Frm.khflmc.value=s_name;
	parent.Frm.khflmc.title=s_name;
	parent.layer.closeAll();
}
function exit()
{
	parent.layer.closeAll();
}
window.cxtj.focus();
</script>
