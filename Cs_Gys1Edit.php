<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['shortname']))
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
	if($_POST['otypeb']!=$_POST['typeb'])//����䶯��,����Զ����ɶ�Ӧ������
		$query="update sys_unit set usercode='".$code."',shortname='".$_POST['shortname']."',name='".$_POST['name']."',piny='".Get_Piny($_POST['shortname'])."',linkman='".$_POST['linkman']."',phone='".$_POST['phone']."',address='".$_POST['address']."',typea=".$_POST['typea'].",typeb=".$_POST['typeb']." where id=".$_POST['eid'];
	else
		$query="update sys_unit set shortname='".$_POST['shortname']."',name='".$_POST['name']."',piny='".Get_Piny($_POST['shortname'])."',linkman='".$_POST['linkman']."',phone='".$_POST['phone']."',address='".$_POST['address']."',typea=".$_POST['typea'].",typeb=".$_POST['typeb']." where id=".$_POST['eid'];
		$query=str_replace(",#","",$query);
		include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>window.parent.hqlist.Frm.submit();parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
	}
}
$query="select shortname,case len(linkman) when 0 then null else linkman end,case len(phone) when 0 then null else phone end,case len(address) when 0 then null else address end,typeb,typea,usercode,yn from sys_unit where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$shortname=$line[0];
	$linkman=$line[1];
	$phone=$line[2];
	$address=$line[3];
	$typeb=$line[4];
	$typea=$line[5];
	$usercode=$line[6];
	$yn=$line[7];
}   
sqlsrv_free_stmt($result);
$nowname=",";//������������
$query="select shortname from sys_unit where mode=1 and id<>".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$nowname=$nowname.$line[0].",";
}       
sqlsrv_free_stmt($result);
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�޸Ĺ�Ӧ������</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>

</head>
<BODY >
<form name="Frm" method="POST" action="">
<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��ţ�</td>
	<td><input disabled type="text" class="input-text" id="usercode" name="usercode" value="<?php echo $usercode;?>" onkeydown="if(event.keyCode==13) window.Frm.shortname.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��Ӧ�����ƣ�</td>
	<td><input type="text" class="input-text" id="shortname" name="shortname" value="<?php echo $shortname;?>" onkeydown="if(event.keyCode==13) sub();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ�ˣ�</td>
	<td><input type="text" class="input-text" id="linkman" name="linkman" value="<?php echo $linkman;?>" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ�绰��</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" value="<?php echo $phone;?>" onkeydown="if(event.keyCode==13) window.Frm.typea.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">���㷽ʽ��</td>
	<td>
		<select class="select" size="1" id="typea" name="typea" style="width:80%;height:30px;">
		<option value="1" <?php echo $typea==1?selected:"";?>>�ֽ�</option>
		<option value="2" <?php echo $typea==2?selected:"";?>>�½�</option>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�������ࣺ</td>
	<td><input type="hidden" name="otypeb" value="<?php echo $typeb;?>">
		<select class="select" size="1" id="typeb" name="typeb" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<option value=''>��Ӧ�̷���ѡȡ</option>
			<?php 
			$query='select id,fenlmc from sys_gysfenl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($typeb==$line[0])
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
		<input  type="radio" id="yn"    name="yn" value="1" <?php echo $yn==1?"checked":"";?> >
		<label for="sex-1">����</label>
		<input type="radio" id="yn"   name="yn" value="0" <?php echo $yn==0?"checked":"";?> >
		<label for="sex-2">����</label>

	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">��ϵ��ַ��</td>
	<td><textarea name="address" cols="" rows="" value="<?php echo $address;?>" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;"></textarea></td>
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
	if(nowname.indexOf(','+window.Frm.shortname.value+',')!=-1)
	{
		parent.layer.msg('�ù�Ӧ���Ѵ���,����ϸ����¼�룡', {icon:2,time:1500});
		window.Frm.shortname.select();
		return false;
	}
	else if(window.Frm.usercode.value=="")
	{
		parent.layer.msg('��Ų���Ϊ�գ�', {icon:2,time:1500});
		window.Frm.usercode.focus();
		return false;
	}
	else if(window.Frm.shortname.value=="")
	{
		parent.layer.msg('��Ӧ�����Ʋ���Ϊ�գ�', {icon:2,time:1500});
		window.Frm.shortname.focus();
		return false;
	}
	else if(window.Frm.typeb.value=="")
	{
		parent.layer.msg('��Ӧ�̷��಻��Ϊ�գ�', {icon:2,time:1500});
		window.Frm.typeb.focus();
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
