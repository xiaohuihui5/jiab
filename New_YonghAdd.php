<?php
require('./inc/xhead.php');
if (isset($_POST['name']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
	$query="insert into sys_user(userid,passwd,name,sex,bumid,zhiw,loginnums,phone,beiz,mobile,yn) 
	values('".$_POST['userid']."','".md5($_POST['passwd'])."','".$_POST['name']."',".$_POST['sex'].",".$_POST['bumid'].",'".$_POST['zhiw']."',0,'".$_POST['phone']."','".$_POST['beiz']."',0,1)";
	include('./inc/xexec.php');
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('�����ɹ���',{shade:false});parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�û�����--�����û�</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��Ա������</td>
	<td><input type="text" class="input-text"  placeholder="" id="name" name="name" onkeydown="if(event.keyCode==13) window.Frm.userid.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�Ա�</td>
	<td><input  type="radio" id="sex"  name="sex" value="0" checked>
		<label for="sex-1">��</label>
		<input type="radio" id="sex" name="sex" value="1">
		<label for="sex-2">Ů</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��¼�ʺţ�</td>
	<td><input type="text" class="input-text" value="" placeholder="" id="userid"  name="userid" onkeydown="if(event.keyCode==13) window.Frm.passwd.select();"  onkeyup="window.Frm.passwd.value=window.Frm.userid.value" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��ʼ���ܣ�</td>
	<td><input type="text" class="input-text"  id="passwd" name="passwd"  value="" onkeydown="if(event.keyCode==13) window.Frm.zhiw.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">&nbsp;��λְ��</td>
	<td><input type="text" class="input-text"  id="zhiw"  name="zhiw" type="text"  onkeydown="if(event.keyCode==13) window.Frm.bumid.focus();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>���ڲ��ţ�</td>
	<td>
		<select class="select" size="1" id="bumid" name="bumid" onkeydown="if(event.keyCode==13) window.Frm.phone.focus();" style="width:80%;height:30px;">
			<?php 
			$query='select id,bummc from sys_bum where yn=1 order by bummc';
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
<tr>
	<td align=right width="20%" height="40">&nbsp;��ϵ�绰��</td>
	<td><input class="input-text" value="" placeholder="" id="phone"  name="phone" type="text" onkeydown="if(event.keyCode==13)window.Frm.beiz.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="100">��ע��</td>
	<td><textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;height:80px;"></textarea></td>
</tr>
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
	if(window.Frm.name.value=="")
		layer.msg('�û���������Ϊ��!',{shade:false});
	else if(window.Frm.bumid.value=="")
		layer.msg('�û����ڲ��Ų���Ϊ��!',{shade:false});
	else if(window.Frm.userid.value=="")
		layer.msg('�û��˺Ų���Ϊ��!',{shade:false});
	else
	{
		window.Frm.submit(); 
       }
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.name.focus();
</script>
