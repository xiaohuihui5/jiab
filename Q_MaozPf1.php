<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<script language="javascript" src="./inc/xmy.js"></script>
<SCRIPT LANGUAGE="JavaScript"> function hotkey() { var a=window.event.keyCode; if(a==13) { openwindow('<?php echo $xiam;?>Add.php',310,350,300,100);} }document.onkeydown = hotkey;</SCRIPT>
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
if(isset($_POST['zhuz']) and $_POST['zhuz']!="")
	$TJ.=" and dh.pinz='".$_POST['zhuz']."' ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ1=" and unit.shortname like '%".$_POST['cxtj']."%' ";
?>
<?php 
//均价取每天的采购均价
$query="select convert(varchar(10),dh.dhrq,120),dh.pinz,sum(dh.daohzl),sum(dh.jine) from sys_shengz dh where dh.lx=20 ".$TJ." group by convert(varchar(10),dh.dhrq,120),dh.pinz";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$junj[$line[0]][$line[1]]=sprintf("%1.2f",$line[3]/$line[2]);
}       
sqlsrv_free_stmt($result);

$_SESSION['mac']="select dh.id,CONVERT(varchar(10),dh.dhrq,120) as dhrq,unit.shortname,cp.mc,dh.tous,dh.daohzl,dh.chucj,'',dh.jine,'','','',dh.beiz,dh.pinz from sys_shengz dh,sys_unit unit,sys_cp cp where dh.pinz=cp.id and dh.unit=unit.id and dh.lx=19 ".$TJ." order by dh.dhrq";
$_SESSION['mac'].="#"."3,0,0,0,1,1,0,0,1,0,0,0,0";//1表示单击此行后弹出明细窗口
$_SESSION['mac'].="#".",8%,15%,6%,6%,8%,8%,8%,8%,8%,8%,7%,10%";
$_SESSION['mac'].="#".",center,center,center,center,center,center,right,right,right,center,center,left";
$_SESSION['mac'].="#".",日期,销售客户,猪种,头数,重量,销售单价,到场均价,销售金额,成本金额,毛利额,毛利率,备注";
$_SESSION['mac'].="#毛猪销售毛利";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
//require("./inc/xdis2.php");
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
	if($line[1]!=$tp1)
	{
	$tw=8;
	if($tp1!="")
	{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.'&nbsp;'.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else if($i==9)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_cbje."</td>";
				else if($i==10)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_maol."</td>";
				else if($i==11)
					$end[2].="<td  width=".$KD[$i]."  align=center><font color=#FF33CC>".sprintf("%1.2f",$XJ_maol/$XJ[8]*100)."%</td>";
				else
					$end[2].="<td width=".$KD[$i]."></td>";
				}
				$end[2].="</tr>";
				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
				$XJ_cbje=0;
				$XJ_maol=0;
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
				else if($i==9)
					$end[1].="<td  width=".$KD[$i]."  align=right><font color=red>".$ZJ_cbje."</td>";
				else if($i==10)
					$end[1].="<td  width=".$KD[$i]."  align=right><font color=red>".$ZJ_maol."</td>";
				else if($i==11)
					$end[1].="<td  width=".$KD[$i]."  align=center><font color=red>".sprintf("%1.2f",$ZJ_maol/$ZJ[8]*100)."%</td>";
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
		$XJ_cbje=0;
		$XJ_maol=0;
		$ZJ_cbje=0;
		$ZJ_maol=0;
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
			if($i==7)
				$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$junj[$line[1]][$line[13]]."</td>";
			else if($i==9)
				$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",$junj[$line[1]][$line[13]]*$line[5])."</td>";
			else if($i==10)
				$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",$line[8]-$junj[$line[1]][$line[13]]*$line[5])."</td>";
			else if($i==11)
				$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",($line[8]-$junj[$line[1]][$line[13]]*$line[5])/$line[8]*100)."%</td>";
			else
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
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.'&nbsp;'.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else if($i==9)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_cbje."</td>";
				else if($i==10)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_maol."</td>";
				else if($i==11)
					$end[2].="<td  width=".$KD[$i]."  align=center><font color=#FF33CC>".sprintf("%1.2f",$XJ_maol/$XJ[8]*100)."%</td>";
				else
					$end[2].="<td  width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			else if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.'&nbsp;'.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else if($i==9)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_cbje."</td>";
				else if($i==10)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_maol."</td>";
				else if($i==11)
					$end[2].="<td  width=".$KD[$i]."  align=center><font color=#FF33CC>".sprintf("%1.2f",$XJ_maol/$XJ[8]*100)."%</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
			}
			for($i=$HJ[0]+1;$i<$Column;$i++)
				$XJ[$i]=0;
			$XJ_cbje=0;
			$XJ_maol=0;
			if($tp2!="")
				$end[1].=$beg[2].$mid[2].$end[2];
	$beg[2]='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td width='.$KD[2].' align='.$AL[2].' rowspan=';
	$mid[2]=1;
	$mid[1]++;
	$end[2]=">".$line[2]."</td>";
		for($i=3;$i<$Column;$i++)
		{
			if($i==7)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$junj[$line[1]][$line[13]]."</td>";
			else if($i==9)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",$junj[$line[1]][$line[13]]*$line[5])."</td>";
			else if($i==10)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",$line[8]-$junj[$line[1]][$line[13]]*$line[5])."</td>";
			else if($i==11)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",($line[8]-$junj[$line[1]][$line[13]]*$line[5])/$line[8]*100)."%</td>";
			else
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
			if($i==7)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".$junj[$line[1]][$line[13]]."</td>";
			else if($i==9)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",$junj[$line[1]][$line[13]]*$line[5])."</td>";
			else if($i==10)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",$line[8]-$junj[$line[1]][$line[13]]*$line[5])."</td>";
			else if($i==11)
				$end[2].="<td width=".$KD[$i]." align=".$AL[$i].">".sprintf("%1.2f",($line[8]-$junj[$line[1]][$line[13]]*$line[5])/$line[8]*100)."%</td>";
			else
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
		else if($i==9)
		{
			$XJ_cbje+=sprintf("%1.2f",$junj[$line[1]][$line[13]]*$line[5]);
			$ZJ_cbje+=sprintf("%1.2f",$junj[$line[1]][$line[13]]*$line[5]);
			$DJ_cbje+=sprintf("%1.2f",$junj[$line[1]][$line[13]]*$line[5]);
		}
		else if($i==10)
		{
			$XJ_maol+=sprintf("%1.2f",$line[8]-$junj[$line[1]][$line[13]]*$line[5]);
			$ZJ_maol+=sprintf("%1.2f",$line[8]-$junj[$line[1]][$line[13]]*$line[5]);
			$DJ_maol+=sprintf("%1.2f",$line[8]-$junj[$line[1]][$line[13]]*$line[5]);
		}	
}
}//while语句结束
sqlsrv_free_stmt($result);
if($mid[1]!==0)
{
			if($mid[2]>1)//补最里层小计
			{
				$mid[1]=$mid[1]+1;
				$end[2].='<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)"><td colspan='.($HJ[0]-1).'  align=center><font color=#FF33CC>'.$tp1.'&nbsp;'.$tp2.' 小计</font></td>';
				for($i=$HJ[0]+1;$i<$Column;$i++)
				{
				if($HJ[$i]==1)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ[$i]."</td>";
				else if($i==9)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_cbje."</td>";
				else if($i==10)
					$end[2].="<td  width=".$KD[$i]."  align=right><font color=#FF33CC>".$XJ_maol."</td>";
				else if($i==11)
					$end[2].="<td  width=".$KD[$i]."  align=center><font color=#FF33CC>".sprintf("%1.2f",$XJ_maol/$XJ[8]*100)."%</td>";
				else
					$end[2].="<td width=".$KD[$i]." ></td>";
				}
				$end[2].="</tr>";
				for($i=$HJ[0]+1;$i<$Column;$i++)
					$XJ[$i]=0;
				$XJ_cbje=0;
				$XJ_maol=0;
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
				else if($i==9)
					$end[1].="<td  width=".$KD[$i]."  align=right><font color=red>".$ZJ_cbje."</td>";
				else if($i==10)
					$end[1].="<td  width=".$KD[$i]."  align=right><font color=red>".$ZJ_maol."</td>";
				else if($i==11)
					$end[1].="<td  width=".$KD[$i]."  align=center><font color=red>".sprintf("%1.2f",$ZJ_maol/$ZJ[8]*100)."%</td>";
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
				else if($i==9)
					echo "<td  width=".$KD[$i]."  align=right><font color=red>".$DJ_cbje."</td>";
				else if($i==10)
					echo "<td  width=".$KD[$i]."  align=right><font color=red>".$DJ_maol."</td>";
				else if($i==11)
					echo "<td  width=".$KD[$i]."  align=center><font color=red>".sprintf("%1.2f",$DJ_maol/$DJ[8]*100)."%</td>";
				else
					echo "<td width=",$KD[$i]," ></td>";
			}
		echo "</tr>";
	}
}
?>
</table>
</body>
<script defer="defer">setscroll();</script>
