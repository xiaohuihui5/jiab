<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_cpxfl set yn=yn^1 where id=".$_POST['delrow'];
	require('./inc/xexec.php');
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
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
	$TJ=" and (xfl.fenlmc like '%".$_POST['cxtj']."%' or dfl.fenlmc like '%".$_POST['cxtj']."%') ";

$query="select typec,count(*) from sys_cp where yn=1 group by typec";//每个分类包含的产品数
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
	$dat[$line[0]]=$line[1];
sqlsrv_free_stmt($result);

$query="select 0,xfl.id,dfl.fenlmc,xfl.bianh,xfl.fenlmc,'',case xfl.yn when 1 then '启用' else '<font color=gray>停用' end from sys_cpxfl xfl,sys_cpdfl dfl where xfl.typeb=dfl.id ".$TJ." order by xfl.bianh";
$result=sqlsrv_query($conn,$query);
$row=0;
while($line=sqlsrv_fetch_array($result))
{
	$row++;
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="10%"  height=20><?php echo $row;?></td>
	<td width="25%" onclick="dis(<?php echo $line[1];?>)" ><?php echo $line[2];?></td>
	<td width="10%" onclick="dis(<?php echo $line[1];?>)" ><?php echo $line[3];?></td>
	<td width="25%" onclick="dis(<?php echo $line[1];?>)" ><?php echo $line[4];?></td>
	<td width="20%" align="center" onclick="dis(<?php echo $line[1];?>)"><?php echo isset($dat[$line[1]])?$dat[$line[1]]:"";?></td>
	<td width="6%" align="center"><a href="javascript:yn(<?php echo $line[1];?>)"><?php echo $line[6];?></td>
	<td width="4%" align="center" onclick="sel(<?php echo $line[1];?>)"><img border=0 src=im/xiug.png alt=修改此单></td>
	</tr>
<?php 
	if(isset($_POST['selid']) and $_POST['selid']!="" and $line[1]==$_POST['selid'])//列出所包含分类的产品信息
	{
	$i=0;
	$aquery="select 1,cp.bh,cp.mc,cp.gg,cp.dw from sys_cp cp where cp.yn=1 and cp.typec=".$line[1];
	$aresult=sqlsrv_query($conn,$aquery);
	while($aline=sqlsrv_fetch_array($aresult))
	{
		$i++;
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)" bgcolor="#ffffff">
<td><input class="input-text" readonly value="'.$i.'" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="'.$aline[1].'" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="'.$aline[2].'" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="'.$aline[3].'" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="'.$aline[4].'" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td ><input class="input-text" readonly value="" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td></tr>';
	}
	sqlsrv_free_stmt($aresult);
	}
}
sqlsrv_free_stmt($result);
?>
</table>
</form>
</body>
<script language=javascript>
function sel(id)
{	
	//window.Frm.scroll.value=document.body.scrollTop;
	//window.Frm.submit();
	layer_show3("二级分类修改","<?php echo $xiam;?>Edit.php?eid="+id,"780","700","parent");//最后一个是给标识符  需要父级打开就给  不然就空
}
function dis(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.selid.value=id;
	window.Frm.submit();
}
</script>
<script defer="defer">setscroll();</script>