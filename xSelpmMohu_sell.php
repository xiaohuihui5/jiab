<?php
require('./inc/xhead.php');
$tmp="<tr style=\"cursor:pointer;background:#F5F5F5\" onmouseout=\"this.bgColor='';\"><th class=seltd>公司编号</th><th class=seltd>公司品名</th><th class=seltd>单位</th>
<th class=seltd>客户品名</th><th class=seltd>规格/单位</th><th class=seltd></th></tr>";
$str=iconv("UTF-8","GBK",$_POST["inputkey"]);
$query="select top 20 cp.bh,cp.mc,cp.id,cp.dw,isnull(khpm.gg,'')+'/'+isnull(khpm.dw,''),isnull(khpm.bh,'')+khpm.mc,khpm.id from sys_cp cp,sys_khpm khpm where khpm.cpid=cp.id and khpm.flid=".$_SESSION['khflid']." and cp.yn=1 and (isnull(khpm.bh,'')+isnull(khpm.mc,'') like '%".$str."%' or isnull(cp.bh,'')+isnull(cp.mc,'') like '%".$str."%' or cp.piny like '%".$str."%') 
union all 
select top 20 cp.bh,cp.mc,cp.id,cp.dw,'','',0 from sys_cp cp where cp.yn=1 and isnull(cp.bh,'')+isnull(cp.mc,'')+isnull(cp.piny,'') like '%".$str."%' ";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$tmp.="<tr style=\"cursor:pointer\" onmouseover=\"this.bgColor='#F2F2F2';\" onmouseout=\"this.bgColor='';\">
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].",".$line[6].")\">".$line[0]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].",".$line[6].")\">".$line[1]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].",".$line[6].")\">".$line[3]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].",".$line[6].")\">".$line[5]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].",".$line[6].")\">".$line[4]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].",".$line[6].")\">".$line[6]."</td>
</tr>";
}
sqlsrv_free_stmt($result);
if($tmp!="")
	echo '<table id="lstab" name="lstab" class=seldiv>',$tmp,'</table>';
else
	echo 'no';
?>
