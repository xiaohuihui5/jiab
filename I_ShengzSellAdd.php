<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$query='select gongsids from sys_user where empid='.$_SESSION['empid'];//ȡ���в���Ȩ�޵�ҵ���
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
if($line[0]!="")
	$TJ=" and id in(".$line[0].")";
sqlsrv_free_stmt($result);
$syslx=19;
if($_POST['feiy']=="") $_POST['feiy']=0;else $_POST['feiy']=$_POST['feiy'];
if(isset($_POST['dt1']))
{
	$query="insert into sys_shengz(dh,dhrq,unit,pinz,tous,daohzl,chucj,jine,beiz,lury,lx,zt,gongsid,yunzf,ssje) values('".getdh($_POST['dt1'],$syslx)."','".$_POST['dt1']."',".$_POST['khid'].",'".$_POST['pinz']."',".$_POST['tous'].",".$_POST['daohzl'].",".$_POST['chucj'].",".$_POST['jine'].",'".$_POST['bz']."','".$_SESSION['uname']."',$syslx,0,".$_POST['gongsid'].",".$_POST['feiy'].",".$_POST['ssje'].")";
	include("./inc/xexec.php");
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}
$DHLX="����ë�����۵�";
?>
<HTML>
<HEAD>
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
<script language="javascript" src="xSelKhMohu.js"></script>
</HEAD>
<body >
<form name="IFrm" method="POST" action="">
<table style="width:95%">
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>ҵ��ֵ㣺</td>
	<td>
		<select class="select" size="1" id="gongsid" name="gongsid" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.dt1.focus();" style="width:210px;height:30px;">
			<?php 
			$query='select id,fenlmc from sys_maozfd where id>0 '.$TJ.' order by id';
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
<tr><td width="35%" align=right height="40"><span class="c-red">*</span>�������ڣ�</td><td><input type="text" class="input-text" name="dt1" id="dt1" value="<?php echo date('Y-m-d');?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=right height="40"><span class="c-red">*</span><a href="javascript:;" onclick="Sel()"><font color=blue>[F9]�ͻ���</font></a></td><td><input type="hidden" value="" id="khid" name="khid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish();" title="������ؼ���" onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) {startRequest(this.value,0);}" style="width: 210px;" id="spdm" name="spdm"></td></tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>����Ʒ�֣�</td>
	<td>
		<select class="select" size="1" id="pinz" name="pinz" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.tous.focus();else if(event.keyCode==38)window.IFrm.spdm.select();" style="width:210px;height:30px;">
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
	<td align=right width="35%" height="40"><span class="c-red">*</span>ͷ����</td>
	<td><input type="text" class="input-text"  placeholder="" id="tous" name="tous" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.daohzl.select();else if(event.keyCode==38)window.IFrm.pinz.focus();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>����/�</td>
	<td><input type="text" class="input-text"  placeholder="" id="daohzl" name="daohzl" onkeyup="{window.IFrm.jine.value=this.value*window.IFrm.chucj.value;window.IFrm.ssje.value=this.value*window.IFrm.daohzl.value;}" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.chucj.select();else if(event.keyCode==38)window.IFrm.tous.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>�۸�</td>
	<td><input type="text" class="input-text"  placeholder="" id="chucj" name="chucj" onkeyup="{window.IFrm.jine.value=this.value*window.IFrm.daohzl.value;window.IFrm.ssje.value=this.value*window.IFrm.daohzl.value+1*window.IFrm.feiy.value;}" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.feiy.select();else if(event.keyCode==38)window.IFrm.daohzl.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>���ã�</td>
	<td><input type="text" class="input-text"  placeholder="" id="feiy" name="feiy" onkeyup="{window.IFrm.ssje.value=1*this.value+1*window.IFrm.jine.value;}" onkeydown="if(event.keyCode==13 || event.keyCode==40){window.IFrm.jine.focus();window.IFrm.jine.select();}else if(event.keyCode==38)window.IFrm.chucj.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>���۽�</td>
	<td><input readonly type="text" class="input-text"  placeholder="" id="jine" name="jine" onkeydown="if(event.keyCode==13 || event.keyCode==40){window.IFrm.ssje.focus();window.IFrm.ssje.select();}else if(event.keyCode==38)window.IFrm.feiy.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>ʵ�ս�</td>
	<td><input type="text" class="input-text"  placeholder="" id="ssje" name="ssje" onkeydown="if(event.keyCode==13 || event.keyCode==40) sub();else if(event.keyCode==38)window.IFrm.chucj.select();" style="width:210px;height:30px;"></td>
</tr>
<tr><td align=center width="95%" colspan=2>��&nbsp;&nbsp;&nbsp;ע</td></tr><tr><td align=center colspan=2><textarea rows="4" name="bz" cols="32" class="textarea" style="width:300px;"></textarea></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</HTML>
<script language ="javascript">
function sub()
{
	if(window.IFrm.gongsid.value=="")
		layer.msg('��ѡ��ҵ��ֵ�!',{shade:false});
	else if(window.IFrm.khid.value=="")
		layer.msg('��ѡ��ͻ�!',{shade:false});
	else if(window.IFrm.tous.value=="")
		layer.msg('ͷ������Ϊ��,����������!',{shade:false});
	else if(window.IFrm.daohzl.value=="")
		layer.msg('��������Ϊ��,����������!',{shade:false});
	else if(window.IFrm.chucj.value=="")
		layer.msg('�۸���Ϊ��,����������!',{shade:false});
	else if(window.IFrm.jine.value=="")
		layer.msg('���۽���Ϊ��,����������!',{shade:false});
	else if(window.IFrm.ssje.value=="")
		layer.msg('ʵ�ս���Ϊ��,����������!',{shade:false});
	else
	{
		window.IFrm.submit();
      }
}
function startRequest(spbh,id)//�������Ʒid����ֱ�ӵõ�������ģ������
{
	createXMLHttpRequest();
	xmlHttp.open("post","AjaxKh.php",true);//�ύ���ؽ����phpҳ��
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-Type","text/xml");
	xmlHttp.setRequestHeader("Content-Type","gb2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState == 4)
		{
			if (xmlHttp.status == 200)
			{
			var arrTmp= xmlHttp.responseText.split("@");
			window.IFrm.khid.value=arrTmp[0];
			window.IFrm.spdm.value=arrTmp[1];
			CloseTipDiv();
			window.IFrm.pinz.focus();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//���ݸ�phpҳ��Ĳ���
}
function Sel()
{
	layer_show2("��Ӧ��ѡȡ","I_Select_Kh_S.php","400","460"); //���һ�������Ǹ�һ����ʶ�� 
} 
function exit()
{
	parent.layer.closeAll();
}
window.IFrm.spdm.focus();
window.IFrm.spdm.select();
</script>
