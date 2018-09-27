<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['dt1']))
{
	$_SESSION['DT1']=$_POST['dt1'];
	$IBZ=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$query="update sys_jhdh set dhrq='".$_POST['dt1']."',bz=".$IBZ." where id=".$_POST['dhid'];
	include("./inc/xexec.php");
	if($res)
	{
		echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";//提示成功退出
	}
}
else
{
	$query="select 0,a.dh,CONVERT(varchar(10),a.dhrq,120),case len(bz) when 0 then null else bz end from sys_jhdh a where a.id=".$_GET['dhid'];
	$result=sqlsrv_query($conn,$query);
	$line=sqlsrv_fetch_array($result);
	$DH=$line[1];
	$RQ=$line[2];
	$BZ=$line[3];
	sqlsrv_free_stmt($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Sel();}}</script>
<script language="javascript" src="xSelkhMohu.js"></script>
</head>
<BODY >
<form name="IFrm" method="POST" action="">
<table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid">
<tr><td align=center height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c-red">*</span>盘点日期：<input type="text" class="input-text Wdate" name="dt1" onFocus="WdatePicker({lang:'zh-cn'})" id="datemin" value="<?php echo $RQ;?>" style="width:210px;"></td>
<tr><td align=center>备&nbsp;&nbsp;&nbsp;注<br><textarea rows="6" name="bz" cols="33" class="textarea" style="width:320px;"><?php echo $BZ;?></textarea></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
window.IFrm.submit();
}
function exit(){
	parent.layer.closeAll();
}
</script>
