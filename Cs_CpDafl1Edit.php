<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<?php
require('./inc/xhead.php');
if(isset($_POST['fenlmc']))
{
	$query="update sys_cpxfl set bianh=rtrim(ltrim('".$_POST['bianh']."')),fenlmc=rtrim(ltrim('".$_POST['fenlmc']."')),yn=".$_POST['yn'].",typeb=".$_POST['typeb']." where id=".$_GET['eid'];
	include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('�����ɹ���',{icon:1,time:1500});parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
	}
}
$query="select case len(bianh) when 0 then null else bianh end,case len(fenlmc) when 0 then null else fenlmc end,typeb from sys_cpxfl where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$bianh=$line[0];
	$fenlmc=$line[1];
	$typeb=$line[2];
}   
sqlsrv_free_stmt($result);
//������ơ�����ظ�
$nowname=",";
$query="select fenlmc,bianh from sys_cpxfl where id<>".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$nowname=$nowname.$line[0].",".$line[1].",";
}       
sqlsrv_free_stmt($result);
//������ơ�����ظ�
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��������--�޸ķ�����Ϣ</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >


	<form name="Frm" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>���:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
				<input type="text" class="input-text" id="bianh" name="bianh" value="<?php echo $bianh;?>" onkeydown="if(event.keyCode==13) window.Frm.fenlmc.select();">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>��������:</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input type="text" class="input-text"  id="fenlmc"  name="fenlmc" value="<?php echo $fenlmc;?>" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" >
				
		</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>����һ��:</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select class="select" size="1" id="typeb" name="typeb">
				<option value=''>ѡȡ����һ��</option>
					<?php 
					$query='select id,bianh+fenlmc from sys_cpdfl where yn=1 order by bianh';
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
				</span> </div>
		</div>
			<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>���ã�</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input  type="radio" id="yn"    name="yn" value="1" checked>
					<label for="sex-1">����</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="yn"   name="yn" value="0" >
					<label for="sex-2">����</label>
				</div>
			
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
			</div>
		</div>
	</form>
</body>
</html>
<script lanuage="javascript">
$("input[type=text],.select-box,textarea").css("width","80%");

function sub()
{
	if(window.Frm.bianh.value=="")
		layer.msg('��Ų���Ϊ��!',{shade:false});
	else if(window.Frm.fenlmc.value=="")
		layer.msg('�����������Ʋ���Ϊ��!',{shade:false});
	else if(window.Frm.typeb.value=="")
		layer.msg('��ѡȡһ������!',{shade:false});
	else
		window.Frm.submit(); 
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.bianh.focus();
</script>
