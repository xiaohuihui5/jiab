<?php
require('./inc/xhead.php');
$tmp="<tr style=\"cursor:pointer;background:#F5F5F5\" onmouseout=\"this.bgColor='';\"><th class=seltd>公司编号</th><th class=seltd>公司品名</th><th class=seltd>单位</th><th class=seltd>客户品名</th><th class=seltd>规格/单位</th><th class=seltd>特价</th><th class=seltd>客户价</th><th class=seltd>分类价</th></tr>";
$str=iconv("UTF-8","GBK",$_POST["inputkey"]);
$cpid="0";
$query="select jg.sellprice,jg.cpid from sys_selljg jgdh,sys_selljgsj jg,sys_cp cp where jgdh.id=jg.dhid and jgdh.lx=25 and jg.cpid=cp.id and isnull(cp.bh,'')+isnull(cp.mc,'')+isnull(cp.piny,'') like '%".$str."%' and jgdh.unitid=".$_POST['khflid']." and '".$_POST['RQ']."' between jgdh.brq and jgdh.erq";
$result=sqlsrv_query($conn,$query);
if($result!==false)
{
if($line=sqlsrv_fetch_array($result))
{
	$cpid.=",".$line[1];
	$jg_fl[$line[1]]=$line[0];//分类价
}       
sqlsrv_free_stmt($result);
}

$query="select jg.sellprice,jg.cpid from sys_selljg jgdh,sys_selljgsj jg,sys_cp cp where jgdh.id=jg.dhid and jgdh.lx=23 and jg.cpid=cp.id and isnull(cp.bh,'')+isnull(cp.mc,'')+isnull(cp.piny,'') like '%".$str."%' and jgdh.unitid=".$_POST['khid']." and '".$_POST['RQ']."' between jgdh.brq and jgdh.erq";
$result=sqlsrv_query($conn,$query);
if($result!==false)
{
if($line=sqlsrv_fetch_array($result))
{
	$cpid.=",".$line[1];
	$jg_kh[$line[1]]=$line[0];//客户价
}       
sqlsrv_free_stmt($result);
}

$query="select jg.sellprice,jg.cpid from sys_selljg jgdh,sys_selljgsj jg,sys_cp cp where jgdh.id=jg.dhid and jgdh.lx=21 and jg.cpid=cp.id and isnull(cp.bh,'')+isnull(cp.mc,'')+isnull(cp.piny,'') like '%".$str."%' and jgdh.unitid=".$_POST['khid']." and '".$_POST['RQ']."' between jgdh.brq and jgdh.erq";
$result=sqlsrv_query($conn,$query);
if($result!==false)
{
if($line=sqlsrv_fetch_array($result))
{
	$cpid.=",".$line[1];
	$jg_tj[$line[1]]=$line[0];//客户特价
}       
sqlsrv_free_stmt($result);
}

$query="select cp.bh,cp.mc,cp.id,cp.dw,'','','','','' from sys_cp cp where cp.id in(".$cpid.") and cp.yn=1 and isnull(cp.bh,'')+isnull(cp.mc,'')+isnull(cp.piny,'') like '%".$str."%' 
union all 
select cp.bh,cp.mc,cp.id,cp.dw,isnull(khpm.gg,'')+'/'+isnull(khpm.dw,''),isnull(khpm.bh,'')+khpm.mc,'','','' from sys_cp cp,sys_khpm khpm where khpm.cpid=cp.id and cp.id not in(".$cpid.") and cp.yn=1 and isnull(khpm.bh,'')+isnull(khpm.mc,'') like '%".$str."%' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$tmp.="<tr style=\"cursor:pointer\" onmouseover=\"this.bgColor='#F2F2F2';\" onmouseout=\"this.bgColor='';\">
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[0]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[1]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[3]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[5]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[4]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$jg_tj[$line[2]]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$jg_kh[$line[2]]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$jg_fl[$line[2]]."</td>
</tr>";
}
sqlsrv_free_stmt($result);
if($tmp!="")
	echo '<table id="lstab" name="lstab" class=seldiv>',$tmp,'</table>';
else
	echo 'no';
?>
