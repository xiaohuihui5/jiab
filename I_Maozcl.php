<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$menuright=menuright(29);//ȡ�ò˵�Ȩ��
$query="select id,mc from sys_cp where yn=1 and typeb=1";
$result=sqlsrv_query($conn,$query);
$zhuz='<select class="select-box" style="width:100px;height:31px;" name="pinz">';
while($line=sqlsrv_fetch_array($result))
{
	$zhuz.='<option value='.$line[0].'>'.$line[1].'</option>';
}
$zhuz.='</select>';
?>
<html>
<head>
<title>ë�����¼��</title>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Add();}}</script>
<script language="javascript">
var timesi=0;//window.event.clientX;�˴�������������˵���������
function show(){document.getElementById("menu1").style.display="block";
if(timesi==0){document.getElementById("menu1").style.left=document.getElementById("menu1").offsetLeft*1-60;timesi=1;}}
function hide(){document.getElementById("menu1").style.display="none";}
</script>
</head>
<BODY>
<?php
$tit='ë��ҵ�� <span class="c-gray en">&gt;</span> ë�����';
$lur='<table class="hetable" align=center style="width:40%">
<tr>
<td align=center><div class="text-c">��������</div></td>
<td align=center><div class="text-c">Ʒ��</div></td>
<td align=center><div class="text-c">ͷ��</div></td>
<td align=center><div class="text-c">����</div></td>
<td algin=center><div class="text-c"></div></td>
</tr>
<tr>
<td align=center><div class="text-c"><input onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" value="'.date('Y-m-d').'" style="width:100"></div></td>
<td align=center><div class="text-c">'.$zhuz.'</div></td>
<td align=center><div class="text-c"><input class="input-text" tabindex="2" name="tous" type="text" style="width: 70px" onkeydown="if(event.keyCode==13) window.Frm.zl.focus();"></div></td>
<td align=center><div class="text-c"><input class="input-text" tabindex="3" name="zl" type="text" style="width: 100px" onkeydown="if(event.keyCode==13) sub();"></div></td>
<td algin=center><div class="text-c"><input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;����&nbsp;&nbsp;" onclick="sub();"></div></td>
</tr>
</table>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> ë�����</a></span>';
$lnk.='<span class="r"><a href="javascript:exc();"  title="�������ݵ�Excel��" class="btn radius"><img border=0 src=im/daoc.png>&nbsp;&nbsp; ��&nbsp;&nbsp;��</a></span>'; 
$cha='';
$lie=',��������,Ʒ��,ͷ��,����/��,ͷ����(��/ͷ),ɾ��';
$wid=',15%,20%,20%,20%,20%,5%,';
$tis='';
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$_REQUEST['dhid'],$tis,$xuh,$yul);
?>
</body>
</html>
<script language ="javascript">
function sub()
{
	if(window.Frm.tous.value=="")
		alert('ͷ������Ϊ��!');
	else if(window.Frm.zl.value=="")
		alert('��������Ϊ��!');
	else
	{
		window.Frm.submit();
		window.Frm.reset();
	}
}
</script>
