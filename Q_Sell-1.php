<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="khid" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">
<input type="hidden" name="khflid" value="<?php echo isset($_POST['khflid'])?$_POST['khflid']:"";?>">
<input type="hidden" name="khxlid" value="<?php echo isset($_POST['khxlid'])?$_POST['khxlid']:"";?>">
<input type="hidden" name="cpxlid" value="<?php echo isset($_POST['cpxlid'])?$_POST['cpxlid']:"";?>">
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php
$TJ=" ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ=" and dh.lx=2 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ=" and dh.lx=2 and dh.dhrq='".date('Y-m-d',strtotime("+1 day"))."' ";
if(isset($_POST['khflid']) and $_POST['khflid']!="")
	$TJ.=" and unit.typeb in(".$_POST['khflid'].") ";
if(isset($_POST['khxlid']) and $_POST['khxlid']!="")
	$TJ.=" and unit.typec in(".$_POST['khxlid'].") ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and unit.id in(".$_POST['khid'].") ";
if(isset($_POST['cpxlid']) and $_POST['cpxlid']!="")
	$TJ.=" and cp.typec in(".$_POST['cpxlid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and cp.id in(".$_POST['cpid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.usercode+unit.shortname+dh.dh+cp.bh+cp.mc like '%".$_POST['cxtj']."%' ";
?>