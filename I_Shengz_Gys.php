<?php 
include("inc/xhead.php");
?>
<HTML>
<HEAD>
<title>生猪供应商选取</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="inc/xdown.css" type="text/css">
</HEAD>
<body style="width:280; height:350;">
<form name="Frm" method="POST" action="">
<table align="center" style="width:280; height:290;position:absolute" cellspacing="0" cellpadding="0" border="0">
<tr><th height=25><b>生猪供应商选取</b></th></tr>
<tr><td style="border:0" align=center>
<select style="width:200;FONT-SIZE: 12px; FONT-FAMILY: 宋体" name="dqsz" onchange="window.Frm.submit()">
<option value="1" style="align:center">-生猪类供应商-</option>
</select>
</td></tr>
<tr><td style="border:0" align=center><input value="<?php echo $_REQUEST['cxtj'];?>"  tabindex="1" name="cxtj" onkeydown="if(event.keyCode==13)window.Frm.submit()" style="width: 140px">
<a title="名称模糊查找" href="javascript:window.Frm.submit()"><img src="im/search.gif" border="0" align="absbottom"></a>
</td></tr>
<tr><td align=center style="border:0">
待选生猪供应商列表<br>
<select style="width:200" onkeydown="if(event.keyCode==13) sel();" name="zfl" size="12" OnDblClick="sel()" multiple>
<?php 
$TJ="";
if($_REQUEST['cxtj']!="")
	$TJ.=" and usercode+shortname+linkman+phone+address like '%".$_REQUEST['cxtj']."%' ";
$query="select id,usercode+shortname from sys_unit where mode=1 and typea=1 ".$TJ." order by usercode";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	if($TJ!="")
		echo "<option selected value=".$line[0].">".$line[1]."</option>";
	else 
		echo "<option value=".$line[0].">".$line[1]."</option>";

}       
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
</select></td></tr>
</TABLE>
</form>
</body>
</HTML>
<script language="javascript">
if(window.Frm.cxtj.value=='')
	window.Frm.cxtj.focus();
else
	window.Frm.zfl.focus();
function sel()
{
	window.opener.Frm.gys.value=window.Frm.zfl.value;
	window.opener.Frm.spdm.value=window.Frm.zfl.options[window.Frm.zfl.selectedIndex].text;
	window.close();
}
</script>


