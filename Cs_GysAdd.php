<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['shortname']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
//�Զ��������
	$query="select bianh from sys_gysfenl where id=".$_POST['typeb'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$flbh=$line[0];
	sqlsrv_free_stmt($result);
	$query="select max(right(usercode,3))+1 from sys_unit where mode=1 and typeb=".$_POST['typeb'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if($line[0]!="")
	{
		$code=$flbh.substr("00".$line[0],-3);
	}
	else
		$code=$flbh."001";
	sqlsrv_free_stmt($result);
//�Զ��������

	$query="insert into sys_unit(usercode,shortname,piny,linkman,phone,address,typea,typeb,mode,yn) 
	values('".$code."','".$_POST['shortname']."','".Get_Piny($_POST['shortname'])."','".$_POST['linkman']."','".$_POST['phone']."','".$_POST['address']."',".$_POST['typea'].",".$_POST['typeb'].",1,1)";
	include("./inc/xexec.php");
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();//parent.layer.msg('�����ɹ���',{icon:1,time:1500});//parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
}
//������ơ�����ظ�
$nowname=",";
$query="select shortname from sys_unit where mode=1 and yn=1";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$nowname=$nowname.$line[0].",";
}       
sqlsrv_free_stmt($result);
//������ơ�����ظ�
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��Ӧ�����ƣ�</td>
	<td><input type="text" class="input-text" id="shortname" name="shortname" onkeydown="if(event.keyCode==13) window.Frm.linkman.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ�ˣ�</td>
	<td><input type="text" class="input-text" id="linkman" name="linkman" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ�绰��</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" onkeydown="if(event.keyCode==13) window.Frm.typea.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">���㷽ʽ��</td>
	<td>
	<select class="select" size="1" id="typea" name="typea" onkeydown="if(event.keyCode==13) window.Frm.typeb.focus();" style="width:80%;height:30px;">
	<option value="1">�ֽ�</option>
	<option value="2">�½�</option>
	</select>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�������ࣺ</td>
	<td>
		<select class="select" size="1" id="typeb" name="typeb" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<option value=''>��Ӧ�̷���ѡȡ</option>
			<?php 
			$query='select id,fenlmc from sys_gysfenl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['typeb']==$line[0])
				echo "<option value=".$line[0]." selected>".$line[1]."</option>";
			else
				echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">���ã�</td>
	<td>
		<input  type="radio" id="yn"    name="yn" value="1" checked>
		<label for="sex-1">����</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="yn"   name="yn" value="0" >
		<label for="sex-2">����</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ��ַ��</td>
	<td><textarea name="address" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;"></textarea></td>
</tr>
<tr><td align=center colspan="2" height="10"></td></tr>

<tr>
<td align=center colspan="2" height="40">				
	<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
	<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
</td>
</tr>
</table>
</form>
</body>
</html>
<script lanuage="javascript">
function sub()
{
	var nowname="<?php echo $nowname;?>";
	if(window.Frm.shortname.value=="")
	{
		parent.layer.msg('��Ӧ�����Ʋ���Ϊ�գ�', {icon:2,time:1500});
		window.Frm.shortname.select();
		return false;
	}
	else if(window.Frm.typeb.value=="")
	{
		parent.layer.msg('��Ӧ�̷��಻��Ϊ�գ�', {icon:2,time:1500});
		window.Frm.typeb.select();
		return false;
	}
	else
	{
		window.Frm.submit(); 
       }
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.shortname.focus();
</script>
