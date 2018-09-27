<?php 
include("inc/xhead.php");
?>
<HTML>
<HEAD>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<TITLE>客户预定统计表</TITLE>
<link rel="stylesheet" href="./inc/xdown_1.css" type="text/css">
<style type="text/css">
.fixedHeaderTr {
z-index:10;
position:relative;
top:expression(this.offsetParent.scrollTop);
};
.relativeTag 
{
position:relative;
};
.fixedHeaderCol 
{
background-color:#cccccc;
position:relative;
left:expression(this.parentElement.offsetParent.scrollLeft);
};

.mainDiv 
{
overflow:auto;
scrollbar-face-color:#9999ff;
height:expression((document.body.clientHeight-this.offsetTop-20>this.children[0].offsetHeight)?(this.children[0].offsetHeight+20):(document.body.clientHeight-this.offsetTop-20));
width:expression(document.body.clientWidth-20);
}
</style>
</HEAD>
<?php 
$TJ=" ";
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ=" and dh.lx=2 and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ=" and dh.lx=2 and dh.dhrq='".date('Y-m-d',strtotime("+1 day"))."' ";
if(isset($_POST['khflid']) and $_POST['khflid']!="")
	$TJ.=" and unit.typeb in(".$_POST['khflid'].") ";
if(isset($_POST['khxlid']) and $_POST['khxlid']!="")
	$TJ.=" and unit.typec in(".$_POST['khxlid'].") ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and unit.id in(".$_POST['khid'].") ";
if(isset($_POST['cpxlid']) and $_POST['cpxlid']!="")
	$TJ.=" and cp.typec in(".$_POST['cpxlid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and cp.id in(".$_POST['cpid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and unit.usercode+unit.shortname+dh.dh+cp.bh+cp.mc like '%".$_POST['cxtj']."%' ";
$_SESSION['mac']=$TJ;
?>
<BODY><form action="" method="post" name="Frm">
日期范围：<input type="text" onFocus="WdatePicker({lang:'zh-cn'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:$_SESSION['DT1'];?>">--
<input type="text" onFocus="WdatePicker({lang:'zh-cn'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:$_SESSION['DT2'];?>">
<input id="khflid" name="khflid" type="hidden" value="<?php echo isset($_POST['khflid'])?$_POST['khflid']:"";?>"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="<?php echo isset($_POST['khflmc'])?$_POST['khflmc']:'客户分类';?>" readonly onclick="layer_show2('客户分类选取','Select_KhFl_Md.php','700','600')">  
<input id="khjgid" name="khxlid" type="hidden" value="<?php echo isset($_POST['khxlid'])?$_POST['khxlid']:"";?>"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="<?php echo isset($_POST['khxlmc'])?$_POST['khxlmc']:'客户线路';?>" readonly onclick="layer_show2('客户线路选取','Select_KhXl_Md.php','700','600')">  
<input id="khid" name="khid" type="hidden" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="<?php echo isset($_POST['khmc'])?$_POST['khmc']:'客户选取';?>" readonly  onclick="layer_show2('客户选取','Select_Kh_Md.php','700','600')">
<input id="cpxlid" name="cpxlid" type="hidden" value="<?php echo isset($_POST['cpxlid'])?$_POST['cpxlid']:"";?>"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpxlmc" name="cpxlmc" value="<?php echo isset($_POST['cpxlmc'])?$_POST['cpxlmc']:'产品分类';?>" readonly onclick="layer_show2('二级分类选取','Select_CpXl_Md.php','700','600')">  
<input id="cpid" name="cpid" type="hidden" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="<?php echo isset($_POST['cpmc'])?$_POST['cpmc']:'产品选取';?>" readonly  onclick="layer_show2('产品选取','Select_Cp_Md.php','700','600')">
<input name="paix" id="paix" type="hidden" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>"> <input type="text" class="input-text" style="width:120px" placeholder="输入关键字查找" id=""  name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">   <button type="submit" class="btn btn-success radius" style="height:30px;width:75px;"><img border=0 src=im/search.png> 搜索</button></div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Q_Yudtj_b_Excel.php" class="btn radius"><img border=0 src=im/daoc.png>导出</a>
<?php 
	$cp_id="0";
	$kh_id="0";
	$pm_id="0";
	$query="select sj.khpmid,dh.unit,cast(sum(sj.dinghl*sj.chg) as float),sj.mc,cast(sum(sj.dinghl) as float) from sys_jhdh dh,sys_jhsj sj,sys_unit unit where dh.id=sj.dhid and dh.unit=unit.id ".$TJ." group by sj.mc,dh.unit,sj.khpmid";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$cp_id=$cp_id.",".$line[0];
		$kh_id=$kh_id.",".$line[1];
		$pm_id=$pm_id.",".$line[3];
		if($line[0]==0)
			$Data[$line[3]][$line[1]]=$line[4];
		else
			$Data[$line[0]][$line[1]]=$line[4];
		$dfl_dingh[$line[3]]+=$line[2];
	}
	sqlsrv_free_stmt($result);
?>
<BR>
<DIV class="mainDiv" id="mailContainerDiv">
<table width="100%" cellspacing=0 border=1 style="margin-top:-2;margin-left:-1">
<TR class="fixedHeaderTr" style="background:#B0E2FF;color:#36648B;">
	<td class="fixedHeaderCol" noWrap style="background:#B0E2FF;color:#36648B;" rowspan=2>&nbsp;&nbsp;商品二级分类&nbsp;&nbsp;</td>
	<td class="fixedHeaderCol" noWrap style="background:#B0E2FF;color:#36648B;" rowspan=2>分类合计</td>
	<td class="fixedHeaderCol" noWrap style="background:#B0E2FF;color:#36648B;" rowspan=2>&nbsp;&nbsp;商品名称&nbsp;&nbsp;</td>
	<td class="fixedHeaderCol" noWrap style="background:#B0E2FF;color:#36648B;" rowspan=2>单位</td>
	<td class="fixedHeaderCol" noWrap style="background:#B0E2FF;color:#36648B;" rowspan=2>&nbsp;合计&nbsp;</td>
<?php 
	$query="select count(*),unit.typec from sys_unit unit where unit.id in(".$kh_id.") group by unit.typec";
	$result=sqlsrv_query($conn,$query);
	$xl_id="0";
	while($line=sqlsrv_fetch_array($result))
	{
		$xl_id=$xl_id.",".$line[1];
		$xl_kh[$line[1]]=$line[0];//取出每条线路有多少个客户
	}
	sqlsrv_free_stmt($result);

	$query="select xl.fenlmc,xl.id from sys_khxianl xl where xl.id in(".$xl_id.") order by xl.id";
	$result=sqlsrv_query($conn,$query);
	$TMP_STR="";
	while($line=sqlsrv_fetch_array($result))
	{
		$TMP_STR=$TMP_STR."<td colspan=".$xl_kh[$line[1]]." align=center><font size=2>".$line[0]."</td>";
	}
	sqlsrv_free_stmt($result);
	echo $TMP_STR."</TR>";//显示线路名称

	$total_kh=0;
	$query="select shortname,id from sys_unit where id in(".$kh_id.") order by typed,usercode";
	$result=sqlsrv_query($conn,$query);
	$TMP_STR="<TR>";
	while($line=sqlsrv_fetch_array($result))
	{
		$total_kh+=1;
		$now_kh[$total_kh]=$line[1];
		$TMP_STR=$TMP_STR."<td><font size=2>".$line[0]."</td>";
	}
	sqlsrv_free_stmt($result);
	echo $TMP_STR;
?>
</tr>
<?php 
$total_cp_hj=0;
$query="select cp.mc,cp.id,cp.gg,cp.dw,fl.fenlmc,fl.id from sys_cp cp,sys_cpxfl fl where cp.id in(".$pm_id.") and cp.typec=fl.id order by fl.bianh,cp.bh";
$result=sqlsrv_query($conn,$query);
$tp1='';
$mid=0;
while($line=sqlsrv_fetch_array($result))
{
		$cp_hj=0;
		for($i=1;$i<=$total_kh;$i++)
				$cp_hj=$cp_hj+$Data[$line[1]][$now_kh[$i]];//产品合计
		$total_cp_hj=$total_cp_hj+$cp_hj;

	if($line[4]!=$tp1)
	{
		if($tp1!='') echo str_replace("@@",$mid,$TMP_STR.'</TR>');
		$TMP_STR='<TR class="relativeTag"><TD class="fixedHeaderCol" rowspan=@@>'.$line[4].'</TD><TD class="fixedHeaderCol" rowspan=@@>'.$dfl_dingh[$line[5]].'</TD><TD class="fixedHeaderCol">'.$line[0].'</TD><TD class="fixedHeaderCol" align=center>'.$line[3].'</TD><TD align=right class="fixedHeaderCol">'.$cp_hj.'</TD>';
		for($i=1;$i<=$total_kh;$i++)
		{
			$Data[0][$now_kh[$i]]=$Data[0][$now_kh[$i]]+$Data[$line[1]][$now_kh[$i]];//客户合计

			if($Data[$line[1]][$now_kh[$i]]!=0)
				$TMP_STR=$TMP_STR.'<td align=right>'.$Data[$line[1]][$now_kh[$i]].'</td>';
			else
				$TMP_STR=$TMP_STR.'<td>&nbsp;</td>';
		}
		$mid=1;
	}
	else
	{
		$TMP_STR=$TMP_STR.'<TR class="relativeTag"><TD class="fixedHeaderCol">'.$line[0].'</TD><TD class="fixedHeaderCol" align=center>'.$line[3].'</TD><TD align=right class="fixedHeaderCol">'.$cp_hj.'</TD>';
		for($i=1;$i<=$total_kh;$i++)
		{
			$Data[0][$now_kh[$i]]=$Data[0][$now_kh[$i]]+$Data[$line[1]][$now_kh[$i]];//客户合计

			if($Data[$line[1]][$now_kh[$i]]!=0)
				$TMP_STR=$TMP_STR.'<td align=right>'.$Data[$line[1]][$now_kh[$i]].'</td>';
			else
				$TMP_STR=$TMP_STR.'<td>&nbsp;</td>';
		}
		$mid++;
	}
$tp1=$line[4];
}
if($mid!=0)	echo str_replace("@@",$mid,$TMP_STR);
sqlsrv_free_stmt($result);

		$TMP_STR='<TR class="relativeTag"><TD colspan=4 class="fixedHeaderCol" align=center><font color=red>总合计</TD><TD align=right class="fixedHeaderCol"><font color=red>'.$total_cp_hj.'</TD>';
		for($i=1;$i<=$total_kh;$i++)
		{
			if($Data[0][$now_kh[$i]]!=0)
				$TMP_STR=$TMP_STR.'<td align=right><font color=red>'.$Data[0][$now_kh[$i]].'</td>';
			else
				$TMP_STR=$TMP_STR.'<td>&nbsp;</td>';
		}
		echo $TMP_STR,'</TR>';
?></TABLE></DIV></form></BODY></HTML>
