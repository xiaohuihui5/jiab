<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
?>
<head>
<title>商品猪采购单</title>
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
$menuright=menuright(77);//取得菜单权限
//取得单号信息
$query="select dh.dh,CONVERT(varchar(10),dh.dhrq,120),unit.shortname,dh.lury,dh.bz,dh.zt,dh.gysid,unit.typec,cp.mc from sys_maozdh dh,sys_unit unit,sys_cp cp where dh.gysid=unit.id and dh.id=".$_REQUEST['dhid']." and cp.id=".$_REQUEST['cpid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$khid=$line[6];
$khflid=$line[7];
$dh_zt=$line[5];
$R_Q=$line[1];
$cpmc=$line[8];
$tis.="&nbsp;&nbsp;日期:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;供应商:<font color=black>".$line[2]."</font>";
$tis.="&nbsp;&nbsp;品种:<font color=black>".$line[8]."</font>";
sqlsrv_free_stmt($result);
//取得单号信息
$tit='';
$lur='';
$cha='';
$lnk='';
$tis.='&nbsp;&nbsp;&nbsp;<a href="javascript:update()" class="btn btn-success radius"> F8 保存</a>';
$lie=",序,重量(斤),删";
$wid=",30%,40%,30%";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$_REQUEST['dhid']."&cpid=".$_REQUEST['cpid'],$tis,$xuh,$yul);
?>
</body>
<script language="javascript">
function update()//提交明细保存
{
	window.hqlist.Frm.submit();
	//javascript:location.replace(location.href);//不跳转刷新
} 
</script>
