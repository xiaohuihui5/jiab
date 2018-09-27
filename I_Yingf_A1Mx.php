<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
?>
<head>
<title>付款明细</title>
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
$query="select dh.fukdh,convert(varchar(10),dh.fukrq,120),convert(varchar(10),dh.rq,120),unit.shortname,dh.yingfk,dh.shifk,case dh.lx when 1 then '正常' else '已作废' end,dh.lury from sys_fuksj dh,sys_unit unit where dh.gysid=unit.id and dh.id=".$_REQUEST['dh_id'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$fukdh=$line[0];
$yf=$line[4];
$sf=$line[5];
$zt=$line[6];
$tis="&nbsp;&nbsp;付款日期:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;制单日期:<font color=black>".$line[2]."</font>";
$tis.="&nbsp;&nbsp;供应商:<font color=black>".$line[3]."</font>";
$tis.="&nbsp;&nbsp;制单:<font color=black>".$line[7]."</font>";
sqlsrv_free_stmt($result);
//取得单号信息
$tit='';
$lur='<table width=100%><tr><td align=center><font size=5 color=black>应付:</font><font size=5 color=red>'.$yf.'</font>&nbsp;&nbsp;&nbsp;<font size=5 color=black>实付:</font><font size=5 color=red>'.$sf.'</font>&nbsp;&nbsp;&nbsp;<font size=5 color=black>状态:</font><font size=5 color=red>'.$zt.'</font></td></tr></table>';
$cha='';
$lnk='';
$lie=",序,单号,日期,金额,备注";
$wid=",20%,20%,20%,20%,20%";
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$fukdh,$tis,$xuh,$yul);
?>
</body>
