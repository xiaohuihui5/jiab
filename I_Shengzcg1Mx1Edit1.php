<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(14);//取得菜单权限
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="update sys_maozsj_mx set dhid=-1*dhid where dhid>0 and id=".$_POST['delrow'];
	include("./inc/xexec.php");
}
$delrow=0;
if(isset($_POST['row']) && $_POST['delrow']==0)
{
	for($i=1;$i<=$_POST['row'];$i++)
	{
		if($_POST['zl'][$i]!=$_POST['ozl'][$i])
		{
		$query="update sys_maozsj_mx set zl=".$_POST['zl'][$i].",lury='".$_SESSION['uname']."' where id=".$_POST['id'][$i];
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
<input type="hidden" name="shid" value="0">
<input type="hidden" name="ssid" value="0">
<input type="hidden" name="setdw" value="0">
<table border="1" class="tableborder3">
<?php 
$menuright=menuright(14);//取得菜单权限
$row=0;
$query = "select sj.id,cp.mc,cast(sj.zl as varchar),dh.zt from sys_maozsj_mx sj,sys_cp cp,sys_maozdh dh where dh.id=sj.dhid and sj.cpid=cp.id and sj.dhid=".$_REQUEST['dhid']." and sj.cpid=".$_REQUEST['cpid']." order by sj.id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
?>
	<input type=hidden value="<?php echo $_REQUEST['dhid'];?>" name="dh_id">
	<input type=hidden value="<?php echo $_REQUEST['cpid'];?>" name="cp_id">
	<input type=hidden value="<?php echo $line[0];?>" name="id[<?php echo $row;?>]">
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td width="30%" align="center"><?php echo $row;?></td>
		<td width="40%"><input type="hidden" name="ozl[<?php echo $row;?>]" value="<?php echo $line[2];?>"><input onfocus="this.select();" id="<?php echo 100+$row;?>" name="zl[<?php echo $row;?>]" value="<?php echo $line[2];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
		<td width="30%" align="center"><a href="javascript:del(<?php echo $line[0];?>,0)"><img border=0 src="im/shanc.png" title="删除此行数据"></a></td>
	</tr>
<?php
$zl+=$line[2];
}
sqlsrv_free_stmt($result);
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
		<td><font color=red>合计</font></td>
		<td><font color=red><?php echo $zl;?></font></td>
		<td></td>
	</tr>
</table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid"><input type=hidden value="<?php echo $row;?>" name=row></td>
</form>
</body>
<script language="javascript">
function del(id,zt)
{
if(window.Frm.edtrow.value==0)
{
	if(zt==1)
		parent.parent.layer.msg('单据已审核,禁止操作！', {icon:2,time:1500});
	else 
	{
		parent.parent.layer.confirm('删除后此条数据将不复存在,您确定要删除此行吗?',{
			btn:["确定","取消"],
			shade:0.2,

			yes:function(){
				window.Frm.scroll.value=document.body.scrollTop;
				window.Frm.delrow.value=id;
				window.Frm.edtrow.value=0;
				parent.parent.layer.msg('', {icon:0,time:1});
				window.Frm.submit();
			},
			btn2:function(){
				parent.parent.layer.msg('用户中途取消,此次操作失败!', {icon:2,time:1500});
			}

		});
	}
}
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>
