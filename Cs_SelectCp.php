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
<table align="center" style="width:500; height:400;position:absolute" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align=center style="width:50; height:400;"></td>
<td align=center style="width:400; height:400;">
		<select style="height: 32px;width:100%;" id="typeb" name="typeb" onchange="window.Frm.submit()">
			<option value="" style="align:center">-------������������ѡȡ-------</option>
			<?php 
				$query="select fl.id,fl.fenlmc from sys_cpxfl fl where fl.yn=1 order by fl.bianh";
				$result=sqlsrv_query($conn,$query);
				while($line=sqlsrv_fetch_array($result))
				{
				if($_POST['typeb']==$line[0])
					echo "<option selected value=".$line[0].">".$line[1]."</option>";
				else 
					echo '<option value="',$line[0],'">',$line[1],'</option>';
				}       
				sqlsrv_free_stmt($result);
			?>
		</select>
	<input id="cxtj"  tabindex="1" id="cxtj" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>" onkeydown="if(event.keyCode==13) ListLeft()" style="height: 32px;width: 335px;font-family: ΢���ź�; font-size: 12px;border: 1px #000000 solid">
	<input class="btn btn-primary radius" type="button" value="����" onclick="ListLeft()" style="width: 60px;">
	<br>��ѡ��Ʒ�б�<br>
	<select style="height: 330px;width:100%" onkeydown="if(event.keyCode==13) SelOk();" id="zfl" name="zfl" size="17"  OnDblClick="SelOk()">
		<?php 
		$TJ="";
		if(isset($_POST['typeb']) && $_POST['typeb']!="")
			$TJ.=" and typec=".$_POST['typeb'];
		if(isset($_POST['cxtj']) && $_POST['cxtj']!="")
			$TJ.=" and (bh+mc+piny like '%".$_POST['cxtj']."%') ";
		$query="select top 50 id,bh+mc from sys_cp where yn=1 ".$TJ." order by bh";
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
		sqlsrv_free_stmt($result);
		?>
	</select>
</td>
<td align=center style="width:50; height:400;"></td>
</tr>
</TABLE>
</form>
</body>
</HTML>
<script language="javascript">
function SelOk()
{
	window.parent.document.getElementById("spdm").value=window.Frm.zfl.options[window.Frm.zfl.selectedIndex].text;
	window.parent.startRequest(window.Frm.zfl.options[window.Frm.zfl.selectedIndex].text,window.Frm.zfl.value);
	parent.layer.closeAll();
}
if(window.Frm.cxtj.value==="" && window.Frm.xiaofl.value==="")
	window.Frm.cxtj.focus();
else
	window.Frm.zfl.focus();
</script>