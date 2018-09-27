<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
$pinz='<select class="select" size="1" id="zhuz" name="zhuz" onkeydown="if(event.keyCode==13) window.Frm.sl.select();" style="width:100px;height:30px;">';
$query="select id,mc from sys_cp where typec=1 and yn=1";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$pinz.='<option value="'.$line[0].'">'.$line[1].'</option>';
}
sqlsrv_free_stmt($result);
$pinz.='</select>';
?>
<head>
<title>毛猪采购单</title>
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
<script language="javascript">window.onbeforeunload = function(){window.parent.opener.Frm.submit();}</script><!--关闭页面刷新单号页面-->
<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:0px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 0px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:30px!important;}
.seldiv {width:400;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
.user{
background-image: url(im/day.png);/*设置小图标*/
background-position: 5px 6px;/*小图标在input的位置*/
background-repeat: no-repeat;/*背景小图标不重复*/
}
</STYLE>
<script type="text/javascript" src="xSelpmMohu_jg.js"></script>
<script language="javascript">
document.onkeydown=bb;function bb()
{var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}if(nKeyCode==120) {SelCp(1);}
}
</script>
</head>
<body>
<?php
$menuright=menuright(25);//取得菜单权限
//取得单号信息
$query="select dh.dh,CONVERT(varchar(10),dh.dhrq,120),unit.shortname,dh.lury,dh.bz,dh.zt,dh.gysid,unit.typec from sys_maozdh dh,sys_unit unit where dh.gysid=unit.id and dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$khid=$line[6];
$khflid=$line[7];
$dh_zt=$line[5];
$R_Q=$line[1];
$tis="&nbsp;&nbsp;单号:<font color=black>".$line[0]."</font>";
$tis.="&nbsp;&nbsp;日期:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;供应商:<font color=black>".$line[2]."</font>";
$tis.="&nbsp;&nbsp;制单:<font color=black>".$line[3]."</font>";
$tis.="&nbsp;&nbsp;备注:<font color=black>".$line[4]."</font>";
sqlsrv_free_stmt($result);
//取得单号信息
$tit='';
if($menuright>0 and $dh_zt==0)//录入
{
$lur='
<table class="hetable" align="center" style="width:30%"><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm">
<tr>
<td algin=center><div class="text-c">品种</div></td>
<td algin=center><div class="text-c">净重</div></td>
<td algin=center><div class="text-c"></div></td>
</tr>
<tr>
<td algin=center><div class="text-c">
<input type="hidden" name="dhid" value="'.$_REQUEST['dhid'].'">
<input type="hidden" name="khid" id="khid" value="'.$khid.'">
'.$pinz.'
</div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:100px" id="jz" name="jz" onkeydown="if(event.keyCode==13)sub();"></div></td>
<td algin=center><div class="text-c"><input class="btn btn-success radius" style="height:30px;width:75px;" type="button" value="增&nbsp;加" onclick="sub();"></div></td>
</tr>
</form>
</table>';
}
else
	$lur='<table width=100%><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm"><tr><td align=center><font size=5 color=red>查询权限/此单已审核</font></td></tr></form></table>';
$cha='';
$lnk='<span class="r"><form method="post" name="Frm"></form>
<a href="I_Sell1MxExcel.php?dhid='.$_REQUEST['dhid'].'"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png> 导出</a> 
<input id="c1" type="button" data-clipboard-target="p1" class="btn radius user" value="&nbsp;&nbsp;&nbsp;&nbsp;打印采购单">
</span>';
$tis.='&nbsp;&nbsp;&nbsp;<a href="javascript:update()" class="btn btn-success radius"> F8 保存</a>';
$lie=",品种,头数,总重量,单价,金额,费用,采购商品猪明细,改,删";
$wid=",8%,4%,8%,4%,8%,4%,60%,2%,2%";
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
clip1.setText('<?php echo $_REQUEST['dhid'];?>;p10.fr3;1;0;1;=)(=');
clip1.glue('c1');
</script>
<script language ="javascript">
function update()//提交明细保存
{
	window.hqlist.Frm.submit();
	//javascript:location.replace(location.href);//不跳转刷新
} 
function sub()
{
	window.IFrm.submit();
	window.IFrm.jz.value="";
}
</script>
