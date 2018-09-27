<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="update sys_jhsj set dhid=-1*dhid where id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
if(isset($_POST['bz']))
{
	if($_POST['bz']=="")
		$IBZ="null";
	else
		$IBZ="'".$_POST['bz']."'";

	if($_POST['dj']=="" || $_POST['songhl']=="")
		$ije="null";
	else
		$ije=$_POST['dj']."*".$_POST['songhl'];
	$query="insert into sys_jhsj(dhid,mc,songhl,dj,shisje,bz,ck) values(".$_POST['dhid'].",".$_POST['cpid'].",".$_POST['songhl'].",".$_POST['dj'].",".$ije.",".$IBZ.",".$_POST['ck'].")";
	$query=str_replace(",,",",null,",$query);
	$query=str_replace(",,",",null,",$query);
	include("./inc/xexec.php");
}
$ed_row=0;
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
	if(isset($_POST['beiz']))
	{
	if($_POST['beiz']=="")
		$IBZ="null";
	else
		$IBZ="'".$_POST['beiz']."'";
	if($_POST['dj']=="" || $_POST['songhl']=="")
		$ije="null";
	else
		$ije=$_POST['dj']."*".$_POST['songhl'];

	$query="update sys_jhsj set songhl=".$_POST['songhl'].",dj=".$_POST['dj'].",shisje=".$ije.",bz=".$IBZ.",ck=".$_POST['ck']." where id=".$_POST['edtrow'];
	$query=str_replace("=,","=null,",$query);
	$query=str_replace("=,","=null,",$query);
	require("./inc/xexec.php");	
	$ed_row=0;
	}
	else $ed_row=$_POST['edtrow'];
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script language="javascript" src="./inc/xmy.js"></script>
<script>document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==119) {parent.sending.style.visibility="visible";parent.cover.style.visibility="visible";window.Frm.submit();}else if(nKeyCode==37){tt=document.getElementById(event.srcElement.id*1-200);if(tt){tt.select();tt.focus();}}else if(nKeyCode==38){tt=document.getElementById(event.srcElement.id*1-1);if(tt){tt.select();tt.focus();}}else if(nKeyCode==39){tt=document.getElementById(event.srcElement.id*1+200);if(tt){tt.select();tt.focus();}}else if(nKeyCode==40 || nKeyCode==13){tt=document.getElementById(event.srcElement.id*1+1);if(tt){tt.select();tt.focus();}}}</script>
</head>
<BODY>
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="edtrow" value="<?php echo $ed_row;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="dhid" value="<?php echo $_REQUEST['dhid'];?>">
<table border="1" class="tableborder3">
<?php 
//获取仓库
$aquery="select id,fenlmc from sys_cangk where yn=1";
$aresult=sqlsrv_query($conn,$aquery);
while($aline=sqlsrv_fetch_array($aresult))
{
	$ck1.='<option value='.$aline[0].'>'.$aline[1].'</option>';
}
$row=0;
$zl=0;
$je=0;
//$query = "select sj.id,cp.bh,cp.mc,cp.dw,cp.gg,sj.songhl,sj.bz,dh.zt,sj.dj,sj.shisje,ck.name as ckname,sj.ck from sys_jhdh dh,sys_jhsj sj,sys_cp cp,sys_cangk as ck where dh.id=sj.dhid and sj.mc=cp.id and sj.dhid=".$_REQUEST['dhid']." and ck.id=sj.ck order by sj.id";
$query = "
SELECT sj.id,cp.bh,cp.mc,cp.dw,cp.gg,sj.songhl,sj.bz,dh.zt,sj.dj,sj.shisje,ck.fenlmc as ckname,sj.ck from sys_jhsj sj
LEFT JOIN sys_cangk as ck on ck.id=sj.ck
LEFT JOIN sys_jhdh as dh ON sj.dhid=dh.id
LEFT JOIN sys_cp as cp ON sj.mc=cp.id
where sj.dhid=".$_REQUEST['dhid']."
";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	if($ed_row==$line[0])
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="5%" align="center"><?php echo $row;?></td>
	<td width="10%"><?php echo $line[1];?></td>
	<td width="15%"><?php echo $line[2];?></td>
	<td width="5%"><?php echo $line[3];?></td>
	<td width="5%"><?php echo $line[4];?></td>
	<td width="10%">
	<?php
		echo '<select class="select-box" style="width:100px;" name="ck">';
		echo '<option value="'.$line[11].'">'.$line[10].'</option>';
		echo $ck1;
		echo '</select>';
	?>
	</td>
	<td width="10%" align=right><input name="songhl" value="<?php echo $line[5];?>"  onkeydown="if(event.keyCode==13)event.keyCode=9" style="width:100%;border-style:none"></td> 
	<td width="10%" align=right><input name="dj" value="<?php echo $line[8];?>"  onkeydown="if(event.keyCode==13)event.keyCode=9" style="width:100%;border-style:none"></td> 
	<td width="10%" align=right><?php echo $line[9];?></td> 

	<td width="10%"><input  name="beiz" value="<?php echo $line[6];?>" onkeydown="if(event.keyCode==13)event.keyCode=9" style="width:100%;border-style:none"></td>
	<td width="5%" align="center"><a href="javascript:can()"><img border=0 src="im/fanh.png" alt="取消修改此行数据"></a></td>
	<td width="5%" align="center"><a href="javascript:sav()"><img border=0 src="im/baoc.png" alt="把修改后数据存入数据库"></a></td>
	</tr>
<?php 
	}else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td width="5%" align="center"><?php echo $row;?></td>
	<td width="10%"><?php echo $line[1];?></td>
	<td width="15%"><?php echo $line[2];?></td>
	<td width="5%"><?php echo $line[3];?></td>
	<td width="5%"><?php echo $line[4];?></td>
	<td width="10%" align=right><?php echo $line['ckname'];?></td> 
	<td width="10%" align=right><?php echo $line[5];?></td> 
	<td width="10%" align=right><?php echo $line[8];?></td> 
	<td width="10%" align=right><?php echo $line[9];?></td> 
	<td width="10%"><?php echo $line[6];?></td>
	<td width="5%" align="center"><a href="javascript:del(<?php echo $line[0].",".$line[7];?>)"><img border=0 src="im/shanc.png" alt="删除此行数据"></a></td>
	<td width="5%" align="center"><a href="javascript:mod(<?php echo $line[0].",".$line[7];?>)"><img border=0 src="im/xiug.png" alt="修改此行数据"></a></td>
	</tr>
<?php 
	}
	$zl+=$line[5];
	$je+=$line[9];
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
	<td colspan=6 align="center"><font color=red>合计</td>
	<td align=right><font color=red><?php echo $zl;?></td>
	<td></td>
	<td align=right><font color=red><?php echo $je;?></td>
	<td colspan=3></td>
	</tr>
</table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid"><input type=hidden value="<?php echo $row;?>" name=row></td>
</form>
</body>
<script defer="defer">document.body.scrollTop=10000;</script>
<script type="text/javascript" defer="defer">closeload()</script>
