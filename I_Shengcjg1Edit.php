<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['dt1']))
{
	$query="update sys_jiagsc set jiagrq='".$_POST['dt1']."',maozs=".$_POST['maozs'].",maozz=".$_POST['maozz'].",bianzs=".$_POST['bianzs'].",bianzz=".$_POST['bianzz'].",neiz1=".$_POST['neiz1'].",fengs=".$_POST['fengs'].",fengz=".$_POST['fengz'].",bz='".$_POST['bz']."' where id=".$_REQUEST['id'];
	$query=str_replace("=,","=0,",$query);
	$query=str_replace("=,","=0,",$query);
	sqlsrv_query($conn,$query);

	$query="update sys_jiagnz set zhongl=".$_POST['zhug']." where dhid=".$_REQUEST['id']." and cpid=35";
	sqlsrv_query($conn,$query);

	$query="update sys_jiagnz set zhongl=".$_POST['zhud']." where dhid=".$_REQUEST['id']." and cpid=32";
	sqlsrv_query($conn,$query);

	$query="update sys_jiagnz set zhongl=".$_POST['zhux']." where dhid=".$_REQUEST['id']." and cpid=33";
	sqlsrv_query($conn,$query);

	$query="update sys_jiagnz set zhongl=".$_POST['zhul']." where dhid=".$_REQUEST['id']." and cpid=59";
	sqlsrv_query($conn,$query);
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}//首次提交单号
	$query="select zhuangt,id,CONVERT(varchar(10),jiagrq,120),shij,maozs,maozz,bianzs,bianzz,neiz1,fengs,fengz,bz,pinz,unit from sys_jiagsc where id=".$_REQUEST['id']; 
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$id=$line[1];
	$_REQUEST['DT2']=$line[2];
	$shij=$line[3];
	$maozs=$line[4];
	$maozz=$line[5];
	$bianzs=$line[6];
	$bianzz=$line[7];
	$neiz1=$line[8];
	$fengs=$line[9];
	$fengz=$line[10];
	$bz=$line[11];
	$pinz=$line[12];
	$unit=$line[13];
	sqlsrv_free_stmt($result);	

	$query="select cpid,zhongl from sys_jiagnz where dhid=".$_REQUEST['id']; 
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$zl[$line[0]]=$line[1];
	}
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
#th{width:210px;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:398;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
</head>
<BODY>
<form name="Frm" method="POST" action="">
<table width="95%">
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>供应商：</td><td><input class="input-text" name="unit" value="<?php echo $unit;?>" readonly style="width:210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>生猪品种：</td><td>
		<select class="select" size="1" name="pin_z" style="width:210px;height=30px;">
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
	<td width="35%" align=right height="40"><span class="c-red">*</span>日期：</td>
	<td><input type="hidden" value="<?php echo $id;?>" name="id"><input type="hidden" value="<?php echo $_REQUEST['DT2'];?>"  name="odt1"><input class="input-text" name="dt1" type="text" value="<?php echo $_REQUEST['DT2'];?>" onclick="calendar(this)" style="width:210px"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>时间：</td>
	<td>
		<select class="select" size="1" name="shij" style="width:210px;height=30px;">
		<option value="上午" <?php echo $shij=="上午"?"selected":"";?>>上午</option>
		<option value="下午" <?php echo $shij=="下午"?"selected":"";?>>下午</option>
		</select>
	</td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>毛猪数：</td>
	<td><input class="input-text" name="maozs" value="<?php echo $maozs;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.maozz.focus();else if(event.keyCode==38)window.Frm.shij.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40"><span class="c-red">*</span>毛猪重：</td>
	<td><input class="input-text" name="maozz" value="<?php echo $maozz;?>"  onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bianzs.focus();else if(event.keyCode==38)window.Frm.maozs.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">边猪数：</td>
	<td><input class="input-text" name="bianzs" value="<?php echo $bianzs;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bianzz.focus();else if(event.keyCode==38)window.Frm.maozz.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">边猪重：</td>
	<td><input class="input-text" name="bianzz" value="<?php echo $bianzz;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.neiz1.focus();else if(event.keyCode==38)window.Frm.bianzs.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">内脏：</td>
	<td><input class="input-text" readonly name="neiz1" value="<?php echo $neiz1;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.fengs.focus();else if(event.keyCode==38)window.Frm.bianzz.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">分割数：</td>
	<td><input class="input-text" name="fengs" value="<?php echo $fengs;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.fengz.focus();else if(event.keyCode==38)window.Frm.neiz1.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">分割重：</td>
	<td><input class="input-text" name="fengz" value="<?php echo $fengz;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.bz.focus();else if(event.keyCode==38)window.Frm.fengs.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">备&nbsp;&nbsp;&nbsp;&nbsp;注：</td>
	<td><input class="input-text" name="bz" value="<?php echo $bz;?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zhug.focus();else if(event.keyCode==38)window.Frm.fengz.focus();" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">内脏明细-猪肝：</td>
	<td><input class="input-text" name="zhug" value="<?php echo $zl[35];?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zhud.focus();else if(event.keyCode==38)window.Frm.bz.focus();" onkeyup="window.Frm.neiz1.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value;" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">内脏明细-猪肚：</td>
	<td><input class="input-text" name="zhud" value="<?php echo $zl[32];?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zhux.focus();else if(event.keyCode==38)window.Frm.zhug.focus();" onkeyup="window.Frm.neiz1.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value;" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">内脏明细-猪心：</td>
	<td><input class="input-text" name="zhux" value="<?php echo $zl[33];?>" onkeydown="if(event.keyCode==13 || event.keyCode==40)window.Frm.zhul.focus();else if(event.keyCode==38)window.Frm.zhud.focus();" onkeyup="window.Frm.neiz1.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value;" onfocus="this.select();" style="width: 210px;"></td>
</tr>
<tr>
	<td width="35%" align=right height="40">内脏明细-猪俐：</td>
	<td><input class="input-text" name="zhul" value="<?php echo $zl[59];?>" onkeydown="if(event.keyCode==13)sub();else if(event.keyCode==38)window.Frm.zhux.focus();" onkeyup="window.Frm.neiz1.value=1*window.Frm.zhug.value+1*window.Frm.zhud.value+1*window.Frm.zhux.value+1*window.Frm.zhul.value;" onfocus="this.select();" style="width: 210px;"></td>
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
	if(window.Frm.maozs.value=="")
		layer.msg('屠宰毛猪数不能为空,请重新输入!',{shade:false});
	else if(window.Frm.maozz.value=="")
		layer.msg('屠宰毛猪重量不能为空,请重新输入!',{shade:false});
	else
	{
		window.Frm.submit();
      }
}
function exit()
{
	parent.layer.closeAll();
}
</script>


