<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
$query='select gongsids from sys_user where empid='.$_SESSION['empid'];//ȡ���в���Ȩ�޵�ҵ���
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
if($line[0]!="")$gongsid=$line[0];
sqlsrv_free_stmt($result);

if(isset($_POST['shortname']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
//�Զ��������
	$query="select bianh from sys_khfenl where id=".$_POST['typeb'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$flbh=$line[0];
	sqlsrv_free_stmt($result);
	$query="select max(right(usercode,3))+1 from sys_unit where mode=2 and typeb=".$_POST['typeb'];
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

	$query="insert into sys_unit(usercode,shortname,name,piny,linkman,phone,address,typea,typeb,typec,typed,typee,mode,dydw,dadj,yn,weixh,meirsh) 
	values('".$code."',rtrim(ltrim('".$_POST['shortname']."')),rtrim(ltrim('".$_POST['name']."')),'".Get_Piny($_POST['shortname'])."',rtrim(ltrim('".$_POST['linkman']."')),rtrim(ltrim('".$_POST['phone']."')),rtrim(ltrim('".$_POST['address']."')),".$_POST['typea'].",".$_POST['typeb'].",".$_POST['typec'].",".$_POST['typed'].",".$_POST['typee'].",2,".$_POST['dydw'].",".$_POST['dadj'].",1,rtrim(ltrim('".$_POST['weixh']."')),".$_POST['meirsh'].")";
	include('./inc/xexec.php');
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();//parent.layer.msg('�����ɹ���',{icon:1,time:1500});//parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
}
//������ơ�����ظ�
$nowname=",";
$query="select shortname from sys_unit where mode=2 and yn=1";
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
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�ͻ���ƣ�</td>
	<td><input type="text" class="input-text" id="shortname" name="shortname" onkeydown="if(event.keyCode==13) window.Frm.name.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">�ͻ�ȫ�ƣ�</td>
	<td><input type="text" class="input-text" id="name" name="name" onkeydown="if(event.keyCode==13) window.Frm.typea.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�ͻ����ͣ�</td>
	<td>
		<select class="select" size="1" id="typea" name="typea" onkeydown="if(event.keyCode==13) window.Frm.typeb.focus();" style="width:80%;height:30px;">
			<option value=''>�ͻ�����ѡȡ</option>
			<?php 
			$query='select id,fenlmc from sys_khleix where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['typea']==$line[0])
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>�ͻ����ࣺ</td>
	<td>
		<select class="select" size="1" id="typeb" name="typeb" onkeydown="if(event.keyCode==13) window.Frm.typec.focus();" style="width:80%;height:30px;">
			<option value=''>�ͻ�����ѡȡ</option>
			<?php 
			$query='select id,fenlmc from sys_khfenl where yn=1 order by bianh';
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>�ͻ���·��</td>
	<td>
		<select class="select" size="1" id="typec" name="typec" onkeydown="if(event.keyCode==13) window.Frm.typee.focus();" style="width:80%;height:30px;">
			<option value=''>�ͻ���·ѡȡ</option>
			<?php 
			$query='select id,fenlmc from sys_khxianl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['typec']==$line[0])
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>������ࣺ</td>
	<td>
		<select class="select" size="1" id="typee" name="typee" onkeydown="if(event.keyCode==13) window.Frm.typed.focus();" style="width:80%;height:30px;">
			<option value='1'>�������ѡȡ</option>
			<?php 
			$query='select id,fenlmc from sys_cwfenl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['typee']==$line[0])
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>��ӡ̧ͷ��</td>
	<td>
		<select class="select" size="1" id="typed" name="typed" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<?php 
			$query='select id,fenlmc from sys_dytait where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['typed']==$line[0])
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
	<td align=right width="20%" height="40">��ϵ�ˣ�</td>
	<td><input type="text" class="input-text" id="linkman" name="linkman" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ�绰��</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" onkeydown="if(event.keyCode==13) window.Frm.address.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ַ��</td>
	<td><input type="text" class="input-text" id="address"  name="address" onkeydown="if(event.keyCode==13) window.Frm.weixh.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">΢�źţ�</td>
	<td><input type="text" class="input-text" id="weixh"  name="weixh" onkeydown="if(event.keyCode==13) sub();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ӡ��λ��</td>
	<td colspan="2">
		<input  type="radio" id="dydw"    name="dydw" value="1" checked>
		<label for="sex-1">����</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="dydw"   name="dydw" value="0" >
		<label for="sex-2">��</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ӡ���ۣ�</td>
	<td colspan="2">
		<input  type="radio" id="dadj"    name="dadj" value="1" checked>
		<label for="sex-1">��</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="dadj"   name="dadj" value="0" >
		<label for="sex-2">��</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">ÿ�����ͣ�</td>
	<td colspan="2">
		<input  type="radio" id="meirsh"    name="meirsh" value="1" checked>
		<label for="sex-1">��</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="meirsh"   name="meirsh" value="0" >
		<label for="sex-2">��</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">ë��ҵ�������</td>
	<td colspan="2">
		<input type="radio" id="gongsid" name="gongsid" value="1" <?php echo $gongsid=="1"?checked:"";?>>
		<label for="sex-1">����</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="gongsid" name="gongsid" value="2" <?php echo $gongsid=="2"?checked:"";?>>
		<label for="sex-2">�ο�</label>
	</td>
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
	var nowname="<?php echo $nowname;?>";
	if(nowname.indexOf(','+window.Frm.shortname.value+',')!=-1)
	{
		parent.layer.msg('�ÿͻ�����Ѵ���,����ϸ����¼�룡', {icon:2,time:1500});
		window.Frm.shortname.select();
		return false;
	}
	else if(window.Frm.shortname.value=="")
	{
		parent.layer.msg('�ͻ���Ʋ���Ϊ�գ�', {icon:2,time:1500});
		window.Frm.shortname.focus();
		return false;
	}

	else if(window.Frm.typea.value=="")
	{
		parent.layer.msg('�ͻ����Ͳ���Ϊ�գ�', {icon:2,time:1500});
		window.Frm.typea.focus();
		return false;
	}

	else if(window.Frm.typeb.value=="")
	{
		parent.layer.msg('�ͻ����಻��Ϊ�գ�', {icon:2,time:1500});
		window.Frm.typeb.focus();
		return false;
	}
	else if(window.Frm.typec.value=="")
	{
		parent.layer.msg('�ͻ���·����Ϊ�գ�', {icon:2,time:1500});
		window.Frm.fenz.focus();
		return false;
	}
	else if(window.Frm.typed.value=="")
	{
		parent.layer.msg('��ӡ̧ͷ����Ϊ�գ�', {icon:2,time:1500});
		window.Frm.fenz.focus();
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
window.Frm.usercode.focus();
</script>
