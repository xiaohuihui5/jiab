<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
?>
<head>
<title>销售订单-查询</title>
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
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
.user{
background-image: url(im/dy.png);/*设置小图标*/
background-position: 5px 6px;/*小图标在input的位置*/
background-repeat: no-repeat;/*背景小图标不重复*/
}
</STYLE>
</head>
<body>
<?php
//取得单号信息
$query="select dh.dh,CONVERT(varchar(10),dh.dhrq,120),unit.shortname,dh.lury,dh.bz,dh.zt,dh.unit,unit.typeb from sys_jhdh dh,sys_unit unit where dh.unit=unit.id and dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$khid=$line[6];
$khflid=$line[7];
$dh_zt=$line[5];
$R_Q=$line[1];
$tis="&nbsp;&nbsp;单号:<font color=black>".$line[0]."</font>";
$tis.="&nbsp;&nbsp;日期:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;客户名称:<font color=black>".$line[2]."</font>";
$tis.="&nbsp;&nbsp;制单:<font color=black>".$line[3]."</font>";
$tis.="&nbsp;&nbsp;备注:<font color=black>".$line[4]."</font>";
sqlsrv_free_stmt($result);
//取得单号信息
$tit='';
$lur='<table width=100%><tr><td align=center><font size=5 color=red>销售查询--单据明细</font></td></tr></table>';
$cha='';
$lnk='';
$lie=",序,排,编号,商品名称,规格,订货量,副单位,配送量,实收量,单位,单价,金额,备注";
$wid=",4%,4%,6%,15%,8%,7%,5%,7%,7%,5%,7%,8%,17%";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$_REQUEST['dhid'],$tis,$xuh,$yul);
?>
</body>
