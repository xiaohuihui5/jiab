<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(69);//取得菜单权限
if(isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="update sys_maozpd set lx=-1*lx,caozy='".$_SESSION['xuname']."' where id=".$_POST['delrow']." and lx>0";
	include("./inc/xexec.php");
}
$delrow=0;
if(isset($_POST['pinz']))
{
	$query="insert into sys_maozpd(rq,pinz,tous,zl,caozy,lx) values('".$_POST['dt1']."',".$_POST['pinz'].",".$_POST['tous'].",".$_POST['zl'].",'".$_SESSION['xuname']."',1)";
	include("./inc/xexec.php");
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {parent.Add();}}</script>
</head>
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="<?php echo $delrow;?>">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<table border="0" class="tableborder3">
<?php 
$TJ1="";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$TJ=" and sj.lx=1 and sj.rq='".$_POST['dt1']."'";
}
else
	$TJ=" and sj.lx=1 and sj.rq<='".date('Y-m-d')."'";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and cp.mc like '%".$_POST['cxtj']."%' ";
$row=0;
$query="select sj.id,convert(varchar(10),sj.rq,120),cp.mc,sj.tous,sj.zl from sys_maozpd sj,sys_cp cp where sj.pinz=cp.id ".$TJ." order by sj.rq desc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="15%" align="center"><?php echo $line[1];?></td>
		<td width="20%" align="center"><?php echo $line[2];?></td>
		<td width="20%" align="center"><?php echo $line[3];?></td>
		<td width="20%" align="center"><?php echo $line[4];?></td>
		<td width="20%" align="center"><?php echo sprintf("%1.0f",$line[4]/$line[3]);?></td>
		<td width="5%" align="center"><a href="javascript:del(<?php echo $line[0];?>,0)"><img border=0 src="im/shanc.png" alt="删除此行数据"></a></td>
	</tr>
<?php 
}
sqlsrv_free_stmt($result);
?>
</table>
</form>
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
