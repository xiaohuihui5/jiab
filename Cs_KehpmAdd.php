<?php
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
if(isset($_POST['khid']))
{
      $cp=explode(",",$_POST['cpid']);
	$count=count($cp);
	for ($i=0;$i<$count;$i++)
	{
		//$query="if not exists (select id from sys_khpm where flid=".$_POST['khid']." and cpid=".$cp[$i].") insert into sys_khpm(flid,cpid,jies)values(".$_POST['khid'].",".$cp[$i].",0)";
		$query="insert into sys_khpm(flid,cpid,jies)values(".$_POST['khid'].",".$cp[$i].",0)";
		include("./inc/xexec.php");
	}
	if($res)
		echo "<script language=javascript>window.parent.Frm.submit();//parent.layer.msg('�����ɹ���',{icon:1,time:1500});//parent.layer.closeAll();</script>";//��ʾ�ɹ��˳�
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
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script type="text/javascript" src="xSelpmMohu.js"></script>
</head>
<BODY >
<form name="Frm" method="POST" action="">
<table>
<tr><td height="50"></td></tr>
<tr><td align=center height="50"><span class="c-red">*</span><a href="javascript:;" onclick="kh()"><font color=blue>�ͻ����ࣺ</font></a><input id="khid" name="khid" type="hidden" value="<?php echo $_POST['khid'];?>"><input type="text" class="input-text"  readonly id="khmc"  name="khmc" value="<?php echo $_POST['khmc'];?>" placeholder="ѡȡ�ͻ�����" onkeydown="if(event.keyCode==13) kh();" onclick="kh()" style="width: 210px;"></td></tr>
<tr><td align=center height="100"><span class="c-red">*</span><a onclick="layer_show2('��Ʒѡȡ','Select_Cp_Md.php','700','700')"><font color=blue>��˾��Ʒ��</font></a><input type="hidden" value="" name="cpid" id="cpid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" value="<?php echo $_POST['cpmc']?>" onclick="layer_show2('��Ʒѡȡ','Select_Cp_Md.php','700','700');" style="width: 210px;"  id="cpmc" name="cpmc"></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script lanuage="javascript">
function sub()
{
	if(window.Frm.khid.value=="")
		layer.msg('�ͻ����Ʋ���Ϊ��!',{shade:false});
	else if(window.Frm.cpid.value=="")
		layer.msg('��Ʒ���Ʋ���Ϊ��!',{shade:false});
	//else if(window.Frm.mc.value=="")
		//layer.msg('�ͻ�Ʒ������Ϊ��!',{shade:false});
	//else if(window.Frm.huans.value=="")
		//	layer.msg('����ֵ����Ϊ��!',{shade:false})
	else
	{
		window.Frm.submit();
      }
}
function startRequest(spbh,id)//�������Ʒid����ֱ�ӵõ�������ģ������
{
	createXMLHttpRequest();
	xmlHttp.open("post","Cs_KehSelCpAjax.php",true);//�ύ���ؽ����phpҳ��
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
			window.Frm.cpid.value=arrTmp[0];
			window.Frm.spdm.value=arrTmp[1];
			window.Frm.mc.value=arrTmp[1];
			window.Frm.dw.value=arrTmp[4];
			window.Frm.gg.value=arrTmp[5];
			window.Frm.bh.focus();
			CloseTipDiv();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//���ݸ�phpҳ��Ĳ���
}
function kh()
{
	layer_show2("�ͻ�ѡȡ","Select_Kh_S.php","550","550"); //���һ�������Ǹ�һ����ʶ�� 
} 
function exit()
{
	parent.layer.closeAll();
}
window.Frm.khmc.focus();
window.Frm.khmc.select();
</script>
