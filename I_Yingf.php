<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
?>
<head>
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
</head>
<body >
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
<?php
$menuright=menuright(40);//ȡ�ò˵�Ȩ��
$tit='������� <span class="c-gray en">&gt;</span> Ӧ���˿�';
$lur='<div class="text-c"><input id="sel" name="sel" type="hidden" value="1">
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d').'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>
<input id="gysflid" name="gysflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysflmc" name="gysflmc" value="��Ӧ�̷���" readonly onclick="layer_show2(\'��Ӧ�̷���ѡȡ\',\'Select_gysFl_Md.php\',\'700\',\'600\')">  
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="��Ӧ��ѡȡ" readonly  onclick="layer_show2(\'��Ӧ��ѡȡ\',\'Select_gys_Md.php\',\'700\',\'600\')">
<input name="paix" id="paix" type="hidden"> <input type="text" class="input-text" style="width:120px" placeholder="����ؼ��ֲ���" id=""  name="cxtj"/>   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> ����</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> Ӧ���˿�</a></a> 
<a href="I_Yingf_A.php"  class="btn radius"> �Ѹ��˿�</a></a></span>';
$lnk.='<span class="r">';
if($menuright>1)//¼��
$lnk.='<a onclick="Add()" class="btn radius"><img border=0 src=im/add.png> ���ɸ��</a></span>'; 
$cha='';
$lie=',��,����,<input type=checkbox onclick="selall();" style="zoom:100%;">,��Ӧ������,��ע,����,ʵ�ս��,�����';
$wid=',4%,18%,3%,16%,18%,9%,18%,14%';
$xuh=',,3,,5,,7,8,9';
$tis='��������ɰ���Ӧ�����򣬵��Ӧ�пհ״��ɵ���������ϸ!';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
<script lanuage="javascript">
window.Frm.cxtj.focus();
function Add()
{
	var s_id="";
	for(var i=1;i<=window.hqlist.Frm.count.value;i++)
	{
		if(s_id=="" && document.frames['hqlist'].document.getElementById('id'+i).checked)
		{
			s_id=document.frames['hqlist'].document.getElementById('id'+i).value;
		}
		else if(document.frames['hqlist'].document.getElementById('id'+i).checked)
		{
			s_id=s_id+','+document.frames['hqlist'].document.getElementById('id'+i).value;
		}
	}
	if(s_id=="")
		layer.msg('��û��ѡ�񵥾ݣ���ѡ��Ҫ���ɸ���Ĺ�Ӧ�̲ɹ���!');
	else
		layer_show2('������Ӧ�̸��','<?php echo $xiam;?>Add.php?dh_id='+s_id,'450','720'); //���һ�������Ǹ�һ����ʶ�� 
}
function selall()
{
	if(window.Frm.sel.value==1)
	{
		for(var i=1;i<=window.hqlist.Frm.count.value;i++)
		{
			document.frames['hqlist'].document.getElementById('id'+i).checked=true;
		}
		window.Frm.sel.value=2;
	}
	else
	{
		for(var i=1;i<=window.hqlist.Frm.count.value;i++)
		{
			document.frames['hqlist'].document.getElementById('id'+i).checked=false;
		}
		window.Frm.sel.value=1;
	}
} 
</script>
