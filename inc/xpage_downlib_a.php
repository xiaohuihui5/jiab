<?php
function menuright($menuid)
{
	$query="select menuright from sys_menuright where empid=".$_SESSION['empid']." and menuid=".$menuid;
	$result=sqlsrv_query($GLOBALS['conn'],$query);
	if($result===false)
		return 0;
	else
	{
		$line=sqlsrv_fetch_array($result);
		return $line[0];
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
	if($line=sqlsrv_fetch_array($result))
	{		
		if($line[0]!="") return $dh.substr('000'.$line[0],-4); else return $dh.'0001';
	}
	else
		return $dh.'0001';
}
?>
