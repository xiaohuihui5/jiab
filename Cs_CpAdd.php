<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
require("./inc/resize_img.php");//生成缩略图
if (isset($_POST['mc']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
{
	$_POST['gg2']=$_POST['gg2']==""?"1":"".$_POST['gg2']."";
	$_POST['typea']=$_POST['typea']==""?"1":"".$_POST['typea']."";
//自动生成序号
	$query="select bianh from sys_cpxfl where id=".$_POST['typec'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$flbh=$line[0];
	sqlsrv_free_stmt($result);
	$query="select max(right(bh,4))+1 from sys_cp where typec=".$_POST['typec'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	if($line[0]!="")
	{
		$code=$flbh.substr("000".$line[0],-4);
	}
	else
		$code=$flbh."0001";
	sqlsrv_free_stmt($result);
//自动生成序号
	$uploaddir='upfile/cpimg/';//存放目录
	$uploadfile=date('YmdHis');//文件名
	$kuozm='.'.array_pop(explode('.',basename($_FILES['upfile']['name'])));//扩展名
	if(move_uploaded_file($_FILES['upfile']['tmp_name'],$uploaddir.$uploadfile.'_'.$kuozm))
	{
		$query="insert into sys_cp(yn,bh,mc,typeb,typec,typea,dw,gg,huansz,piny,miaos,img) select 1,'".$code."',rtrim(ltrim('".$_POST['mc']."')),typeb,".$_POST['typec'].",".$_POST['typea'].",rtrim(ltrim('".$_POST['dw']."')),rtrim(ltrim('".$_POST['gg']."')),rtrim(ltrim(".$_POST['gg2'].")),'".Get_Piny($_POST['mc'])."',rtrim(ltrim('".$_POST['miaos']."')),'".$uploadfile.$kuozm."' from sys_cpxfl where id=".$_POST['typec'];
		include("./inc/xexec.php");
		$resizeimage = new resizeimage("upfile/cpimg/".$uploadfile.'_'.$kuozm,"224","300","0","upfile/cpimg/".$uploadfile.$kuozm);
	}
	else
	{
		$query="insert into sys_cp(yn,bh,mc,typeb,typec,typea,dw,gg,huansz,piny) select 1,'".$code."',rtrim(ltrim('".$_POST['mc']."')),typeb,".$_POST['typec'].",".$_POST['typea'].",rtrim(ltrim('".$_POST['dw']."')),rtrim(ltrim('".$_POST['gg']."')),rtrim(ltrim(".$_POST['gg2'].")),'".Get_Piny($_POST['mc'])."' from sys_cpxfl where id=".$_POST['typec'];
		include("./inc/xexec.php");
	}
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();//parent.layer.msg('操作成功！',{icon:1,time:1500});//parent.layer.closeAll();</script>";//提示成功退出

}
//解决名称、编号重复
$nowname=",";
$query="select mc+dw+gg from sys_cp where yn=1";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$nowname=$nowname.$line[0].",";
}       
sqlsrv_free_stmt($result);
//解决名称、编号重复
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="" action="" enctype="multipart/form-data">
<table>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>产品名称：</td>
	<td colspan="2"><input type="text" class="input-text" id="mc" name="mc" onkeydown="if(event.keyCode==13) window.Frm.dw.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>单位：</td>
	<td colspan="2"><input type="text" class="input-text" id="dw" name="dw" onkeydown="if(event.keyCode==13) window.Frm.gg.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">规格：</td>
	<td colspan="2"><input type="text" class="input-text" id="gg" name="gg" onkeydown="if(event.keyCode==13) window.Frm.gg2.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">换算：</td>
	<td colspan="2"><input type="text" class="input-text" id="gg2" name="gg2" onkeypress="check(this,2)" onkeydown="if(event.keyCode==13) sub();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>二级分类：</td>
	<td colspan="2">
		<select class="select" size="1" id="typec" name="typec" onkeydown="if(event.keyCode==13) window.Frm.typea.focus();" style="width:80%;height:30px;">
			<option value=''>二级分类选取</option>
			<?php 
			$query='select id,fenlmc from sys_cpxfl where yn=1 order by bianh';
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
	<td align=right width="20%" height="40">生产分类：</td>
	<td colspan="2">
		<select class="select" size="1" id="typea" name="typea" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<option value=''>生产分类选取</option>
			<?php 
			$query='select id,fenlmc from sys_cpyfl where yn=1 order by id';
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
	<td align=right width="20%" height="40">禁用：</td>
	<td colspan="2">
		<input  type="radio" id="yn"    name="yn" value="1" checked>
		<label for="sex-1">启用</label>&nbsp;&nbsp;&nbsp;
		<input type="radio" id="yn"   name="yn" value="0" >
		<label for="sex-2">禁用</label>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">描述：</td>
	<td width="50%">
		<textarea name="miaos" cols="80" rows="88" class="textarea" style="width:100%;height:80px;"></textarea>
	</td>
	<td align=left>
		<IMG border=0 width='80' height='80' src=upfile/cpimg/<?php echo $img==0?"wutp.jpg":$img;?> style="align:left;">
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">上传图片：</td>
	<td colspan="2"><input name="upfile" type="file" size="32" style="width:80%;height:30px;"></td>
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
	var nowname="<?php echo $nowname;?>";
	if(nowname.indexOf(','+window.Frm.mc.value+window.Frm.dw.value+window.Frm.gg.value+',')!=-1)
	{
		parent.layer.msg('该产品名称+单位+规格已存在,请仔细检查后录入！', {icon:2,time:1500});
		window.Frm.mc.select();
		return false;
	}
	else if(window.Frm.mc.value=="")
	{
		parent.layer.msg('产品名称不能为空！', {icon:2,time:1500});
		window.Frm.mc.focus();
		return false;
	}
	else if(window.Frm.dw.value=="")
	{
		parent.layer.msg('单位不能为空！', {icon:2,time:1500});
		window.Frm.dw.focus();
		return false;
	}
	else if(window.Frm.typec.value=="")
	{
		parent.layer.msg('二级分类不能为空！', {icon:2,time:1500});
		window.Frm.typec.focus();
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
window.Frm.mc.focus();
</script>
