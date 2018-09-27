<?php 
require("inc/xhead.php");
header("Content-Disposition: attachment; filename=".$_SESSION['DT1']."至".$_SESSION['DT2']."毛猪购销统计表.xls");
header("Content-Type: application/force-download");
$cpid="0";
$TJ=$_SESSION['TJ'];
?>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=gb2312" />
<style>
table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.39in .2in .39in .2in;
	mso-header-margin:0in;
	mso-footer-margin:0in;
	mso-horizontal-page-align:center;}
</style>
</head>
<body>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">
<th width="100%" style="text-align:center" colspan=10>毛猪采购表</th>
</table>
<table border=1>
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
?>
<table border="1">
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
<table border=1>
<th width="100%" style="text-align:center" colspan=10>毛猪销售表</th>
</table>
<table border=1>
<th width="15%" style="text-align:center">品种</th>
<th width="15%" style="text-align:center">客户</th>
<th width="10%" style="text-align:center">头数</th>
<th width="10%" style="text-align:center">重量</th>
<th width="10%" style="text-align:center">单价</th>
<th width="10%" style="text-align:center">费用</th>
<th width="10%" style="text-align:center">销售金额</th>
<th width="10%" style="text-align:center">实收金额</th>
<th width="10%" colspan=2 style="text-align:center">减尾数</th>
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
<table border=1>
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
	$zje[$line[0]]+=$line[8]-$line[6];
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
<table border=1>
<th width="100%" style="text-align:center" colspan=10>毛利表</th>
</table>
<table border=1>
<th style="text-align:center" colspan=2>品种</th>
<th style="text-align:center" colspan=2>销售额</th>
<th style="text-align:center" colspan=2>总成本</th>
<th style="text-align:center" colspan=2>毛利额</th>
<th style="text-align:center" colspan=2>毛利率</th>
</table>
<table border=1>
<?php 
$query="select cp.id,cp.mc from sys_cp cp where cp.id in(".$cpid.") order by cp.mc";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$junj[$line[0]]=sprintf("%1.2f",$zcb[$line[0]]/$zzl[$line[0]]);
	$sell_zcb[$line[0]]=sprintf("%1.2f",$sell_zzl[$line[0]]*$junj[$line[0]]);
	echo "<tr>
<td align=center colspan=2><font color=blue>".$line[1]."</font></td>
<td align=center colspan=2><font color=blue>".$zje[$line[0]]."</font></td>
<td align=center colspan=2><font color=blue>".$sell_zcb[$line[0]]."</font></td>
<td align=center colspan=2><font color=blue>".sprintf("%1.2f",$zje[$line[0]]-$sell_zcb[$line[0]])."</font></td>
<td align=center colspan=2><font color=blue>".sprintf("%1.2f",($zje[$line[0]]-$sell_zcb[$line[0]])/$zje[$line[0]]*100)."%</font></td>
</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>
</TBODY></TABLE></DIV></BODY></HTML>
