<?php
require('./inc/xhead.php');
//$tmp="<tr style=\"cursor:pointer;background:#51a064\" onmouseout=\"this.bgColor='';\"><th class=seltd>&nbsp;&nbsp;编号</th><th class=seltd>名称</th><th class=seltd>单位</th><th class=seltd>规格</th><th class=seltd></th></tr>";
$tmp="";
$str=iconv("UTF-8","GBK",$_POST["inputkey"]);
$query = "select top 20 a.bh,a.mc,a.id,a.dw,a.gg from sys_cp a where a.yn=1 and isnull(a.bh,'')+isnull(a.mc,'')+isnull(a.piny,'') like '%".$str."%' order by a.bh";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$tmp.="<tr style=\"cursor:pointer\" onmouseover=\"this.bgColor='#F2F2F2';\" onmouseout=\"this.bgColor='';\">
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[0]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[1]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[3]."</td>
<td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[4]."</td>
</tr>";
}
sqlsrv_free_stmt($result);
if($tmp!="")
	echo '<table id="lstab" name="lstab" class=seldiv>',$tmp,'</table>';
else
	echo 'no';
?>
