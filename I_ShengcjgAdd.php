<?php 
include("./inc/xhead.php");
if(isset($_REQUEST['DT2']))
	$_SESSION['DT2']=$_REQUEST['DT2'];
$chengl=0;
if(isset($_POST['dt1']))
{
	if($_POST['maozz']==0) $chengl=0;
	else $chengl=sprintf("%1.2f",($_POST['bianzz']+$_POST['neiz1']+$_POST['fengz'])/$_POST['maozz']);//�������

	$query="insert into sys_jiagsc(jiagrq,caigrq,shij,maozs,maozz,bianzs,bianzz,neiz1,fengs,fengz,zhuangt,bz,unit,lx,pinz) values('".$_POST['dt1']."','".$_POST['dt2']."','".$_POST['shij']."',".$_POST['maozs'].",".$_POST['maozz'].",".$_POST['bianzs'].",".$_POST['bianzz'].",".$_POST['neiz1'].",".$_POST['fengs'].",".$_POST['fengz'].",0,'".$_POST['bz']."','".$_POST['gysid']."',1,".$_POST['pinz'].")";
	$query=str_replace(",,",",0,",$query);
	$query=str_replace(",,",",0,",$query);
	include("./inc/xexec.php");

//	$query="update sys_shengz set kounb=".$_POST['nongb']."*chucj,nongb=".$_POST['nongb'].",chengs=".$chengl.",chenglje=(0.84-".$chengl.")*jine where unit=".$unit." and daohrq='".$_POST['dt1']."' ";
//	$query=str_replace("=,","=0,",$query);
//	include("./inc/xexec.php");

	$query="update sys_jiagnz set dhid=(select max(id) from sys_jiagsc) where id in(select top 4 id from sys_jiagnz order by id desc)";
	include("./inc/xexec.php");

	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}
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
body{font-family:"΢���ź�";}
#th{width:100%;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:398;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Sel();}}</script>
</head>
<BODY>
<form name="IFrm" method="POST" action="">
<table style="width:95%">
<tr><td width="35%" align=right height="40"><span class="c-red">*</span>�������ڣ�</td><td><input type="text" class="input-text" name="dt1" id="dt1" value="<?php echo date('Y-m-d');?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td width="35%" align=right height="40"><span class="c-red">*</span>�ɹ����ڣ�</td><td><input type="text" class="input-text" name="dt2" id="dt2" value="<?php echo $_REQUEST['dt2']==""?date('Y-m-d'):$_REQUEST['dt2'];?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td width="35%" align=right height="40"><span class="c-red">*</span>����ʱ�䣺</td>
		<td><select class="select" size="1" name="shij" id="shij" onchange="chuang()" style="width: 210px;height:30px;" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.gys.focus();" >
		<option value="">--ʱ��--</option>
		<option value="����" <?php echo $_REQUEST['shij']=="����"?selected:"";?>>����</option>
		<option value="����" <?php echo $_REQUEST['shij']=="����"?selected:"";?>>����</option>
		</select>
</td></tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>��Ӧ�̣�</td>
	<td>
		<select class="select" size="1" id="gysid" name="gysid" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.pinz.focus();else if(event.keyCode==38)window.IFrm.shij.focus();" style="width:210px;height:30px;">
		<?php 
		$query="select unit.shortname from sys_shengz sz,sys_unit unit where sz.unit=unit.id and sz.lx=20 and sz.daohrq='".$_REQUEST['dt2']."' ";
		$result=sqlsrv_query($conn,$query);
		while($line=sqlsrv_fetch_array($result))
		{
			echo "<option value=".$line[0].">".$line[0]."</option>";
		}       
		sqlsrv_free_stmt($result);
		?>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>����Ʒ�֣�</td>
	<td>
		<select class="select" size="1" id="pinz" name="pinz" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.maozs.select();else if(event.keyCode==38)window.IFrm.gys.focus();" style="width:210px;height:30px;">
			<?php 
			$query='select id,mc from sys_cp where yn=1 and typec=1 order by mc';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>ë������</td>
	<td><input type="text" class="input-text"  placeholder="" id="maozs" name="maozs" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.maozz.select();else if(event.keyCode==38)window.IFrm.pinz.focus();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>ë���أ�</td>
	<td><input type="text" class="input-text"  placeholder="" id="maozz" name="maozz" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.bianzs.select();else if(event.keyCode==38)window.IFrm.maozs.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">��������</td>
	<td><input type="text" class="input-text"  placeholder="" id="bianzs" name="bianzs" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.bianzz.select();else if(event.keyCode==38)window.IFrm.maozz.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">�����أ�</td>
	<td><input type="text" class="input-text"  placeholder="" id="bianzz" name="bianzz" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.neiz1.select();else if(event.keyCode==38)window.IFrm.bianzs.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><a href="javascript:;" onclick="Sel()"><font color=blue>������ϸ��</font></a></td>
	<td><input type="text" class="input-text"  placeholder="" id="neiz1" name="neiz1" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.fengs.select();else if(event.keyCode==38)window.IFrm.bianzz.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">�ָ�����</td>
	<td><input type="text" class="input-text"  placeholder="" id="fengs" name="fengs" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.fengz.select();else if(event.keyCode==38)window.IFrm.neiz1.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">�ָ��أ�</td>
	<td><input type="text" class="input-text"  placeholder="" id="fengz" name="fengz" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.nongb.select();else if(event.keyCode==38)window.IFrm.fengs.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">ŧ���أ�</td>
	<td><input type="text" class="input-text"  placeholder="" id="nongb" name="nongb" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.bz.select();else if(event.keyCode==38)window.IFrm.fengz.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">��ע��</td>
	<td><input type="text" class="input-text"  placeholder="" id="bz" name="bz" onkeydown="if(event.keyCode==13 || event.keyCode==40) sub();else if(event.keyCode==38)window.IFrm.nongb.select();" style="width:210px;height:30px;"></td>
</tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()"></td></tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.IFrm.shij.value=="")
		layer.msg('��ѡ������ʱ��!',{shade:false});
	else if(window.IFrm.gysid.value=="")
		layer.msg('��ѡ��Ӧ��!',{shade:false});
	else if(window.IFrm.maozs.value=="")
		layer.msg('����ë��������Ϊ��,����������!',{shade:false});
	else if(window.IFrm.maozz.value=="")
		layer.msg('����ë����������Ϊ��,����������!',{shade:false});
	else
	{
		window.IFrm.submit();
      }
}
function Sel()
{
	layer_show2("����ӹ�¼��","I_Neizjg.php?pinz="+window.IFrm.pinz.value,"400","460"); //���һ�������Ǹ�һ����ʶ�� 
} 
function exit()
{
	parent.layer.closeAll();
}
window.IFrm.spdm.focus();
window.IFrm.spdm.select();
function chuang()
{
	window.location="I_ShengcjgAdd.php?dt2="+window.IFrm.dt2.value+"&shij="+window.IFrm.shij.value;
}
</script>


