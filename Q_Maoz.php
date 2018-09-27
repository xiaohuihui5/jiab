<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$query='select gongsids from sys_user where empid='.$_SESSION['empid'];//取得有操作权限的业务点
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
if($line[0]!="")
	$TJ=" and id in(".$line[0].")";
sqlsrv_free_stmt($result);

$query='select id,fenlmc from sys_maozfd where id>0 '.$TJ.' order by id';
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$gsid.='<option value='.$line[0].'>'.$line[1].'</option>';
}       
sqlsrv_free_stmt($result);
?>
<html>
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
</head>
<style>.text-c th{background:#ccc;border-bottom:none;font-size:14px;}
</style>
</head>
<body>
<?php
$menuright=menuright(56);//取得菜单权限
$tit='查询统计 <span class="c-gray en">&gt;</span> 毛猪购销汇总';
$lur='<div class="text-c">日期：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>至<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>';
$lur.=' <select class="select-box" style="width:90px;height:31px;text-align:center;" name="gongsid"><option value="">毛猪分点</option>'.$gsid.'</select><input name="paix" id="paix" type="hidden">  <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 毛猪购销汇总表</a> </span>';
$lnk.='<span class="r"> <a href="Q_Maoz_excel.php" class="btn radius"><img border=0 src=im/daoc.png>导出</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>打印</a> </span> ';
$cha='';
$lie='';
$wid='';
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam.'1.php',$tis,$xuh,$yul);
?>
</body>
</html>
<script lanuage ="javascript">window.Frm.cxtj.focus();</script>

