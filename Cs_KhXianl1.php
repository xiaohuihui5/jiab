<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
require("./inc/xsys_lib.php");
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_khxianl set yn=yn^1 where id=".$_POST['delrow'];
	require('./inc/xexec.php');
}
if(isset($_POST['fenlmc']) || $_POST['fenlmc']!="")
{
	$query="insert into sys_khxianl(bianh,fenlmc,yn) values('".$_POST['bianh']."','".$_POST['fenlmc']."',1)";
	require("./inc/xexec.php");
}
$ed_row=0;
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
	if(isset($_POST['fenlmc_']))
	{
	$query="update sys_khxianl set bianh='".$_POST['bianh_']."',fenlmc='".$_POST['fenlmc_']."' where id=".$_POST['edtrow'];
	require("./inc/xexec.php");	
	$ed_row=0;
	}
	else $ed_row=$_POST['edtrow'];
}
?>
<head><link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
</head>
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:'';?>">
<input type="hidden" name="edtrow" value="<?php echo $ed_row;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="selid" value="">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<table border="0" class="tableborder3">
<?php 
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ=" and xl.fenlmc like '%".$_POST['cxtj']."%' ";

$query="select typec,count(*) from sys_unit where yn=1 and mode=2 group by typec";//每个分类包含的客户数
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
	$dat[$line[0]]=$line[1];
sqlsrv_free_stmt($result);

$query="select 0,xl.id,xl.bianh,xl.fenlmc,'',case xl.yn when 1 then '启用' else '<font color=gray>停用' end from sys_khxianl xl where xl.id>0 ".$TJ." order by xl.bianh";
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
	if($ed_row==$line[1])
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="10%"  height=20><?php echo $row;?></td>
	<td width="20%"><input onkeydown="if(event.keyCode==13)window.Frm.fenlmc_.select();" name="bianh_" value="<?php echo $line[2];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
	<td width="50%"><input onkeydown="if(event.keyCode==13)sav();" name="fenlmc_" value="<?php echo $line[3];?>" style="height:100%;width:100%;background-color: #C4D2EA;"></td>
	<td width="10%" align=center><?php echo $dat[$line[1]];?></td>                     
	<td width="5%" align="center"><a href="javascript:can()"><img border=0 src="im/fanh.png" alt="取消修改此行数据"></a></td>
	<td width="5%" align="center"><a href="javascript:sav()"><img border=0 src="im/baoc.png" alt="把修改后数据保存"></a></td>
	</tr>
<?php 
	}
	else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="10%"  height=20><?php echo $row;?></td>
	<td onclick="dis(<?php echo $line[1];?>)" width="20%"><?php echo $line[2];?></td>
	<td onclick="dis(<?php echo $line[1];?>)" width="50%"><?php echo $line[3];?></td>
	<td onclick="dis(<?php echo $line[1];?>)" width="10%" align=center><?php echo isset($dat[$line[1]])?$dat[$line[1]]:"";?></td>
	<td width="5%" align="center"><a href="javascript:yn(<?php echo $line[1];?>)"><?php echo $line[5];?></td>
	<td width="5%" align="center"><a href="javascript:mod(<?php echo $line[1];?>,0)"><img border=0 src=im/xiug.png alt=修改此单></a></td>
	</tr>
<?php 
	}
	if(isset($_POST['selid']) and $_POST['selid']!="" and $line[1]==$_POST['selid'])//列出所包含分类的产品信息
	{
	$aquery="select 1,usercode+shortname from sys_unit where yn=1 and mode=2 and typec=".$line[1];
	$aresult=sqlsrv_query($conn,$aquery);
	while($aline=sqlsrv_fetch_array($aresult))
		echo '<tr bgcolor="#F5FAFE"><td colspan=6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$aline[1].'&nbsp;&nbsp;</td></tr>';
	sqlsrv_free_stmt($aresult);
	}

}
sqlsrv_free_stmt($result);
?>
</table>
</form>
</body>
<script language=javascript>
	window.Frm.bianh_.select();
function dis(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.selid.value=id;
	window.Frm.submit();
}
</script>
<script defer="defer">setscroll();</script>
