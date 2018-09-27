<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<input type="hidden" name="gysflid" value="<?php echo isset($_POST['gysflid'])?$_POST['gysflid']:"";?>">
<input type="hidden" name="cpxlid" value="<?php echo isset($_POST['cpxlid'])?$_POST['cpxlid']:"";?>">
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php
$TJ=" and dh.lx in(1,4) ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ=" and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ=" and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['gysflid']) and $_POST['gysflid']!="")
	$TJ.=" and unit.typeb in(".$_POST['gysflid'].") ";
if(isset($_POST['gysid']) and $_POST['gysid']!="")
	$TJ.=" and unit.id in(".$_POST['gysid'].") ";
if(isset($_POST['cpxlid']) and $_POST['cpxlid']!="")
	$TJ.=" and cp.typec in(".$_POST['cpxlid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and cp.id in(".$_POST['cpid'].") ";
if(isset($_POST['lx']) and $_POST['lx']!="")
	$TJ.=" and dh.lx=".$_POST['lx'];
else
	$TJ.=" and dh.lx in(1,4) ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.usercode+unit.shortname+dh.dh+cp.bh+cp.mc like '%".$_POST['cxtj']."%' ";
?>