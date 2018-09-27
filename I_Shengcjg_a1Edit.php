<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['dt1']))
{
	$query="update sys_bzjiag set sl=".$_POST['sl'].",zl=".$_POST['zl'].",zhut=".$_POST['zhut'].",zhuj=".$_POST['zhuj'].",bany=".$_POST['bany'].",suiy=".$_POST['suiy'].",bz='".$_POST['bz']."' where id=".$_REQUEST['id'];
	$query=str_replace("=,","=0,",$query);
	$query=str_replace("=,","=0,",$query);
	sqlsrv_query($conn,$query);
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}//首次提交单号
	$query="select bz.zhuangt,bz.id,CONVERT(varchar(10),jg.jiagrq,120),bz.zhut,bz.zhuj,bz.bany,bz.suiy,bz.bz,jg.pinz,jg.unit,jg.bianzs,jg.bianzz,bz.sl,bz.zl from sys_bzjiag bz,sys_jiagsc jg where bz.jiagscid=jg.id and bz.id=".$_REQUEST['id']; 
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$id=$line[1];
	$_REQUEST['DT2']=$line[2];
	$zhut=$line[3];
	$zhuj=$line[4];
	$bany=$line[5];
	$suiy=$line[6];
	$bz=$line[7];
	$pinz=$line[8];
	$unit=$line[9];
	$bianzs=$line[10];
	$bianzz=$line[11];
	$jgsl=$line[12];
	$jgzl=$line[13];
	sqlsrv_free_stmt($result);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:398;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
</head>
<BODY><form name="Frm" method="POST" action="">
<table width="95%">
<tr>
	<td width="35%" align=right height="40">供应商:</td><td><input class="input-text" name="unit" value="<?php echo $unit;?>"  style="width:210px;" readonly></td>
</tr>
<tr>
	<td width="35%" align=right height="40">生猪品种:</td><td>
		<select class="select" size="1" name="pin_z" style="width:210px;">
		<?php 
		$query="select id,mc from sys_cp where id=".$pinz;
		$result=sqlsrv_query($conn,$query);
		while($line=sqlsrv_fetch_array($result))
		{
			echo "<option value=".$line[0].">".$line[1]."</option>";
		}       
		sqlsrv_free_stmt($result);
		?>
		</select>
	</td>
</tr>
<tr>
	<td width="35%" align=right height="40">日期:</td>
	<td><input type="hidden" value="<?php echo $id;?>" name="id"><input class="input-text" name="dt1" type="text" value="<?php echo $_REQUEST['DT2'];?>" style="width:210px;" readonly></td>
</tr>
<tr>
	<td width="35%" align=right height="40">边猪数:</td>
	<td><input class="input-text" name="bianzs" readonly value="<?php echo $bianzs;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bianzz.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">边猪重:</td>
	<td><input class="input-text" name="bianzz" readonly value="<?php echo $bianzz;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.sl.focus();else if(event.keyCode==38) window.Frm.bianzs.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">加工边猪数:</td>
	<td><input class="input-text" name="sl" value="<?php echo $jgsl;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zl.focus();else if(event.keyCode==38) window.Frm.bianzz.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">加工边猪重:</td>
	<td><input class="input-text" name="zl" value="<?php echo $jgzl;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zhut.focus();else if(event.keyCode==38) window.Frm.sl.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">猪头:</td>
	<td><input class="input-text" name="zhut" value="<?php echo $zhut;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zhuj.focus();else if(event.keyCode==38) window.Frm.zl.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">猪脚:</td>
	<td><input class="input-text" name="zhuj" value="<?php echo $zhuj;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bany.focus();else if(event.keyCode==38) window.Frm.zhut.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">板油:</td>
	<td><input class="input-text" name="bany" value="<?php echo $bany;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.suiy.focus();else if(event.keyCode==38) window.Frm.zhuj.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">碎油:</td>
	<td><input class="input-text" name="suiy" value="<?php echo $suiy;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bz.focus();else if(event.keyCode==38) window.Frm.bany.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">备&nbsp;&nbsp;&nbsp;&nbsp;注:</td>
	<td><input class="input-text" name="bz" value="<?php echo $bz;?>" onkeydown="if(event.keyCode==13)sub();else if(event.keyCode==38) window.Frm.suiy.focus();" onfocus="this.select();"  style="width:210px;"></td>
</tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.Frm.zhut.value=="")
		layer.msg('猪头不能为空!',{shade:false});
	else if(window.Frm.zhuj.value=="")
		layer.msg('猪脚不能为空!',{shade:false});
	else if(window.Frm.bany.value=="")
		layer.msg('板油不能为空!',{shade:false});
	else if(window.Frm.suiy.value=="")
		layer.msg('碎油不能为空!',{shade:false});
	else
		window.Frm.submit();
}
function exit()
{
	parent.layer.closeAll();
}
</script>


