<?php 
require("inc/xhead.php");
header("Content-Disposition: attachment; filename=".$_SESSION['DT1']."��".$_SESSION['DT2']."ë����ͳ�Ʊ�.xls");
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
<th width="100%" style="text-align:center" colspan=10>ë��ɹ���</th>
</table>
<table border=1>
<th width="15%" style="text-align:center">Ʒ��</th>
<th width="15%" style="text-align:center">��Ӧ��</th>
<th width="10%" style="text-align:center">ͷ��</th>
<th width="10%" style="text-align:center">����</th>
<th width="10%" style="text-align:center">����</th>
<th width="10%" style="text-align:center">���</th>
<th width="10%" style="text-align:center">����</th>
<th width="5%" style="text-align:center">ͷ�����</th>
<th width="5%" style="text-align:center">�����</th>
<th width="10%" style="text-align:center">�ɹ��ɱ�</th>
</table>
<?php 
$_SESSION['mac']="select cp.id,cp.mc,unit.shortname,sum(sj.sl),sum(sj.songhl),cast(sum(sj.shisje)/sum(sj.songhl) as decimal(10,2)),sum(sj.shisje),sum(sj.feiy),cast((sum(isnull(dh.zzl,0))-sum(sj.songhl))/sum(sj.sl) as decimal(10,1)),sum(dh.koush),sum(sj.shisje)+sum(isnull(sj.feiy,0))-sum(isnull(dh.koush,0)) from sys_maozdh dh,sys_unit unit,sys_maozsj sj,sys_cp cp where dh.lx=9 and dh.gysid=unit.id and dh.id=sj.dhid ".$TJ." and sj.cpid=cp.id group by cp.id,cp.mc,unit.shortname order by cp.mc,unit.shortname";
$_SESSION['mac'].="#"."2,0,0,1,1,0,1,1,1,1,1";
$_SESSION['mac'].="#".",15%,15%,10%,10%,10%,10%,10%,5%,5%,10%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,center,right,right,center";
$_SESSION['mac'].="#".",Ʒ��,��Ӧ��,ͷ��,����,����,���,����,���,�����,ʵ�����";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."ë�������ܱ�";
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
			if($mid[2]>1)//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
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
			}//�������С��
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//����1�вų��ϼ�
			{
				$end[1].='<tr  onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' �ϼ�</font></td>';
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
			if(($mid[3]>1)and($tw==8))//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td  width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			else if($mid[2]>1)//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
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
for($i=1;$i<$Column;$i++)//С��,�м�,�ܼ�
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		$DJ[$i]+=$line[$i];
		}
	}
}//while������
sqlsrv_free_stmt($result);
if($mid[1]!==0)
{
			if($mid[2]>1)//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
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
			}//�������С��
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//����1�вų��ϼ�
			{
				$end[1].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' �ϼ�</font></td>';
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
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan=',$HJ[0],'  align=center><font color=red>�ܺϼ�</font></td>';

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
<th width="100%" style="text-align:center" colspan=10>ë�����۱�</th>
</table>
<table border=1>
<th width="15%" style="text-align:center">Ʒ��</th>
<th width="15%" style="text-align:center">�ͻ�</th>
<th width="10%" style="text-align:center">ͷ��</th>
<th width="10%" style="text-align:center">����</th>
<th width="10%" style="text-align:center">����</th>
<th width="10%" style="text-align:center">����</th>
<th width="10%" style="text-align:center">���۽��</th>
<th width="10%" style="text-align:center">ʵ�ս��</th>
<th width="10%" colspan=2 style="text-align:center">��β��</th>
</table>
<?php 
$_SESSION['mac']="select cp.id,cp.mc,unit.shortname,sum(dh.tous),sum(dh.daohzl),cast(sum(dh.jine)/sum(dh.daohzl) as decimal(10,2)),sum(dh.yunzf),sum(dh.jine),sum(dh.ssje),case sum(dh.jine-dh.ssje) when 0 then '--' else cast(sum(dh.jine-dh.ssje) as varchar) end from sys_shengz dh,sys_unit unit,sys_cp cp where dh.pinz=cp.id and dh.unit=unit.id and dh.lx=19 ".$TJ." group by cp.id,cp.mc,unit.shortname order by cp.mc,unit.shortname";
$_SESSION['mac'].="#"."2,0,0,1,1,0,1,1,1,1";
$_SESSION['mac'].="#".",15%,15%,10%,10%,10%,10%,10%,10%,10%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,right,right,center";
$_SESSION['mac'].="#".",Ʒ��,�ͻ�,ͷ��,����,����,����,���۽��,ʵ�ս��,��β��";
$_SESSION['mac'].="#".$_SESSION['DT1']."��".$_SESSION['DT2']."ë�������ܱ�";
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
			if($mid[2]>1)//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
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
			}//�������С��
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//����1�вų��ϼ�
			{
				$end[1].='<tr  onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' �ϼ�</font></td>';
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
			if(($mid[3]>1)and($tw==8))//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else
					$end[2].="<td  width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			else if($mid[2]>1)//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
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
for($i=1;$i<$Column;$i++)//С��,�м�,�ܼ�
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		$DJ[$i]+=$line[$i];
		}
	}
}//while������
sqlsrv_free_stmt($result);
if($mid[1]!==0)
{
			if($mid[2]>1)//�������С��
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.$tp2.' С��</font></td>';
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
			}//�������С��
	if($end[2]!="")
		$end[1].=$beg[2].$mid[2].$end[2];
			if($mid[1]>1)//����1�вų��ϼ�
			{
				$end[1].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.$HJ[0].'  align=center><font color=red>'.$tp1.' �ϼ�</font></td>';
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
		echo '<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan=',$HJ[0],'  align=center><font color=red>�ܺϼ�</font></td>';

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
<th width="100%" style="text-align:center" colspan=10>ë����</th>
</table>
<table border=1>
<th style="text-align:center" colspan=2>Ʒ��</th>
<th style="text-align:center" colspan=2>���۶�</th>
<th style="text-align:center" colspan=2>�ܳɱ�</th>
<th style="text-align:center" colspan=2>ë����</th>
<th style="text-align:center" colspan=2>ë����</th>
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
