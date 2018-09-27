<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
$cpid="0";
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="inc/rank.js"></script>
<SCRIPT LANGUAGE="JavaScript"> function hotkey() { var a=window.event.keyCode; if(a==13) {openwindow('<?php echo $xiam;?>Add.php',310,350,300,100);} }document.onkeydown = hotkey;</SCRIPT>
</head>
<body>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="shid" value="0">
<input type="hidden" name="gysid" value="<?php echo isset($_POST['gysid'])?$_POST['gysid']:"";?>">
<input type="hidden" name="zhuz" value="<?php echo isset($_POST['zhuz'])?$_POST['zhuz']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php 
if(isset($_POST['dt1']) and $_POST['dt1']!="")//此处不保存$_SESSION['DT1']是为了不影响新增单的日期
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
	$TJ=" and dh.dhrq between '".$_POST['dt1']."' and '".$_POST['dt2']."' ";
}
else
	$TJ=" and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['gongsid']) and $_POST['gongsid']!="")
	$TJ.=" and dh.gongsid='".$_POST['gongsid']."' ";
$_SESSION['TJ']=$TJ;
?>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="100%" style="text-align:center">毛猪采购表</th>
</table>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="15%" style="text-align:center">品种</th>
<th width="15%" style="text-align:center">供应商</th>
<th width="10%" style="text-align:center">头数</th>
<th width="10%" style="text-align:center">总重</th>
<th width="10%" style="text-align:center">单价</th>
<th width="10%" style="text-align:center">金额</th>
<th width="10%" style="text-align:center">费用</th>
<th width="5%" style="text-align:center">头均损耗</th>
<th width="5%" style="text-align:center">扣损耗</th>
<th width="10%" style="text-align:center">采购成本</th>
</table>
<?php 
$_SESSION['mac']="select cp.id,cp.mc,unit.shortname,sum(sj.sl),sum(sj.songhl),cast(sum(sj.shisje)/sum(sj.songhl) as decimal(10,2)),sum(sj.shisje),sum(sj.feiy),cast((sum(isnull(dh.zzl,0))-sum(sj.songhl))/sum(sj.sl) as decimal(10,1)),sum(dh.koush),sum(sj.shisje)+sum(isnull(sj.feiy,0))-sum(isnull(dh.koush,0)) from sys_maozdh dh,sys_unit unit,sys_maozsj sj,sys_cp cp where dh.lx=9 and dh.gysid=unit.id and dh.id=sj.dhid ".$TJ." and sj.cpid=cp.id group by cp.id,cp.mc,unit.shortname order by cp.mc,unit.shortname";
$_SESSION['mac'].="#"."2,0,0,1,1,0,1,1,1,1,1";
$_SESSION['mac'].="#".",15%,15%,10%,10%,10%,10%,10%,5%,5%,10%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,right,right,center";
$_SESSION['mac'].="#".",品种,供应商,头数,重量,单价,金额,费用,损耗,扣损耗,实际猪款";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."毛猪购销汇总表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
//include("./inc/xdis2.php");
?>
<table border="0" class="tableborder3">
<?php 
$CS=explode("#",$_SESSION['mac']);
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$ZJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$XJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$DJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$Column=count($HJ);
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1="";
$tp2="";
$mid[1]=0;
while($line=sqlsrv_fetch_array($result))
{
	$cpid.=",".$line[0];
	$zcb[$line[0]]+=$line[10];
	$zzl[$line[0]]+=$line[4];
	if($line[1]!=$tp1)
	{
	$tw=8;
	if($tp1!="")
	{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";


				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
			}//补最里层小计
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//大于1行才出合计
			{
				$end[1].='<tr  onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' 合计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[1].="<td  width=".$KD[$i]." align=right><font color=red>".$ZJ[$i]."</td>";
				else
					$end[1].="<td width=".$KD[$i]." ></td>";
				}
				$end[1].="</tr>";
			}
	echo $beg[1],$mid[1],$beg[3],$mid[3],$end[3],$end[1];

	for($i=$HJ[0]+1;$i<$Column;$i++)
		{
		$XJ[$i]=0;
		$ZJ[$i]=0;
		}
	}
	$beg[1]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'  rowspan=';
	$mid[1]=1;
	$beg[3]=">".$line[1]."</td>";
	$beg[3].="<td width=".$KD[2]." align=".$AL[2]." rowspan=";
	$mid[3]=1;
	$end[3]=">".$line[2]."</td>";
	$end[1]="";
	for($i=3;$i<$Column;$i++)
		{
			$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	$tp2=$line[2];
	$beg[2]="";
	$mid[2]="";
	$end[2]="";
	}
	else
	{
		if($line[2]!=$tp2)
		{
			if(($mid[3]>1)and($tw==8))//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td  width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			else if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			for($i=$HJ[0]+1;$i<$Column;$i++)
				$XJ[$i]=0;
			if($tp2!="")
				$end[1].=$beg[2].$mid[2].$end[2];

	$beg[2]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[2].' align='.$AL[2].' rowspan=';
	$mid[2]=1;
	$mid[1]++;
	$end[2]=">".$line[2]."</td>";

	for($i=3;$i<$Column;$i++)
		{
			$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[2].="</tr>";
	$tw=0;
		}
		else
		{
	$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">';
	for($i=3;$i<$Column;$i++)
		{
			$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[2].="</tr>";
	$mid[1]++;
	if($tw==8)
		$mid[3]++;
	else
		$mid[2]++;
		}
	$tp2=$line[2];
	}
$tp1=$line[1];
for($i=1;$i<$Column;$i++)//小计,中计,总计
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		$DJ[$i]+=$line[$i];
		}
	}
}//while语句结束
sqlsrv_free_stmt($result);
if($mid[1]!==0)
{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
			}//补最里层小计
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//大于1行才出合计
			{
				$end[1].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' 合计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[1].="<td width=".$KD[$i]."  align=right><font color=red>".$ZJ[$i]."</td>";
				else
					$end[1].="<td width=".$KD[$i]." ></td>";
				}
				$end[1].="</tr>";
			}
	echo $beg[1],$mid[1],$beg[3],$mid[3],$end[3],$end[1];
if($tp1!="")
	{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan=',$HJ[0],'  align=center><font color=red>总合计</font></td>';

			for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					echo "<td width=",$KD[$i],"  align=right><font color=red>",$DJ[$i],"</td>";
				else
					echo "<td width=",$KD[$i]," ></td>";
				}
				echo "</tr>";
	}
}
?>
</table>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="100%" style="text-align:center">毛猪销售表</th>
</table>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="15%" style="text-align:center">品种</th>
<th width="15%" style="text-align:center">客户</th>
<th width="10%" style="text-align:center">头数</th>
<th width="10%" style="text-align:center">重量</th>
<th width="10%" style="text-align:center">单价</th>
<th width="10%" style="text-align:center">费用</th>
<th width="10%" style="text-align:center">销售金额</th>
<th width="10%" style="text-align:center">实收金额</th>
<th width="10%" style="text-align:center">减尾数</th>
</table>
<?php 
$_SESSION['mac']="select cp.id,cp.mc,unit.shortname,sum(dh.tous),sum(dh.daohzl),cast(sum(dh.jine)/sum(dh.daohzl) as decimal(10,2)),sum(dh.yunzf),sum(dh.jine),sum(dh.ssje),case sum(dh.jine-dh.ssje) when 0 then '--' else cast(sum(dh.jine-dh.ssje) as varchar) end from sys_shengz dh,sys_unit unit,sys_cp cp where dh.pinz=cp.id and dh.unit=unit.id and dh.lx=19 ".$TJ." group by cp.id,cp.mc,unit.shortname order by cp.mc,unit.shortname";
$_SESSION['mac'].="#"."2,0,0,1,1,0,1,1,1,1";
$_SESSION['mac'].="#".",15%,15%,10%,10%,10%,10%,10%,10%,10%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,right,right,center";
$_SESSION['mac'].="#".",品种,客户,头数,重量,单价,费用,销售金额,实收金额,减尾数";
$_SESSION['mac'].="#".$_SESSION['DT1']."至".$_SESSION['DT2']."毛猪购销汇总表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
//include("./inc/xdis2.php");
?>
<table border="0" class="tableborder3">
<?php 
$CS=explode("#",$_SESSION['mac']);
$HJ=explode(",",$CS[1]);
$KD=explode(",",$CS[2]);
$AL=explode(",",$CS[3]);
$ZJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$XJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$DJ=explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0");
$Column=count($HJ);
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1="";
$tp2="";
$mid[1]=0;
while($line=sqlsrv_fetch_array($result))
{
	$cpid.=",".$line[0];
	$zje[$line[0]]+=$line[8]-$line[6];//实收金额要减掉费用才计算成本
	$sell_zzl[$line[0]]+=$line[4];
	if($line[1]!=$tp1)
	{
	$tw=8;
	if($tp1!="")
	{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";


				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
			}//补最里层小计
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//大于1行才出合计
			{
				$end[1].='<tr  onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' 合计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[1].="<td  width=".$KD[$i]." align=right><font color=red>".$ZJ[$i]."</td>";
				else
					$end[1].="<td width=".$KD[$i]." ></td>";
				}
				$end[1].="</tr>";
			}
	echo $beg[1],$mid[1],$beg[3],$mid[3],$end[3],$end[1];

	for($i=$HJ[0]+1;$i<$Column;$i++)
		{
		$XJ[$i]=0;
		$ZJ[$i]=0;
		}
	}
	$beg[1]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[1].' align='.$AL[1].'  rowspan=';
	$mid[1]=1;
	$beg[3]=">".$line[1]."</td>";
	$beg[3].="<td width=".$KD[2]." align=".$AL[2]." rowspan=";
	$mid[3]=1;
	$end[3]=">".$line[2]."</td>";
	$end[1]="";
	for($i=3;$i<$Column;$i++)
		{
			$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	$tp2=$line[2];
	$beg[2]="";
	$mid[2]="";
	$end[2]="";
	}
	else
	{
		if($line[2]!=$tp2)
		{
			if(($mid[3]>1)and($tw==8))//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td  width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			else if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			for($i=$HJ[0]+1;$i<$Column;$i++)
				$XJ[$i]=0;
			if($tp2!="")
				$end[1].=$beg[2].$mid[2].$end[2];

	$beg[2]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[2].' align='.$AL[2].' rowspan=';
	$mid[2]=1;
	$mid[1]++;
	$end[2]=">".$line[2]."</td>";

	for($i=3;$i<$Column;$i++)
		{
			$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[2].="</tr>";
	$tw=0;
		}
		else
		{
	$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">';
	for($i=3;$i<$Column;$i++)
		{
			$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[2].="</tr>";
	$mid[1]++;
	if($tw==8)
		$mid[3]++;
	else
		$mid[2]++;
		}
	$tp2=$line[2];
	}
$tp1=$line[1];
for($i=1;$i<$Column;$i++)//小计,中计,总计
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		$DJ[$i]+=$line[$i];
		}
	}
}//while语句结束
sqlsrv_free_stmt($result);
if($mid[1]!==0)
{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
			}//补最里层小计
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//大于1行才出合计
			{
				$end[1].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' 合计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[1].="<td width=".$KD[$i]."  align=right><font color=red>".$ZJ[$i]."</td>";
				else
					$end[1].="<td width=".$KD[$i]." ></td>";
				}
				$end[1].="</tr>";
			}
	echo $beg[1],$mid[1],$beg[3],$mid[3],$end[3],$end[1];
if($tp1!="")
	{
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan=',$HJ[0],'  align=center><font color=red>总合计</font></td>';

			for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					echo "<td width=",$KD[$i],"  align=right><font color=red>",$DJ[$i],"</td>";
				else
					echo "<td width=",$KD[$i]," ></td>";
				}
				echo "</tr>";
	}
}
?>
</table>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="100%" style="text-align:center">毛猪销售毛利表</th>
</table>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="20%" style="text-align:center">品种</th>
<th width="20%" style="text-align:center">销售额</th>
<th width="20%" style="text-align:center">总成本</th>
<th width="20%" style="text-align:center">毛利额</th>
<th width="20%" style="text-align:center">毛利率</th>
</table>
<table border="0" class="tableborder3">
<?php 
$query="select cp.id,cp.mc from sys_cp cp where cp.id in(".$cpid.") order by cp.mc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$junj[$line[0]]=sprintf("%1.2f",$zcb[$line[0]]/$zzl[$line[0]]);
	$sell_zcb[$line[0]]=sprintf("%1.2f",$sell_zzl[$line[0]]*$junj[$line[0]]);
	echo "<tr>
<td align=center width=20%><font color=blue>".$line[1]."</font></td>
<td align=center width=20%><font color=blue>".$zje[$line[0]]."</font></td>
<td align=center width=20%><font color=blue>".$sell_zcb[$line[0]]."</font></td>
<td align=center width=20%><font color=blue>".sprintf("%1.2f",$zje[$line[0]]-$sell_zcb[$line[0]])."</font></td>
<td align=center width=20%><font color=blue>".sprintf("%1.2f",($zje[$line[0]]-$sell_zcb[$line[0]])/$zje[$line[0]]*100)."%</font></td>
</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>
</body>
<script defer="defer">setscroll();</script>
