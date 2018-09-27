<?php 
include("inc/xhead.php");
?>
<HTML>
<HEAD>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/new_select_m.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
</HEAD>
<body>
<form name="Frm" method="POST" action="">
<table align="center" style="width:500; height:450;position:absolute" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align=center style="width:80px; height:300;"></td>
<td align=center style="width:320px; height:300;">
	<input id="cxtj"  tabindex="1" id="cxtj" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>" onkeydown="if(event.keyCode==13) ListLeft()" style="height: 32px;width: 235px;font-family: 微软雅黑; font-size: 12px;border: 1px #000000 solid">
	<input class="btn btn-primary radius" type="button" value="搜索" onclick="submit()" style="width: 60px;">
	<br>待选客户分类列表<br>
	<select style="height: 350px;width:100%" onkeydown="if(event.keyCode==13) SelOk();" id="zfl" name="zfl" size="17"  OnDblClick="SelOk()">
		<?php 
		$TJ="";
		if(isset($_POST['cxtj']) && $_POST['cxtj']!="")
			$TJ.=" and (bianh+fenlmc+piny like '%".$_POST['cxtj']."%') ";
		$query="select fl.id,fl.fenlmc from sys_khfenl fl where fl.yn=1 ".$TJ." order by fl.bianh";
		
		$result=sqlsrv_query($conn,$query);
		$dat="";
		$i=0;
		while($line=sqlsrv_fetch_array($result))
		{
			$i++;
			if($i==1)
				echo "<option selected value=".$line[0].">".$line[1]."</option>";
			else
				echo "<option value=".$line[0].">".$line[1]."</option>";
		}       
		//sqlsrv_free_stmt($result);
		?>
	</select>
</td>
<td align=center style="width:50px; height:300;"></td>
</tr>
</TABLE>
</form>
</body>
</HTML>
<script language="javascript">
function SelOk()
{
	window.parent.document.getElementById("khid").value=window.Frm.zfl.value;
	window.parent.document.getElementById("khmc").value=window.Frm.zfl.options[window.Frm.zfl.selectedIndex].text;
	window.parent.Frm.cpmc.focus();
	parent.layer.closeAll();
}
function submit(){
	Window.Frm.submit;
}
if(window.Frm.cxtj.value==="" && window.Frm.typea.value==="")
	window.Frm.cxtj.focus();
else
	window.Frm.zfl.focus();
</script>