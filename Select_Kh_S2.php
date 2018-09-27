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
<table align="center" style="width:400; height:400;position:absolute" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align=center style="width:50px; height:360;"></td>
<td align=center style="width:300px; height:360;">
	<input id="cxtj"  tabindex="1" id="cxtj" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>" onkeydown="if(event.keyCode==13) ListLeft()" style="height: 32px;width: 235px;font-family: 微软雅黑; font-size: 12px;border: 1px #000000 solid">
	<input class="btn btn-primary radius" type="button" value="搜索" onclick="submit()" style="width: 60px;">
	<br>待选客户列表<br>
	<select style="height: 300px;width:100%" onkeydown="if(event.keyCode==13) SelOk();" id="zfl" name="zfl" size="17"  OnDblClick="SelOk()">
		<?php 
		$TJ="";
		//if(isset($_POST['typeb']) && $_POST['typeb']!="")
			//$TJ.=" and typeb=".$_POST['typeb'];
		if(isset($_POST['cxtj']) && $_POST['cxtj']!="")
			$TJ.=" and (bianh+fenlmc+piny like '%".$_POST['cxtj']."%') ";
		$query="select id,bianh+fenlmc from sys_khfenl where  yn=1 ".$TJ." order by fenlmc";
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
		?>
	</select>
</td>
<td align=center style="width:50px; height:360;"></td>
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
	parent.layer.closeAll();
}
function sumbit(){
  window.Frm.submit;
}
if(window.Frm.cxtj.value==="" && window.Frm.typea.value==="")
	window.Frm.cxtj.focus();
else
	window.Frm.zfl.focus();
</script>