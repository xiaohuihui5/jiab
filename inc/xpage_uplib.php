<?php
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
function pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam,$tis,$xuh,$yul)
{
//$tit页面标题,某些参数如果用不到的话为空即可
//$lur数据录入部分,如果有的话记得他的form名字是LurFrm
//$lnk链接部分,上面分块的那种链接
//$cha查询部分传入,查询条件选择
//$lie每列列名
//$wid每列宽度
//$xiam下面页面地址
//$tis下面页面提示
//$xuh每列的排序序号
//$yul预留参数，目前没用
	$l_m='<tr class="text-c">';
	$l=explode(',',$lie);
	$w=explode(',',$wid);
	$p=explode(',',$xuh);
	$yn=true;
	for($i=1;$i<count($l);$i++)
	{
		if(isset($p[$i]) && $p[$i]!='')   
		{
			$fir=$yn?'<font color=red>↑':'';
			$yn=false;
  			$l_m.='<th width="'.$w[$i].'"><a href=javascript:s('.$p[$i].')><b>'.$l[$i].'</b><span id="m'.$p[$i].'">'.$fir.'</span></th>';
		}
		else
  			$l_m.='<th width="'.$w[$i].'"><b>'.$l[$i].'</b></th>';
	}	
$l_m.='</tr>';
echo <<<LEND
<table border="0" width="100%" height="100%" cellSpacing="1" cellPadding="0">
<tr>

<td><nav class="breadcrumb xhxp"><a class="btn radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><img border=0 src=./im/refresh.png></a>{$tit}</nav></td></tr>
<tr><td><div class="page-container"><form action="{$xiam}" target="hqlist" method="post" name="Frm">{$lur}</form></td></tr>
<tr><td><div class="cl pd-5 bg-1 bk-gray">{$lnk}</div> </td></tr>


<tr>

<td align="center" width="100%">
<table width="100%" cellSpacing="0" cellPadding="0" border="0" height="100%">
<tr>
<td>
<table class="table table-border table-bordered table-hover table-bg table-sort" id="th">{$l_m}</table>
</td>
<td width="17" id="k">&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" width="100%" height="100%">
<iframe name="hqlist" width="100%"  height="100%" frameborder="0" scrolling="yes" style="overflow-x:hidden; overflow-y:auto;" noresize src="{$xiam}"></iframe>
</td>
</tr>
</div>
<tr><td>{$tis} </td></tr>
</table>
<!--手机打开的时候去掉滚动条-->
<script>
var k = document.getElementById('k');
if(window.screen.width<760)
{
	k.parentNode.removeChild(k);
}
</script>
<!--手机打开的时候去掉滚动条-->
LEND;
}
function menuright($menuid)
{
	$query='select menuright from sys_menuright where empid='.$_SESSION['empid'].' and menuid='.$menuid;
	$result=sqlsrv_query($GLOBALS['conn'],$query);
if($result!==false)
{
	if($line=sqlsrv_fetch_array($result))
	{
		return $line[0];//返回用户对应菜单权限
	}
	else
		return 0;
}
}
function getdh($rq,$lx)
{
	$query='select dhtait,biao,ges from sys_dh where lx='.$lx;
	$result=sqlsrv_query($GLOBALS['conn'],$query);
	$line=sqlsrv_fetch_array($result);
	$dhtait=$line[0];
	$biao=$line[1];
	$ges=$line[2];
	sqlsrv_free_stmt($result);

	$R_Q=explode('-',$rq);
	$dh=$dhtait.substr($R_Q[0],-2).substr('0'.$R_Q[1],-2).substr('0'.$R_Q[2],-2);
	if($ges==1)
		$query="select right(max(dh),4)+1 from ".$biao." where  dhrq='".$rq."' and abs(lx)=".$lx;
	else
		$query="select right(dh,4)+1 from ".$biao." where id=(select max(id) from ".$biao." where abs(lx)=".$lx.")";
	$result=sqlsrv_query($GLOBALS['conn'],$query);
	if($result!==false)
	{
		if($line=sqlsrv_fetch_array($result))
		{		
			if($line[0]!="") return $dh.substr('000'.$line[0],-4); else return $dh.'0001';
		}
	}
	else
		return $dh.'0001';
}
?>
