<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
require("./inc/resize_img.php");//生成缩略图
if (isset($_POST['xis']))
{
	$query="update sys_cp set xis=".$_POST['xis']." where id=".$_POST['eid'];
	include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
	}
}
$query="select xis,mc,typea,dw from sys_cp where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$mc=$line[1];
	$xis=$line[0];
	$typea=$line[2];
	$dw=$line[3];
}       
sqlsrv_free_stmt($result);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
<form name="Frm" method="POST" action="" enctype="multipart/form-data">
<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
<table>
<tr>
	<td align=right width="20%" height="35">生产分类：</td>
	<td colspan="2">
		<select disabled class="select" size="1" id="typea" name="typea" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<?php 
			$query='select id,fenlmc from sys_cpyfl where yn=1 order by id';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($typea==$line[0])
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
	<td align=right width="20%" height="35">产品名称：</td>
	<td colspan="2"><input disabled type="text" class="input-text" id="mc" name="mc" value="<?php echo $mc;?>" onkeydown="if(event.keyCode==13) window.Frm.dw.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="35">单位：</td>
	<td colspan="2"><input disabled type="text" class="input-text" id="dw" name="dw" value="<?php echo $dw;?>" onkeydown="if(event.keyCode==13) window.Frm.xis.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="35"><span class="c-red">*</span>加工系数：</td>
	<td colspan="2"><input type="text" class="input-text" id="xis" name="xis" value="<?php echo $xis;?>" onkeydown="if(event.keyCode==13) sub();" style="width:80%;"></td>
</tr>
<tr>
	<td colspan=3 height="35"><span class="c-red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提醒：加工系数为每1公斤生产分类能生产出多少产品品名！</span></td>
</tr>
<tr>
<td align=center colspan="3" height="35">				
	<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
	<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
</td>
</tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	window.Frm.submit();
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.xis.focus();
</script>
