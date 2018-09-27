<?php 
require('inc/xhead.php');
$CS=explode('#',$_SESSION['mac']);
$query=$CS[0];
$HJ=explode(',',$CS[1]);
$KD=explode(',',$CS[2]);
$AL=explode(',',$CS[3]);
$LM=explode(',',$CS[4]);
$ZJ=explode(',','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0');
$XJ=explode(',','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0');
$Column=count($HJ);
?>
<head>
<?php 
echo '<title>',$CS[5],'</title>';
?>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
<tr><td>
<p align="center"><br><font size=4><b><?php echo $CS[5];?></b></font><br><?php echo $CS[6];?></p>
<p align=left><?php echo $CS[7];?></p>
</td></tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
<?php 
echo '<tr>';
for($i=1;$i<count($LM);$i++)
	{
		echo '<td align=center><b>',$LM[$i],'</b></td>';
	}
echo '</tr>';
$query=$CS[0];
$result=sqlsrv_query($conn,$query);
$tp1="";
$i=2;
$mid[1]=0;
while($line=sqlsrv_fetch_array($result))
{
	if($line[1]!=$tp1)
	{
		if($tp1!="")
		{
		echo $beg[1],$mid[1],$end[1];
		if($mid[1]>1)
		{
		echo '<tr><td align=center colspan=',$HJ[0],'><font color=red>',$tp1,'小计</td>';
		for($i=$HJ[0]+1;$i<$Column;$i++)
			{
			if($HJ[$i]==1)
				echo '<td align=right><font color=red>',$XJ[$i],'</td>';
			else
				echo '<td></td>';
			}
		echo '</tr>';
		}
		for($i=$HJ[0]+1;$i<$Column;$i++)
			$XJ[$i]=0;
	}
	$beg[1]='<tr><td width='.$KD[1].' align='.$AL[1].' rowspan=';
	$mid[1]=1;
	$end[1]='>'.$line[1].'</td>';
	for($i=2;$i<$Column;$i++)
		{
		$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	}
	else
	{
	$end[1].='<tr>';
	for($i=2;$i<$Column;$i++)
		{
		$end[1].="<td width=".$KD[$i]." align=".$AL[$i].">".$line[$i]."</td>";
		}
	$end[1].="</tr>";
	$mid[1]++;
	}
$tp1=$line[1];
for($i=1;$i<$Column;$i++)
	{
	if($HJ[$i]==1)
		{
		$XJ[$i]+=$line[$i];
		$ZJ[$i]+=$line[$i];
		}
	}
}
if($mid[1]!==0)
	echo $beg[1],$mid[1],$end[1];
if($mid[1]>1)
{
		echo '<tr><td align=center colspan=',$HJ[0],'><font color=red>',$tp1,'小计</td>';
		for($i=$HJ[0]+1;$i<$Column;$i++)
			{
			if($HJ[$i]==1)
				echo "<td align=right><font color=red>",$XJ[$i],"</td>";
			else
				echo "<td></td>";
			}
		echo "</tr>";
}
if($tp1!="")
{
		echo '<tr><td align=center colspan=',$HJ[0],'><font color=red>总 计</td>';
		for($i=$HJ[0]+1;$i<$Column;$i++)
			{
			if($HJ[$i]==1)
				echo "<td align=right><font color=red>",$ZJ[$i],"</td>";
			else
				echo "<td></td>";
			}
		echo "</tr>";
}
sqlsrv_free_stmt($result);
?>
</table>
<p align=left><?php echo $CS[8];?></p>
</body>
<script lanuage ="javascript">
	window.print();
</script>
