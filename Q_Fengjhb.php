<?php require('./inc/xhead.php');require('./inc/xpage_uplib.php');?>
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
<BODY>
<?php
$tit='查询统计 <span class="c-gray en">&gt;</span> 分割计划表';
$lur='<div class="text-c">送货日期：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.date('Y-m-d',strtotime("+1 day")).'"/>';
$lur.=' 计划分割头数：<input type="text" class="input-text" onkeydown="if(event.keyCode==13)window.Frm.junz.foucs();" style="width:100px" placeholder="计划分割头数" id=""  name="jihts"/> 毛猪均重/斤：<input type="text" class="input-text" style="width:80px" placeholder="毛猪均重" id=""  name="junz"/> <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>';
$lnk='<span class="l"><a href="'.$xiam.'.php"  class="btn radius"><img border=0 src=im/zhuy.png> 分割计划表</a> </span>';
$lnk.='<span class="r"> <a href="xExcel.php" class="btn radius"><img border=0 src=im/daoc.png>导出</a> <a href="javascript:openwindow(\'xPrint.php\',850,500)" class="btn radius"><img border=0 src=im/dy.png>打印</a> </span> ';
$cha='';
$lie=',序,生产分类,订货量,需生产量,屠宰分割量,差异量,分割头数,分割比例(头/占%比),分割差额头数';
$wid=',5%,10%,10%,10%,10%,15%,10%,15%,15%';
$xuh='';
$tis='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php",$tis,$xuh,$yul);
?>
</body>
</html>
<script lanuage ="javascript">
function sub()
{
	if(window.Frm.cxtj.value=="")
		alert('请输入计划分割头数!');
	else
	{
		openload();
		window.Frm.submit();
	}
}
</script>
window.Frm.cxtj.focus();
window.Frm.cxtj.select();
