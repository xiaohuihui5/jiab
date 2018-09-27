<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
require("./inc/resize_img.php");//生成缩略图
if (isset($_POST['mc']))
{
	$_POST['gg2']=$_POST['gg2']==""?"1":"".$_POST['gg2']."";
	$_POST['typea']=$_POST['typea']==""?"1":"".$_POST['typea']."";
//自动生成序号
	$query="select bianh,typeb from sys_cpxfl where id=".$_POST['typec'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$flbh=$line[0];
	$upfenl=$line[1];
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
		if($_POST['otypec']!=$_POST['typec'])//分类变动后,编号自动生成对应分类编号
			$query="update sys_cp set typeb=".$upfenl.",bh=rtrim(ltrim('".$code."')),mc=rtrim(ltrim('".$_POST['mc']."')),piny='".Get_Piny($_POST['mc'])."',dw=rtrim(ltrim('".$_POST['dw']."')),gg=rtrim(ltrim('".$_POST['gg']."')),huansz=rtrim(ltrim(".$_POST['gg2'].")),typec=".$_POST['typec'].",typea=".$_POST['typea'].",yn=".$_POST['yn'].",miaos=rtrim(ltrim('".$_POST['miaos']."')),img='".$uploadfile.'_'.$kuozm."' where id=".$_POST['eid'];
		else
			$query="update sys_cp set typeb=".$upfenl.",mc=rtrim(ltrim('".$_POST['mc']."')),piny='".Get_Piny($_POST['mc'])."',dw=rtrim(ltrim('".$_POST['dw']."')),gg=rtrim(ltrim('".$_POST['gg']."')),huansz=rtrim(ltrim(".$_POST['gg2'].")),typec=".$_POST['typec'].",typea=".$_POST['typea'].",yn=".$_POST['yn'].",miaos=rtrim(ltrim('".$_POST['miaos']."')),img='".$uploadfile.'_'.$kuozm."' where id=".$_POST['eid'];
		include("./inc/xexec.php");
		$resizeimage = new resizeimage("upfile/cpimg/".$uploadfile.'_'.$kuozm,"224","300","0","upfile/cpimg/".$uploadfile.$kuozm);
	}
	else
	{
		if($_POST['otypec']!=$_POST['typec'])//分类变动后,编号自动生成对应分类编号
			$query="update sys_cp set typeb=".$upfenl.",bh=rtrim(ltrim('".$code."')),mc=rtrim(ltrim('".$_POST['mc']."')),piny='".Get_Piny($_POST['mc'])."',dw=rtrim(ltrim('".$_POST['dw']."')),gg=rtrim(ltrim('".$_POST['gg']."')),huansz=rtrim(ltrim(".$_POST['gg2'].")),typec=".$_POST['typec'].",typea=".$_POST['typea'].",yn=".$_POST['yn']." where id=".$_POST['eid'];
		else
			$query="update sys_cp set typeb=".$upfenl.",mc=rtrim(ltrim('".$_POST['mc']."')),piny='".Get_Piny($_POST['mc'])."',dw=rtrim(ltrim('".$_POST['dw']."')),gg=rtrim(ltrim('".$_POST['gg']."')),huansz=rtrim(ltrim(".$_POST['gg2'].")),typec=".$_POST['typec'].",typea=".$_POST['typea'].",yn=".$_POST['yn']." where id=".$_POST['eid'];
			include("./inc/xexec.php");
	}
	if($res)
	{
		echo "<script language=javascript>window.parent.hqlist.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
	}
}
$query="select 0,mc,typec,case len(dw) when 0 then null else dw end,gg,huansz,yn,img,miaos,typea from sys_cp where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$mc=$line[1];
	$typec=$line[2];
	$dw=$line[3];
	$gg=$line[4];
	$huansz=$line[5];
	$yn=$line[6];
	$img=$line[7];
	$miaos=$line[8];
	$typea=$line[9];
}       
sqlsrv_free_stmt($result);
//解决名称、编号重复
$nowname=",";
$query="select mc+dw+gg from sys_cp where id<>".$_GET['eid'];
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
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >
<form name="Frm" method="POST" action="" enctype="multipart/form-data">
<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
<input name="otypec" value="<?php echo $typec;?>" type="hidden">
<table>
<tr>
	<td align=right width="20%" height="35"><span class="c-red">*</span>产品名称：</td>
	<td colspan="2"><input type="text" class="input-text" id="mc" name="mc" value="<?php echo $mc;?>" onkeydown="if(event.keyCode==13) window.Frm.dw.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="35"><span class="c-red">*</span>单位：</td>
	<td colspan="2"><input type="text" class="input-text" id="dw" name="dw" value="<?php echo $dw;?>" onkeydown="if(event.keyCode==13) window.Frm.gg.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="35">规格：</td>
	<td colspan="2"><input type="text" class="input-text" id="gg" name="gg" value="<?php echo $gg;?>" onkeydown="if(event.keyCode==13) window.Frm.gg2.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="35">换算：</td>
	<td colspan="2"><input type="text" class="input-text" id="gg2" name="gg2" value="<?php echo $huansz;?>" onkeydown="if(event.keyCode==13) window.Frm.typec.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="35"><span class="c-red">*</span>二级分类：</td>
	<td colspan="2">
		<select class="select" size="1" id="typec" name="typec" onkeydown="if(event.keyCode==13) window.Frm.laiy.focus();" style="width:80%;height:30px;">
			<?php 
			$query='select id,fenlmc from sys_cpxfl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				if($typec==$line[0])
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
	<td align=right width="20%" height="35"><span class="c-red">*</span>生产分类：</td>
	<td colspan="2">
		<select class="select" size="1" id="typea" name="typea" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
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
	<td align=right width="20%" height="35">禁用：</td>
	<td colspan="2">
		<input  type="radio" id="yn" name="yn" value="1" <?php echo $yn==1?"checked":"";?> >
		<label for="sex-1">启用</label>
		<input type="radio" id="yn" name="yn" value="0" <?php echo $yn==0?"checked":"";?> >
		<label for="sex-2">禁用</label>

	</td>
</tr>
<tr>
	<td align=right width="20%" height="35">描述：</td>
	<td width="50%">
		<textarea name="miaos" cols="80" rows="88" value="<?php echo $miaos;?>" class="textarea" style="width:100%;height:80px;"><?php echo $miaos;?></textarea>
	</td>
	<td align=left>
		<IMG border=0 width='80' height='80' src=upfile/cpimg/<?php echo $img==0?"wutp.jpg":$img;?> style="align:left;">
	</td>
</tr>
<tr>
	<td align=right width="20%" height="35">上传图片：</td>
	<td colspan="2"><input name="upfile" type="file" size="32" style="width:80%;height:30px;"></td>
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
<script lanuage="javascript">
function sub()
{
	var nowname="<?php echo $nowname;?>";
	if(nowname.indexOf(','+window.Frm.mc.value+window.Frm.dw.value+window.Frm.gg.value+',')!=-1)
	{
		parent.layer.msg('该产品名称已存在,请仔细检查后录入！', {icon:2,time:1500});
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
	else{
		window.Frm.submit();
       
       }
}
function exit()
{
	parent.layer.closeAll();
}
window.Frm.mc.focus();
</script>
