<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
?>
<head>
<title>�ɹ�����</title>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">




<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<script language="javascript">window.onbeforeunload = function(){window.parent.opener.Frm.submit();}</script><!--�ر�ҳ��ˢ�µ���ҳ��-->
<STYLE type=text/css>
body{font-family:"΢���ź�";}
#th{width:100%;border:0px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 0px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:30px!important;}
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
.user{
background-image: url(im/dy.png);/*����Сͼ��*/
background-position: 5px 6px;/*Сͼ����input��λ��*/
background-repeat: no-repeat;/*����Сͼ�겻�ظ�*/
}
</STYLE>
<script type="text/javascript" src="xSelpmMohu.js"></script>
<script language="javascript">
document.onkeydown=bb;function bb()
{var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}if(nKeyCode==120) {SelCp(1);}
}
</script>
</head>
<body>
<?php
$menuright=menuright(73);//ȡ�ò˵�Ȩ��
//ȡ�õ�����Ϣ
$query="select dh.dh,CONVERT(varchar(10),dh.dhrq,120),unit.shortname,dh.lury,dh.bz,dh.zt,dh.unit,unit.typeb from sys_jhdh dh,sys_unit unit where dh.unit=unit.id and dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$khid=$line[6];
$khflid=$line[7];
$dh_zt=$line[5];
$R_Q=$line[1];
$tis="&nbsp;&nbsp;����:<font color=black>".$line[0]."</font>";
$tis.="&nbsp;&nbsp;����:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;��Ӧ������:<font color=black>".$line[2]."</font>";
$tis.="&nbsp;&nbsp;�Ƶ�:<font color=black>".$line[3]."</font>";
$tis.="&nbsp;&nbsp;��ע:<font color=black>".$line[4]."</font>";
sqlsrv_free_stmt($result);
//ȡ�õ�����Ϣ
$tit='';
if($menuright>1 and $dh_zt==0)//¼��
{
$lur='
<table class="hetable" align="center" style="width:70%"><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm">
<tr>
<td algin=center onclick="SelCp(1)"><div class="text-c"><font color=blue>��Ʒ����</font>[F9]</div></td>
<td algin=center><div class="text-c">��Ʒ����</div></td>
<td algin=center><div class="text-c">��λ</div></td>
<td algin=center><div class="text-c">������</div></td>
<td algin=center><div class="text-c">����</div></td>
<td algin=center><div class="text-c">��ע</div></td>
<td algin=center><div class="text-c"></div></td>
</tr>
<tr>
<td algin=center><div class="text-c">
<input type="hidden" name="dhid" value="'.$_REQUEST['dhid'].'">
<input type="hidden" name="cpid" id="cpid">
<input type="hidden" id="oldvalue" name="oldvalue">
<input type="text" class="input-text" style="width: 150px;" onkeyup="AutoFinish()"   title="������ؼ���"  onclick="this.select();CloseTipDiv();" id="spdm" name="spdm">
</div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:200px" id="cpmc" name="cpmc"></div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:50px" id="dw" name="dw"></div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:80px" id="dinghl" name="dinghl" onkeypress="check(this,2)" onkeydown="if(event.keyCode==13){window.IFrm.dj.select();}else  if(event.keyCode==39){window.IFrm.dj.select();}"></div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:80px" id="dj" name="dj" onkeydown="if(event.keyCode==13){window.IFrm.bz.select();}else  if(event.keyCode==39){window.IFrm.bz.select();}else  if(event.keyCode==37){window.IFrm.dinghl.select();}" onkeypress="check(this,2)"></div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:140px"  id="bz" name="bz" onkeydown="if(event.keyCode==13){sub();}else  if(event.keyCode==37){window.IFrm.dj.select();}"></div></td>
<td algin=center><div class="text-c"><input class="btn btn-success radius" style="height:30px;width:75px;" type="button" value="��&nbsp;��" onclick="sub();"></div></td>
</tr>
</form>
</table>';
}
else
	$lur='<table width=100%><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm"><tr><td align=center><font size=5 color=red>��ѯȨ��/�˵������</font></td></tr></form></table>';
$cha='';
$lnk='<span class="r"><form method="post" name="Frm"></form>
<a href="javascript:tianc('.$_REQUEST['dhid'].',1)" class="btn radius">����=����</a>
<a href="javascript:tianc('.$_REQUEST['dhid'].',2)" class="btn radius">ʵ��=����</a>  
<a href="I_Sell1MxExcel.php?dhid='.$_REQUEST['dhid'].'"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png> ����</a> 
<input id="c1" type="button" data-clipboard-target="p1" class="btn radius user" value="&nbsp;&nbsp;&nbsp;&nbsp;��ӡ"> </span>';
if($menuright>1 and ($dh_zt==0))//¼��
{
$tis.='&nbsp;&nbsp;&nbsp;<a href="javascript:update()" class="btn btn-success radius"> F8 ����</a>';
$lie=",��,��,���,��Ʒ����,���,������,������,ʵ����,��λ,����,���,��ע,ɾ";
$wid=",4%,4%,10%,16%,8%,7%,7%,7%,5%,7%,8%,13%,4%";
}
else
{
$lie=",��,��,���,��Ʒ����,���,������,������,ʵ����,��λ,����,���,��ע";
$wid=",4%,4%,10%,16%,8%,7%,7%,7%,5%,7%,8%,17%";
}
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$_REQUEST['dhid'],$tis,$xuh,$yul);
?>
</body>
<script type="text/javascript" src="inc/ZeroClipboard.js"></script>
<script type="text/javascript">
var clip1= null;
clip1 = new ZeroClipboard.Client();
clip1.setHandCursor(true);
clip1.setText('<?php echo $_REQUEST['dhid'];?>;p03.fr3;0;1;1;=)(=');
clip1.glue('c1');
</script>
<script language ="javascript">
function sub()
{
	if($("input[name=cpid]").val()=="" || $("input[name=cpid]").val()==null)
	{
		layer.msg('��ѡȡ��Ʒ��', {icon:2,time:1500});
		window.IFrm.spdm.focus();
		return false;
	}
	else
	{
		window.IFrm.submit();
		window.IFrm.reset();
		window.IFrm.spdm.focus();
		//javascript:parent.location.replace(location.href);//����תˢ��
	}
}
function startRequest(spbh,id)//�������Ʒid����Cs_SellfljgAjax.phpֱ�ӵõ���Ʒ������ģ������
{
	createXMLHttpRequest();
	xmlHttp.open("post","I_BuyAjax.php",true);//�ύ���ؽ����phpҳ��
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
			window.IFrm.cpid.value=arrTmp[0];
			window.IFrm.cpmc.value=arrTmp[1];
			window.IFrm.dj.value=arrTmp[2];
			window.IFrm.dw.value=arrTmp[3];
			window.IFrm.dinghl.select();
			window.IFrm.dinghl.focus();
                        CloseTipDiv();
			}
		}
	};
	xmlHttp.send("spbh="+spbh+"&id="+id+"&khid=<?php echo $khid."&RQ=".$R_Q;?>");//���ݸ�phpҳ��Ĳ���
}
function tianc(id,lx)//�ύ��ϸ����
{
	if(lx==1)
		window.hqlist.Frm.shid.value=id;
	else
		window.hqlist.Frm.ssid.value=id;
	window.hqlist.Frm.submit();
	javascript:location.replace(location.href);//����תˢ��
}
var tt=document.getElementById('spdm');
if(tt){document.getElementById('spdm').select();document.getElementById('spdm').focus();}
</script>
