<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(14);//取得菜单权限
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="update sys_jhsj set dhid=-1*dhid where dhid>0 and id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
if(isset($_POST['ssid']) and $_POST['ssid']!=0)//一键填充实收量=配送量
{
	$query="update sys_jhsj set shisl=songhl,shisje=songhl*dj where dhid=".$_POST['ssid'];
	include("./inc/xexec.php");
}
$delrow=0;
if(isset($_POST['cpid']) && $_POST['cpid']!='')
{
	$_POST['bz']=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$_POST['dinghl']=$_POST['dinghl']==""?"0":"".$_POST['dinghl']."";
	$_POST['dj']=$_POST['dj']==""?"0":"".$_POST['dj']."";
	$query="insert into sys_jhsj(dhid,mc,songhl,shisl,dj,shisje,bz,lury) values(".$_POST['dhid'].",".$_POST['cpid'].",".$_POST['dinghl'].",".$_POST['dinghl'].",".$_POST['dj'].",".$_POST['dinghl']."*".$_POST['dj'].",".$_POST['bz'].",'".$_SESSION['uname']."')";
	include("./inc/xexec.php");
}
if(isset($_POST['row']) && $_POST['delrow']==0)
{
	for($i=1;$i<=$_POST['row'];$i++)
	{
		if($_POST['songhl'][$i]!=$_POST['osonghl'][$i] || $_POST['danj'][$i]!=$_POST['odanj'][$i] || $_POST['bz'][$i]!=$_POST['obz'][$i])
		{
			$_POST['bz'][$i]=$_POST['bz'][$i]==""?"null":"'".$_POST['bz'][$i]."'";
			$_POST['songhl'][$i]=$_POST['songhl'][$i]==""?"0":"".$_POST['songhl'][$i]."";
			$_POST['danj'][$i]=$_POST['danj'][$i]==""?"0":"".$_POST['danj'][$i]."";
			$_POST['shisje'][$i]=@sprintf("%1.2f",$_POST['songhl'][$i]*$_POST['danj'][$i]);
		$query="update sys_jhsj set songhl=".$_POST['songhl'][$i].",shisl=".$_POST['songhl'][$i].",dj=".$_POST['danj'][$i].",shisje=".$_POST['shisje'][$i].",bz=".$_POST['bz'][$i]." where id=".$_POST['id'][$i];
		$query=str_replace("=,","=null,",$query);
		$query=str_replace("=,","=null,",$query);
		include("./inc/xexec.php");
		}
	}
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}
if(nKeyCode==120) {parent.SelCp();}
else if(nKeyCode==38){tt=document.getElementById(event.srcElement.id*1-1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==40 || nKeyCode==13){tt=document.getElementById(event.srcElement.id*1+1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==37){tt=document.getElementById(event.srcElement.id*1-500);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==39){tt=document.getElementById(event.srcElement.id*1+500);if(tt){tt.select();tt.focus();}}
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
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:9999;?>">
<input type="hidden" name="delrow" value="<?php echo $delrow;?>">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="ssid" value="0">
<input type="hidden" name="setdw" value="0">
<table border="1" class="tableborder3">
<?php 
$menuright=menuright(30);//取得菜单权限
$row=0;
$query = "select sj.id,cp.bh,cp.mc,cp.gg,cast(sj.dinghl as varchar),sj.fudw,cast(sj.songhl as varchar),sj.shisl,cp.dw,sj.dj,sj.shisje,sj.bz,dh.zt,sj.paix,cp.huansz,sj.mc from sys_jhsj sj,sys_cp cp,sys_jhdh dh where dh.id=sj.dhid and sj.mc=cp.id and sj.dhid=".$_REQUEST['dhid']." order by sj.paix";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	if($menuright>1 and $line[12]==0)//录入
	{
?>
	<input type=hidden value="<?php echo $_REQUEST['dhid'];?>" name="dh_id">
	<input type=hidden value="<?php echo $line[0];?>" name="id[<?php echo $row;?>]">
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="5%" align="center"><?php echo $row;?></td>
		<td width="10%" align="center"><?php echo $line[1];?></td>
		<td width="20%"><?php echo $line[2];?></td>
		<td width="10%"><?php echo $line[3];?></td>
		<td width="10%"><input type="hidden" name="osonghl[<?php echo $row;?>]" value="<?php echo $line[6];?>"><input onfocus="this.select();" id="<?php echo 2000+$row;?>" name="songhl[<?php echo $row;?>]" value="<?php echo $line[6];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="5%" align=center><?php echo $line[8];?></td> 
		<td width="10%"><input type="hidden" name="odanj[<?php echo $row;?>]" value="<?php echo $line[9];?>"><input onfocus="this.select();" id="<?php echo 3000+$row;?>" name="danj[<?php echo $row;?>]" value="<?php echo $line[9];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="10%" align=right><?php echo $line[10];?></td>
		<td width="15%"><input type="hidden" name="obz[<?php echo $row;?>]" value="<?php echo $line[11];?>"><input onfocus="this.select();" id="<?php echo 4500+$row;?>" name="bz[<?php echo $row;?>]" value="<?php echo $line[11];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="5%" align="center"><a href="javascript:del(<?php echo $line[0];?>,0)"><img border=0 src="im/shanc.png" title="删除此行数据"></a></td>
	</tr>
<?php
	}
else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="5%" align="center"><?php echo $row;?></td>
		<td width="10%" align="center"><?php echo $line[1];?></td>
		<td width="20%"><?php echo $line[2];?></td>
		<td width="10%"><?php echo $line[3];?></td>
		<td width="10%"><?php echo $line[6];?></td>
		<td width="10%" align=center><?php echo $line[8];?></td> 
		<td width="10%"><?php echo $line[9];?></td>
		<td width="10%" align=right><?php echo $line[10];?></td>
		<td width="15%"><?php echo $line[11];?></td>
	</tr>
<?php
	}
$hjsonghl+=$line[6];
$hjjine+=$line[10];
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td colspan="4"><font color=red>合计</font></td>
		<td><font color=red><?php echo $hjsonghl;?></font></td>
		<td></td>
		<td></td>
		<td><font color=red><?php echo $hjjine;?></font></td>
		<td colspan="2"></td>
	</tr>
</table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid"><input type=hidden value="<?php echo $row;?>" name=row></td>
</form>
</body>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
