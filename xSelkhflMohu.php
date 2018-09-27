<?php
require('./inc/xhead.php');
$tmp='';
$str=iconv("UTF-8","GBK",$_POST["inputkey"]);
$query = "select top 10 khfl.bianh,khfl.fenlmc,khfl.id from sys_khfenl khfl where khfl.yn=1 and khfl.bianh+khfl.fenlmc+isnull(khfl.piny,'') like '%".$str."%' order by khfl.bianh";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$tmp.="<tr style=\"cursor:pointer\" onmouseover=\"this.bgColor='#F2F2F2';\" onmouseout=\"this.bgColor='';\"><td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[0]."</td><td class=seltd onclick=\"CloseTipDiv();startRequest('',".$line[2].")\">".$line[1]."</td></tr>";
}
sqlsrv_free_stmt($result);
if($tmp!="")
	echo '<table id="lstab" name="lstab" class=seldiv>',$tmp,'</table>';
else
	echo 'no';
?>
