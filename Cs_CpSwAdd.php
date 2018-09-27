<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['xiaofl']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
{
	$query="update sys_cp set shuiw=".$_POST['shuiw']." where xiaofl in(".$_POST['xiaofl'].")";
	include("./inc/xexec.php");
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.msg('操作成功！',{icon:1,time:1500});parent.layer.closeAll();</script>";//提示成功退出

}
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
<tr><td height="40"></td><td></td></tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>二级分类：</td>
	<td colspan="2">
		<select class="select" size="1" id="xiaofl" name="xiaofl" style="width:80%;height:30px;">
			<option value=''>二级分类选取</option>
			<?php 
			$query='select id,bianh+fenlmc from sys_cpxiaofl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['xiaofl']==$line[0])
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>税务分类：</td>
	<td colspan="2">
		<select class="select" size="1" id="shuiw" name="shuiw" style="width:80%;height:30px;">
			<option value=''>税务分类选取</option>
			<?php 
			$query='select id,fenlmc from sys_cpsw where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['shuiw']==$line[0])
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
function sub()
{
	if(window.Frm.xiaofl.value=="")
	{
		parent.layer.msg('二级分类不能为空！', {icon:2,time:1500});
		window.Frm.xiaofl.focus();
		return false;
	}
	else if(window.Frm.shuiw.value=="")
	{
		parent.layer.msg('税务分类不能为空！', {icon:2,time:1500});
		window.Frm.shuiw.focus();
		return false;
	}
	else
		window.Frm.submit();
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.xiaofl.focus();
</script>
