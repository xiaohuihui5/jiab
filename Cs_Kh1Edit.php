<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['shortname']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
{
//自动生成序号
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
//自动生成序号
	if($_POST['otypeb']!=$_POST['typeb'])//分类变动后,编号自动生成对应分类编号
		$query="update sys_unit set weixh=rtrim(ltrim('".$_POST['weixh']."')),usercode='".$code."',shortname=rtrim(ltrim('".$_POST['shortname']."')),name=rtrim(ltrim('".$_POST['name']."')),piny='".Get_Piny($_POST['shortname'])."',linkman=rtrim(ltrim('".$_POST['linkman']."')),phone=rtrim(ltrim('".$_POST['phone']."')),address=rtrim(ltrim('".$_POST['address']."')),typea=".$_POST['typea'].",typeb=".$_POST['typeb'].",typec=".$_POST['typec'].",typed=".$_POST['typed'].",typee=".$_POST['typee']." where id=".$_POST['eid'];
	else
		$query="update sys_unit set weixh=rtrim(ltrim('".$_POST['weixh']."')),shortname=rtrim(ltrim('".$_POST['shortname']."')),name=rtrim(ltrim('".$_POST['name']."')),piny='".Get_Piny($_POST['shortname'])."',linkman=rtrim(ltrim('".$_POST['linkman']."')),phone=rtrim(ltrim('".$_POST['phone']."')),address=rtrim(ltrim('".$_POST['address']."')),typea=".$_POST['typea'].",typeb=".$_POST['typeb'].",typec=".$_POST['typec'].",typed=".$_POST['typed'].",typee=".$_POST['typee']." where id=".$_POST['eid'];
	include('./inc/xexec.php');
	if($res)
	{
		echo "<script language=javascript>window.parent.hqlist.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
	}
}
$query="select case len(usercode) when 0 then null else usercode end,
shortname,
case len(name) when 0 then null else name end,
case len(linkman) when 0 then null else linkman end,
case len(phone) when 0 then null else phone end,
case len(address) when 0 then null else address end,
typea,typeb,typec,weixh,typed,typee from sys_unit where id=".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
if($line=sqlsrv_fetch_array($result))
{
	$usercode=$line[0];
	$shortname=$line[1];
	$name=$line[2];
	$linkman=$line[3];
	$phone=$line[4];
	$address=$line[5];
	$typea=$line[6];
	$typeb=$line[7];
	$typec=$line[8];
	$weixh=$line[9];
	$typed=$line[10];
	$typee=$line[11];
}       
sqlsrv_free_stmt($result);

$nowname=",";//保存已有名称
$query="select shortname from sys_unit where mode=2 and id<>".$_GET['eid'];
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$nowname=$nowname.$line[0].",";
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
<form name="Frm" method="POST" action="">
<input name="eid" value="<?php echo $_GET['eid'];?>" type="hidden">
<table>
<tr>
	<td align=right width="20%" height="40">客户编号：</td>
	<td><input disabled type="text" class="input-text" id="usercode" name="usercode" value="<?php echo $usercode;?>" onkeydown="if(event.keyCode==13) window.Frm.shortname.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>客户简称：</td>
	<td><input type="text" class="input-text" id="shortname" name="shortname" value="<?php echo $shortname;?>" onkeydown="if(event.keyCode==13) window.Frm.name.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">客户全称：</td>
	<td><input type="text" class="input-text" id="name" name="name" value="<?php echo $name;?>" onkeydown="if(event.keyCode==13) window.Frm.typea.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>客户类型：</td>
	<td>
		<select class="select" size="1" id="typea" name="typea" onkeydown="if(event.keyCode==13) window.Frm.typeb.focus();" style="width:80%;height:30px;">
			<option value=''>客户类型选取</option>
			<?php 
			$query='select id,fenlmc from sys_khleix where yn=1 order by bianh';
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>客户分类：</td>
	<td><input type="hidden" name="otypeb" value="<?php echo $typeb;?>"> 
		<select class="select" size="1" id="typeb" name="typeb" onkeydown="if(event.keyCode==13) window.Frm.typeb.focus();" style="width:80%;height:30px;">
			<option value=''>客户分类选取</option>
			<?php 
			$query='select id,fenlmc from sys_khfenl where yn=1 order by bianh';
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>客户线路：</td>
	<td>
		<select class="select" size="1" id="typec" name="typec" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<option value=''>客户线路选取</option>
			<?php 
			$query='select id,fenlmc from sys_khxianl where yn=1 order by bianh';
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>财务分类：</td>
	<td>
		<select class="select" size="1" id="typee" name="typee" onkeydown="if(event.keyCode==13) window.Frm.typed.focus();" style="width:80%;height:30px;">
			<option value='1'>财务分类</option>
			<?php 
			$query='select id,fenlmc from sys_cwfenl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				if($typee==$line[0])
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>打印抬头：</td>
	<td>
		<select class="select" size="1" id="typed" name="typed" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<option value=''>打印抬头选取</option>
			<?php 
			$query='select id,fenlmc from sys_dytait where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				if($typed==$line[0])
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
	<td align=right width="20%" height="40">联系人：</td>
	<td><input type="text" class="input-text" id="linkman" name="linkman" value="<?php echo $linkman;?>" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">联系电话：</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" value="<?php echo $phone;?>" onkeydown="if(event.keyCode==13) window.Frm.address.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">地址：</td>
	<td><input type="text" class="input-text" id="address"  name="address" value="<?php echo $address;?>" onkeydown="if(event.keyCode==13) window.Frm.weixh.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">微信号：</td>
	<td><input type="text" class="input-text" id="weixh"  name="weixh" value="<?php echo $weixh;?>" onkeydown="if(event.keyCode==13) sub();" style="width:80%;"></td>
</tr>
<tr>
<td align=center colspan="2" height="40">				
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
	if(nowname.indexOf(','+window.Frm.shortname.value+',')!=-1)
	{
		parent.layer.msg('该客户名称已存在,请仔细检查后录入！', {icon:2,time:1500});
		window.Frm.shortname.select();
		return false;
	}
	else if(window.Frm.shortname.value=="")
	{
		parent.layer.msg('客户简称不能为空！', {icon:2,time:1500});
		window.Frm.shortname.focus();
		return false;
	}

	else if(window.Frm.typea.value=="")
	{
		parent.layer.msg('客户类型不能为空！', {icon:2,time:1500});
		window.Frm.typea.focus();
		return false;
	}

	else if(window.Frm.typeb.value=="")
	{
		parent.layer.msg('客户分类不能为空！', {icon:2,time:1500});
		window.Frm.typeb.focus();
		return false;
	}
	else if(window.Frm.typec.value=="")
	{
		parent.layer.msg('客户线路不能为空！', {icon:2,time:1500});
		window.Frm.typec.focus();
		return false;
	}
	else if(window.Frm.typed.value=="")
	{
		parent.layer.msg('打印抬头不能为空！', {icon:2,time:1500});
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
window.Frm.usercode.focus();
</script>
