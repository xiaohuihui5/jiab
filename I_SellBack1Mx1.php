<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(16);//取得菜单权限
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="delete from sys_jhsj where id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
$delrow=0;
if(isset($_POST['cpid']) && $_POST['cpid']!='')
{
	$_POST['bz']=$_POST['bz']==""?"null":"'".$_POST['bz']."'";
	$_POST['dinghl']=$_POST['dinghl']==""?"0":"".$_POST['dinghl']."";
    $_POST['dinghs']=$_POST['dinghs']==""?"0":"".$_POST['dinghs']."";
	$_POST['dj']=$_POST['dj']==""?"0":"".$_POST['dj']."";
	if($_POST['dinghl']!='0' and $_POST['dinghs']!='0'){
        echo "<script language=\"JavaScript\">";
        echo "alert(\"不能同时输入订货量和订货数\")";
        echo "</script>";
    }else{
        //取换算值
        $aquery="select huans from sys_khpm where khid=".$_POST['khid']." and cpid=".$_POST['cpid'];
        $result=sqlsrv_query($conn,$aquery);
        $line=sqlsrv_fetch_array($result);
        $huans=$line[0];
        sqlsrv_free_stmt($result);
        //判断预定数量是不是为空
        if($_POST['dinghs']!='0'){
            $dinghl=$_POST['dinghs']*$huans;
            $query="insert into sys_jhsj(dhid,mc,songhs,songhl,shiss,shisl,dj,shisje,bz,lury) values(".$_POST['dhid'].",".$_POST['cpid'].",".$_POST['dinghs'].",".$dinghl.",".$_POST['dinghs'].",".$dinghl.",".$_POST['dj'].",".$dinghl."*".$_POST['dj'].",".$_POST['bz'].",'".$_SESSION['uname']."')";
            include("./inc/xexec.php");
        }else{
            $query="insert into sys_jhsj(dhid,mc,songhl,shisl,dj,shisje,bz,lury) values(".$_POST['dhid'].",".$_POST['cpid'].",".$_POST['dinghl'].",".$_POST['dinghl'].",".$_POST['dj'].",".$_POST['dinghl']."*".$_POST['dj'].",".$_POST['bz'].",'".$_SESSION['uname']."')";
            include("./inc/xexec.php");
        }
    }

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
$menuright=menuright(16);//取得菜单权限
$row=0;
$query = "select sj.id,cp.bh,cp.mc,cp.gg,cast(sj.songhl as varchar),cp.dw,sj.dj,sj.shisje,sj.bz,dh.zt,sj.mc,sj.songhs from sys_jhsj sj,sys_cp cp,sys_jhdh dh where dh.id=sj.dhid and sj.mc=cp.id and sj.dhid=".$_REQUEST['dhid']." order by sj.id";
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
		<td width="9%" align="center"><?php echo $line[1];?></td>
		<td width="18%"><?php echo $line[2];?></td>
		<td width="9%"><?php echo $line[3];?></td>
        <td width="10%"><input type="hidden" name="osonghs[<?php echo $row;?>]" value="<?php echo $line[4];?>"><input onfocus="this.select();" id="<?php echo 2000+$row;?>" name="songhs[<?php echo $row;?>]" value="<?php echo $line[11];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="9%"><input type="hidden" name="osonghl[<?php echo $row;?>]" value="<?php echo $line[4];?>"><input onfocus="this.select();" id="<?php echo 2000+$row;?>" name="songhl[<?php echo $row;?>]" value="<?php echo $line[4];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="5%" align=center><?php echo $line[5];?></td> 
		<td width="9%"><input type="hidden" name="odanj[<?php echo $row;?>]" value="<?php echo $line[6];?>"><input onfocus="this.select();" id="<?php echo 3000+$row;?>" name="danj[<?php echo $row;?>]" value="<?php echo $line[6];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="9%" align=right><?php echo $line[7];?></td>
		<td width="12%"><input type="hidden" name="obz[<?php echo $row;?>]" value="<?php echo $line[8];?>"><input onfocus="this.select();" id="<?php echo 4500+$row;?>" name="bz[<?php echo $row;?>]" value="<?php echo $line[8];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="5%" align="center"><a href="javascript:del(<?php echo $line[0];?>,0)"><img border=0 src="im/shanc.png" title="删除此行数据"></a></td>
	</tr>
<?php
	}
else
	{
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="5%" align="center"><?php echo $row;?></td>
		<td width="9%" align="center"><?php echo $line[1];?></td>
		<td width="18%"><?php echo $line[2];?></td>
		<td width="9%"><?php echo $line[3];?></td>
        <td width="10%"><?php echo $line[11];?></td>
		<td width="9%"><?php echo $line[4];?></td>
		<td width="5%"><?php echo $line[5];?></td>
		<td width="9%"><?php echo $line[6];?></td>
		<td width="10%"><?php echo $line[7];?></td>
		<td width="16%" align=center><?php echo $line[8];?></td>
	</tr>
<?php
	}
$hjdinghl+=$line[4];
$hjjine+=$line[7];
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td colspan="5"><font color=red>合计</font></td>
		<td><font color=red><?php echo $hjdinghl;?></font></td>
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
