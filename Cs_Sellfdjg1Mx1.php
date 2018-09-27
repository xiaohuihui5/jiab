<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(20);//取得菜单权限
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="delete sys_selljgsj  where id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
$delrow=0;
if(isset($_POST['cpid']))
{
		if($_POST['bz']=="")//备注空值转null
			$IBZ="null";
		else
			$IBZ="'".$_POST['bz']."'";
	if($_POST['dj']=="")
		$_POST['dj']=0;

	$query="if exists (select id from sys_selljgsj where dhid=".$_REQUEST['dhid']." and cpid=".$_POST['cpid']." and pmid=".$_POST['khpmid'].") 
update sys_selljgsj set sellprice=".$_POST['dj'].",beiz=".$IBZ." where dhid=".$_REQUEST['dhid']." and cpid=".$_POST['cpid']." and pmid=".$_POST['khpmid']." else 
insert into sys_selljgsj(dhid,cpid,sellprice,beiz,pmid) values(".$_REQUEST['dhid'].",".$_POST['cpid'].",".$_POST['dj'].",".$IBZ.",".$_POST['khpmid'].")";
	include("./inc/xexec.php");
}
if(isset($_POST['row']))
{
	for($i=1;$i<=$_POST['row'];$i++)
	{
		if($_POST['price'][$i]!=$_POST['oldprice'][$i])//价格有变化时才更新
		{
			if($_POST['beiz'][$i]=="")
				$IBZ="null";
			else
				$IBZ="'".$_POST['beiz'][$i]."'";
		$query="update sys_selljgsj set sellprice=".$_POST['price'][$i].",beiz=".$IBZ." where id=".$_POST['id'][$i];
		$query=str_replace("=,","=0,",$query);
		include("./inc/xexec.php");
		}
	}
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script language="javascript" src="./inc/xmy.js"></script>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}
if(nKeyCode==120) {parent.SelCp(1);}//弹出父级产品选取
else if(nKeyCode==38){tt=document.getElementById(event.srcElement.id*1-1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==40 || nKeyCode==13){tt=document.getElementById(event.srcElement.id*1+1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==37){tt=document.getElementById(event.srcElement.id*1-10000);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==39){tt=document.getElementById(event.srcElement.id*1+10000);if(tt){tt.select();tt.focus();}}
}
$(function(){
            $("input").focus(function(){
$(this).parents("tr").css("background-color","#DDECFE").siblings().css("background-color","#ffffff");
            });
$("tr").click(function(){
$(this).css("background-color","#DDECFE").siblings().css("background-color","#ffffff");
});
        });
</script>

</head>
<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="<?php echo $delrow;?>">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="cpxlid" value="<?php echo isset($_POST['cpxlid'])?$_POST['cpxlid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<table border="0" class="tableborder3">
<?php 
$TJ="";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and cp.id in(".$_POST['cpid'].") ";

if(isset($_POST['cpxlid']) and $_POST['cpxlid']!="")
	$TJ.=" and cp.typec in(".$_POST['cpxlid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and cp.bh+cp.mc like '%".$_POST['cxtj']."%' ";

for($i=1;$i<=400;$i++)
{
	$dat[$i]=0;//上期
	$sell[$i]=0;//销售
}
$query="select dh.unitid,khfenl.fenlmc,CONVERT(varchar(10),dh.brq,120),CONVERT(varchar(10),dh.erq,120) from sys_selljg dh,sys_khfenl khfenl where khfenl.id=dh.unitid and dh.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$unitid=$line[0];
$unitmc=$line[1];
$brq=$line[2];
$erq=$line[3];
sqlsrv_free_stmt($result);
//取上期售价
	$dan=0;
	$query="select max(id) from sys_selljg where leix=25 and unitid=".$unitid." and id<".$_REQUEST['dhid'];
	$result=sqlsrv_query($conn,$query);
	if($line=sqlsrv_fetch_array($result))
	{
		if($line[0]!="")
			$dan=$line[0];
	}
	sqlsrv_free_stmt($result);
	$query = "select sj.cpid,sj.sellprice from sys_selljgsj sj,sys_selljg dh where sj.dhid=dh.id and sj.dhid=".$dan;
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
		{
		$dat[$line[0]]=$line[1];
		}
	sqlsrv_free_stmt($result);
//取上期售价
//取实际销售均价
	$query = "select sj.mc,sum(sj.shisje)/sum(sj.shisl) from sys_jhdh dh,sys_jhsj sj where dh.id=sj.dhid and dh.lx=2 and dh.dhrq between '".$brq."' and '".$erq."' and sj.shisje>0 and sj.shisl>0 group by sj.mc";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
		{
		$sell[$line[0]]=sprintf("%1.2f",$line[1]);
		}
	sqlsrv_free_stmt($result);
//取实际销售均价
$row=0;
$cpid=0;
$query = "select sj.id,cp.bh,cp.mc,isnull(khpm.bh,'')+khpm.mc,cast(sj.sellprice as varchar),sj.beiz,case when khpm.gg is null then khpm.dw else isnull(khpm.gg,'')+'/'+isnull(khpm.dw,'') end,cp.dw,sj.cpid from sys_selljgsj sj,sys_cp cp,sys_selljg dh,sys_khpm khpm where sj.cpid=cp.id and sj.dhid=dh.id and sj.pmid=khpm.id and sj.dhid=".$_REQUEST['dhid']." ".$TJ." order by sj.id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
$cpid=$cpid.",".$line[8];
if($line[4]==0)
$line[4]="";
	$row=$row+1;
	if($menuright>1)//录入
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="5%" align="center"><?php echo $line[1];?><input type=hidden value="<?php echo $line[0];?>" name="id[<?php echo $row;?>]"></td>
		<td width="15%"><?php echo $line[2];?></td>
		<td width="4%"><?php echo $line[7];?></td>
		<td width="15%"><?php echo $line[3];?></td>
		<td width="8%"><?php echo $line[6];?></td>
		<td width="9%" align=right><?php echo $dat[$line[8]]==0?"":$dat[$line[8]];?></td> 
		<td width="6%" align=right><?php echo $line[4]-$dat[$line[8]]==0 || $dat[$line[8]]==""?"":sprintf("%1.1f",100*($line[4]-$dat[$line[8]])/$line[4])."%";?></td>
		<td width="9%"><input type="hidden" name="oldprice[<?php echo $row;?>]" value="<?php echo $line[4];?>"><input onfocus="this.select();" id="<?php echo 20000+$row;?>" name="price[<?php echo $row;?>]" value="<?php echo $line[4]==0?"":$line[4];?>" style="height:100%;width:100%;background-color: #EAEAEA;"></td>
		<td width="7%"><input onfocus="this.select();" id="<?php echo 30000+$row;?>" name="beiz[<?php echo $row;?>]" value="<?php echo $line[5];?>" style="height:100%;width:100%;background-color: #EAEAEA;"></td> 
		<td width="8%" align=right><?php echo $sell[$line[8]]==0?"":$sell[$line[8]];?></td> 
		<td width="6%" align=right><?php echo $line[4]-$sell[$line[8]]==0 || $sell[$line[8]]==""?"":sprintf("%1.1f",100*($line[4]-$sell[$line[8]])/$sell[$line[8]])."%";?></td>
		<td width="4%" align="center"><a href="javascript:del(<?php echo $line[0];?>,0)"><img border=0 src=im/shanc.png alt=删除此单></a></td>
	</tr>
<?php 
	}
	else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="4%" align="center"><?php echo $row;?></td>
		<td width="10%" align="center"><?php echo $line[1];?></td>
		<td width="24%"><?php echo $line[2];?></td>
		<td width="5%"><?php echo $line[7];?></td>
		<td width="10%"><?php echo $line[3];?>&nbsp;</td>
		<td width="10%" align=right><?php echo $dat[$line[8]]==0?"":$dat[$line[8]];?></td> 
		<td width="6%" align=right><?php echo $line[4]-$dat[$line[8]]==0 || $dat[$line[8]]==""?"":sprintf("%1.1f",100*($line[4]-$dat[$line[8]])/$line[4])."%";?></td>
		<td width="10%" align=right><?php echo $line[4];?></td> 
		<td width="7%"><?php echo $line[5];?></td>
		<td width="8%" align=right><?php echo $sell[$line[8]]==0?"":$sell[$line[8]];?></td> 
		<td width="6%" align=right><?php echo $line[4]-$sell[$line[8]]==0 || $sell[$line[8]]==""?"":sprintf("%1.1f",100*($line[4]-$sell[$line[8]])/$sell[$line[8]])."%";?></td>
	</tr>
<?php 
	}
}
sqlsrv_free_stmt($result);
//以下为导出excel和打印用
$_SESSION['mac']="select 0,sj.cpid,cp.bh,cp.mc,cp.dw,cp.gg,'','',sj.sellprice,sj.beiz,'','' from sys_selljgsj sj,sys_cp cp,sys_selljg dh where sj.cpid=cp.id and sj.dhid=dh.id and sj.dhid=".$_REQUEST['dhid']." order by sj.id";
$_SESSION['mac'].="#"."11,0,0,0,0,0,0,0,0,0,0,0";
$_SESSION['mac'].="#".",5%,4%,20%,8%,10%,10%,7%,10%,9%,10%,7%";
$_SESSION['mac'].="#".",center,center,left,left,left,right,right,right,left,right,right";
$_SESSION['mac'].="#".",序,编号,商品名称,单位,规格,上期合同价,振幅,本期合同价,备注,销售均价,振幅";
$_SESSION['mac'].="#".$unitmc.$brq."至".$erq."销售价格表";
$_SESSION['mac'].="#";
$_SESSION['mac'].="#";
?>
</table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid"><input type=hidden value="<?php echo $row;?>" name=row><input type=hidden value="<?php echo $ii;?>" name=ii></td>
</form>
</body>
<script language=javascript>
function insert(lx)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.insert.value=lx;
	window.Frm.submit();
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
