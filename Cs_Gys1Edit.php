<?php
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
if (isset($_POST['shortname']))
{
//自动生成序号
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
//自动生成序号
	if($_POST['otypeb']!=$_POST['typeb'])//分类变动后,编号自动生成对应分类编号
		$query="update sys_unit set usercode='".$code."',shortname='".$_POST['shortname']."',name='".$_POST['name']."',piny='".Get_Piny($_POST['shortname'])."',linkman='".$_POST['linkman']."',phone='".$_POST['phone']."',address='".$_POST['address']."',typea=".$_POST['typea'].",typeb=".$_POST['typeb']." where id=".$_POST['eid'];
	else
		$query="update sys_unit set shortname='".$_POST['shortname']."',name='".$_POST['name']."',piny='".Get_Piny($_POST['shortname'])."',linkman='".$_POST['linkman']."',phone='".$_POST['phone']."',address='".$_POST['address']."',typea=".$_POST['typea'].",typeb=".$_POST['typeb']." where id=".$_POST['eid'];
		$query=str_replace(",#","",$query);
		include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>window.parent.hqlist.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
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
$nowname=",";//保存已有名称
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
<title>修改供应商资料</title>
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
	<td align=right width="20%" height="40"><span class="c-red">*</span>编号：</td>
	<td><input disabled type="text" class="input-text" id="usercode" name="usercode" value="<?php echo $usercode;?>" onkeydown="if(event.keyCode==13) window.Frm.shortname.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>供应商名称：</td>
	<td><input type="text" class="input-text" id="shortname" name="shortname" value="<?php echo $shortname;?>" onkeydown="if(event.keyCode==13) sub();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">联系人：</td>
	<td><input type="text" class="input-text" id="linkman" name="linkman" value="<?php echo $linkman;?>" onkeydown="if(event.keyCode==13) window.Frm.phone.select();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">联系电话：</td>
	<td><input type="text" class="input-text" id="phone"  name="phone" value="<?php echo $phone;?>" onkeydown="if(event.keyCode==13) window.Frm.typea.focus();" style="width:80%;"></td>
</tr>
<tr>
	<td align=right width="20%" height="40">结算方式：</td>
	<td>
		<select class="select" size="1" id="typea" name="typea" style="width:80%;height:30px;">
		<option value="1" <?php echo $typea==1?selected:"";?>>现金</option>
		<option value="2" <?php echo $typea==2?selected:"";?>>月结</option>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="20%" height="40"><span class="c-red">*</span>所属分类：</td>
	<td><input type="hidden" name="otypeb" value="<?php echo $typeb;?>">
		<select class="select" size="1" id="typeb" name="typeb" onkeydown="if(event.keyCode==13) sub();" style="width:80%;height:30px;">
			<option value=''>供应商分类选取</option>
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
	<td align=right width="20%" height="40">禁用：</td>
	<td>
		<input  type="radio" id="yn"    name="yn" value="1" <?php echo $yn==1?"checked":"";?> >
		<label for="sex-1">启用</label>
		<input type="radio" id="yn"   name="yn" value="0" <?php echo $yn==0?"checked":"";?> >
		<label for="sex-2">禁用</label>

	</td>
</tr>
<tr>
	<td align=right width="20%" height="40">联系地址：</td>
	<td><textarea name="address" cols="" rows="" value="<?php echo $address;?>" class="textarea" onkeydown="if(event.keyCode==13)sub();" style="width:80%;"></textarea></td>
</tr>
<tr><td align=center colspan="2" height="10"></td></tr>
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
		parent.layer.msg('该供应商已存在,请仔细检查后录入！', {icon:2,time:1500});
		window.Frm.shortname.select();
		return false;
	}
	else if(window.Frm.usercode.value=="")
	{
		parent.layer.msg('编号不能为空！', {icon:2,time:1500});
		window.Frm.usercode.focus();
		return false;
	}
	else if(window.Frm.shortname.value=="")
	{
		parent.layer.msg('供应商名称不能为空！', {icon:2,time:1500});
		window.Frm.shortname.focus();
		return false;
	}
	else if(window.Frm.typeb.value=="")
	{
		parent.layer.msg('供应商分类不能为空！', {icon:2,time:1500});
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
