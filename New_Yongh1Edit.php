<?php
require('./inc/xhead.php');
if (isset($_POST['name']))
{
	if($_POST['passwd']!=$_POST['oldpasswd'])
		$PWD=md5($_POST['passwd']);
	else
		$PWD=$_POST['passwd'];
	$query="update sys_user set userid='".$_POST['userid']."',passwd='".$PWD."',name='".$_POST['name']."',sex=".$_POST['sex'].",bumid=".$_POST['bumid'].",zhiw='".$_POST['zhiw']."',phone='".$_POST['phone']."',beiz='".$_POST['beiz']."',yn=".$_POST['yn']." where empid=".$_POST['eid'];
	include('./inc/xexec.php');
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
	}
}
$query='select name,userid,passwd,sex,bumid,case len(zhiw) when 0 then null else zhiw end,case len(phone) when 0 then null else phone end,case len(beiz) when 0 then null else beiz end,yn from sys_user where empid='.$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$name=$line[0];
	$userid=$line[1];
	$passwd=$line[2];
	$sex=$line[3];
	$bumid=$line[4];
	$zhiw=$line[5];
	$phone=$line[6];
	$beiz=$line[7];
	$yn=$line[8];
}       
sqlsrv_free_stmt($result);
echo $quanx_mc[0].'<br>'.$quanx_mc[1];
?>
<html>
<head>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body >
<form name="Frm" method="POST" action="">
<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��Ա������</td>
	<td><input type="text" class="input-text"  id="name" name="name" value="<?php echo $name;?>" onkeydown="if(event.keyCode==13) window.Frm.userid.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�Ա�</td>
	<td><input  type="radio" id="sex"  name="sex" value="0" <?php echo $sex==0?"checked":"";?>>
		<label for="sex-1">�� </label>
		<input type="radio" id="sex" name="sex" value="1"  <?php echo $sex==1?"checked":"";?>>
		<label for="sex-2">Ů</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��¼�ʺţ�</td>
	<td><input type="text" class="input-text" id="userid"  name="userid" value="<?php echo $userid;?>" onkeydown="if(event.keyCode==13) window.Frm.passwd.select();"  onkeyup="window.Frm.passwd.value=window.Frm.userid.value" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>��ʼ���ܣ�</td>
	<td><input type="password" class="input-text"  id="passwd" name="passwd"  value="<?php echo $passwd;?>" onkeydown="if(event.keyCode==13) window.Frm.zhiw.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">&nbsp;��λְ��</td>
	<td><input type="text" class="input-text"  id="zhiw"  name="zhiw" type="text" value="<?php echo $zhiw;?>" onkeydown="if(event.keyCode==13) window.Frm.bumid.focus();" style="width:80%;height:30px;"></td>
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
				if($line[0]==$bumid)
					echo '<option selected value=',$line[0],'>',$line[1],'</option>';
				else
					echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">&nbsp;��ϵ�绰��</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" type="text" value="<?php echo $phone;?>" onkeydown="if(event.keyCode==13)window.Frm.beiz.select();" style="width:80%;height:30px;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>�Ƿ�ͣ�ã�</td>
	<td><input type="radio" id="yn" name="yn" value="1"  <?php echo $yn==1?"checked":"";?> >
		<label for="sex-1">��</label>
		<input type="radio" id="yn" name="yn" value="0"  <?php echo $yn==0?"checked":"";?> >
		<label for="sex-2">��</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="100">��ע��</td>
	<td><textarea name="beiz" cols="" rows="" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;height:80px;"><?php echo $beiz;?></textarea></td>
</tr>

<tr>
<td align=center colspan="2" height="40">				
	<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
	<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
</td>
</tr>
</table>
</form>
</center>
</div>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.Frm.name.value=="")
		layer.msg('�û���������Ϊ��!',{shade:false});
	else if(window.Frm.bumid.value=="")
		layer.msg('�û����ڲ��Ų���Ϊ��!',{shade:false});
	else if(window.Frm.userid.value=="")
		layer.msg('�û��˺Ų���Ϊ��!',{shade:false});
	else{
		
		window.Frm.submit();	

	}

}
window.Frm.name.focus();

function exit()
{
	parent.layer.closeAll();
}

</script>


