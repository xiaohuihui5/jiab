<?php
require('./inc/xhead.php');
if (isset($_POST['fenlmc']))
{
	$query="insert into sys_cpxfl(bianh,fenlmc,typeb,yn) values(rtrim(ltrim('".$_POST['bianh']."')),rtrim(ltrim('".$_POST['fenlmc']."')),".$_POST['typeb'].",".$_POST['yn'].")";
	include("./inc/xexec.php");
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();//parent.layer.msg('操作成功！',{icon:1,time:1500});//parent.layer.closeAll();</script>";//提示成功退出
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>二级分类--增加分类</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="" action="" enctype="multipart/form-data">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>编号：</td>
	<td colspan="2"><input type="text" class="input-text" id="bianh" name="bianh" onkeydown="if(event.keyCode==13) window.Frm.fenlmc.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>二级分类：</td>
	<td colspan="2"><input type="text" class="input-text" id="fenlmc" name="fenlmc" onkeydown="if(event.keyCode==13) window.Frm.dafl.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>归属一类：</td>
	<td colspan="2">
			<select class="select" size="1" id="typeb" name="typeb" style="width:80%;height:32px;">
			<option value=''>选取归属一级分类</option>
				<?php 
				$query='select id,bianh+fenlmc from sys_cpdfl where yn=1 order by bianh';
				$result=sqlsrv_query($conn,$query);
				while($line=sqlsrv_fetch_array($result))
				{
						echo '<option value=',$line[0],'>',$line[1],'</option>';
				}       
				sqlsrv_free_stmt($result);
				?>
			</select>
			</span> 
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">禁用：</td>
	<td colspan="2">
		<input  type="radio" id="yn"    name="yn" value="1" checked>
		<label for="sex-1">启用</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="yn"   name="yn" value="0" >
		<label for="sex-2">禁用</label>
	</td>
</tr>
<tr>
<td align=center colspan="3" height="40">				
	<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
	<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
</td>
</tr>
</table>
</form>

</body>
</html>
<script lanuage="javascript">
$("input[type=text],.select-box,textarea").css("width","80%");
function sub()
{
	if(window.Frm.bianh.value=="")
	{
		parent.layer.msg('编号不能为空！', {icon:2,time:1500});
		window.Frm.bianh.focus();
		return false;
	}
	else if(window.Frm.fenlmc.value=="")
	{
		parent.layer.msg('二级分类不能为空！', {icon:2,time:1500});
		window.Frm.fenlmc.focus();
		return false;
	}
	else if(window.Frm.typeb.value=="")
	{
		parent.layer.msg('归属一级分类不能为空！', {icon:2,time:1500});
		window.Frm.dafl.focus();
		return false;
	}
	else
		window.Frm.submit(); 
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.bianh.focus();
</script>
