<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
if(isset($_GET['dhid']))
	$dh_id=$_GET['dhid'];
?>
<head>




<title>���ⶩ��</title>
<link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link href="css/style.min862f.css?v=4.1.0" rel="stylesheet">

<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">

<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
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
$menuright=menuright(15);//ȡ�ò˵�Ȩ��
//ȡ�õ�����Ϣ
$query="select 0,dh.dh,CONVERT(varchar(10),dh.dhrq,120),dh.lury,dh.bz,dh.zt,dh.id from sys_jhdh dh where dh.id=".$_GET['dhid'];
$result=sqlsrv_query($conn,$query);$line=sqlsrv_fetch_array($result);
$dhzt=$line[5];$_SESSION['DT1']=$line[2];$dhid=$line[6];
$tis="&nbsp;&nbsp;����:<font color=black>".$line[1]."</font>&nbsp;&nbsp;����:<font color=black>".$line[2]."</font>&nbsp;&nbsp;�Ƶ�:<font color=black>".$line[3]."&nbsp;&nbsp;".$line[4]."</font>";
sqlsrv_free_stmt($result);
//��ȡ�ֿ�
$query="select id,fenlmc from sys_cangk where yn=1";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result)){
	$ckid[] = $line[0];
}
$ckid = implode(',',$ckid);
$result=sqlsrv_query($conn,$query);$line=sqlsrv_fetch_array($result);
$query="select id,fenlmc from sys_cangk where yn=1";
$result=sqlsrv_query($conn,$query);
$ck='<select class="select-box" style="width:100px;height:31px;" name="ck">';
while($line=sqlsrv_fetch_array($result))
{
	$ck.='<option value='.$line[0].'>'.$line[1].'</option>';
}
$ck.='</select>';
//ȡ�õ�����Ϣ
$tit='';
$lur='
<table class="hetable" align="center" style="width:65%"><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm">
<tr>
<td algin=center onclick="SelCp(1)"><div class="text-c"><font color=blue>��Ʒ����</font>[F9]</div></td>
<td algin=center><div class="text-c">��Ʒ����</div></td>
<td algin=center><div class="text-c">�ֿ�</div></td>
<td algin=center><div class="text-c">������</div></td>
<td algin=center><div class="text-c">����</div></td>
<td algin=center><div class="text-c">��ע</div></td>
<td algin=center><div class="text-c"></div></td>
</tr>
<tr>
<td algin=center><div class="text-c">
<input type="hidden" name="cpid" id="cpid"><input type="hidden" name="dhid" value="'.$_GET['dhid'].'">
<input type="hidden" id="oldvalue" name="oldvalue">
<input type="text" class="input-text" tabindex="1" onkeyup="AutoFinish()" title="������ؼ���" onclick="this.select();CloseTipDiv();" style="width: 150px;"  id="spdm" name="spdm">
</div></td>
<td algin=center><div class="text-c"><input tabindex="10" class="input-text" name="cpmc" id="cpmc" readonly style="width: 110px"></div></td>
<td algin=center><div class="text-c">'.$ck.'</div></td>
<td algin=center><div class="text-c"><input tabindex="2" class="input-text" name="songhl" type="text" style="width: 110px" onkeydown="if(event.keyCode==13) window.IFrm.dj.focus();" onfocus="this.select();"></div></td>
<td algin=center><div class="text-c"><input tabindex="3" class="input-text" name="dj" id="dj" type="text" style="width: 70px" onkeydown="if(event.keyCode==13) sub()"  onkeypress="check(this,2)"></div></td>
<td algin=center><div class="text-c"><input tabindex="4" class="input-text" name="bz" id="bz"  type="text" onkeydown="if(event.keyCode==13) sub()" style="width: 120px"></div></td>
<td algin=center><div class="text-c"><input class="btn btn-success radius" style="height:30px;width:75px;" type="button" value="��&nbsp;��" onclick="sub();"></div></td>
</tr>
</form>
</table>';
$cha='';
$lnk='<span class="r"><form method="post" name="Frm"></form>
<a class="btn radius" href="javascript:{openwindow2(\'I_chukMxPrint.php?dhid='.$dhid.'\',700,500);}"><img border="0" src="im/dy.png">��ӡ���ⵥ</a>
</span>';
$lie=",��,���,��Ʒ����,��λ,���,�ֿ�,������,����,���,��ע,ɾ��,�޸�";
$wid=",5%,10%,15%,5%,5%,10%,10%,10%,10%,10%,5%,5%";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$dh_id,$tis,$xuh,$yul);
?>
</body>
<script type="text/javascript" src="inc/ZeroClipboard.js"></script>
<script type="text/javascript">
var clip1= null;
clip1 = new ZeroClipboard.Client();
clip1.setHandCursor(true);
clip1.setText('<?php echo $_REQUEST['dhid'];?>;p01.fr3;0;1;1;=)(=');
clip1.glue('c1');
</script>
<script language ="javascript">
function sub()
{
	if(window.IFrm.cpid.value=="")
		layer.msg('��ѡ���Ʒ!');
	else if(window.IFrm.dj.value=="")
		layer.msg('���۲���Ϊ��!');
	else
	{
		window.IFrm.submit();
		window.IFrm.reset();
		window.IFrm.spdm.focus();
	}
}
function tianc(id)//�ύ��ϸ����
{
	window.hqlist.Frm.ssid.value=id;
	window.hqlist.Frm.submit();
	javascript:location.replace(location.href);//����תˢ��
}
function startRequest(spbh,id)//�������Ʒid����Cs_SellAjax.phpֱ�ӵõ���Ʒ������ģ������
{
	createXMLHttpRequest();
	xmlHttp.open("post","AjaxCp.php",true);//�ύ���ؽ����phpҳ��
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-Type","text/xml");
	xmlHttp.setRequestHeader("Content-Type","gb2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState == 4)
		{
			if (xmlHttp.status == 200)
			{
			var arrTmp= xmlHttp.responseText.split("@");//����@�ָ�ķ��ؽ���ֿ�������Ӧ��ֵ
			document.getElementById("cpid").value=arrTmp[0];
			document.getElementById("cpmc").value=arrTmp[1];
			document.getElementById("dj").value=arrTmp[2];
			window.IFrm.songhl.select();
			window.IFrm.songhl.focus();
CloseTipDiv();
			}
		}
	};
	xmlHttp.send("spbh="+spbh+"&id="+id);//���ݸ�phpҳ��Ĳ���
}
var tt=document.getElementById('spdm');
if(tt){document.getElementById('spdm').select();document.getElementById('spdm').focus();}
</script>
