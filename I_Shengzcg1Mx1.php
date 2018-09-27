<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$menuright=menuright(25);//取得菜单权限
if (isset($_POST['delrow']) && $_POST['delrow']!=0)
{
	$query="update sys_maozsj_mx set dhid=-1*dhid where dhid=".$_POST['delrow']." and cpid=".$_POST['delcpid'];
	include("./inc/xexec.php");
}
$delrow=0;
$delcpid=0;
if(isset($_POST['zhuz']) && $_POST['zhuz']!='')
{
	$query="insert into sys_maozsj_mx(dhid,cpid,zl,lury) values(".$_POST['dhid'].",".$_POST['zhuz'].",".$_POST['jz'].",'".$_SESSION['uname']."')";
	include("./inc/xexec.php");
}
if(isset($_POST['disrow']) && $_POST['delrow']==0)
{
	for($i=1;$i<=$_POST['disrow'];$i++)
	{
		if($_POST['fy'][$i]!=$_POST['ofy'][$i] || $_POST['sl'][$i]!=$_POST['osl'][$i] || $_POST['zl'][$i]!=$_POST['ozl'][$i] || $_POST['dj'][$i]!=$_POST['odj'][$i] || $_POST['je'][$i]!=$_POST['oje'][$i])
		{
		if($_POST['fy'][$i]!="")$_POST['fy'][$i]=$_POST['fy'][$i];else $_POST['fy'][$i]="null";		
		if($_POST['je'][$i]>0)$_POST['je'][$i]=$_POST['je'][$i];else $_POST['je'][$i]=$_POST['zl'][$i]*$_POST['dj'][$i];
	$query="if exists (select id from sys_maozsj where dhid=".$_REQUEST['dhid']." and cpid=".$_POST['cpid'][$i].") 
update sys_maozsj set feiy=".$_POST['fy'][$i].",sl=".$_POST['sl'][$i].",songhl=".$_POST['zl'][$i].",dj=".$_POST['dj'][$i].",shisje=".$_POST['je'][$i].",lury='".$_SESSION['uname']."' where dhid=".$_REQUEST['dhid']." and cpid=".$_POST['cpid'][$i]." else 
insert into sys_maozsj(dhid,cpid,sl,songhl,dj,shisje,feiy,lury) values(".$_REQUEST['dhid'].",".$_POST['cpid'][$i].",".$_POST['sl'][$i].",".$_POST['zl'][$i].",".$_POST['dj'][$i].",".$_POST['je'][$i].",".$_POST['fy'][$i].",'".$_SESSION['uname']."')";
		include("./inc/xexec.php");
		}
	}
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}
if(nKeyCode==120) {parent.SelCp();}
else if(nKeyCode==38){tt=document.getElementById(event.srcElement.id*1-1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==40 || nKeyCode==13){tt=document.getElementById(event.srcElement.id*1+1);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==37){tt=document.getElementById(event.srcElement.id*1-100);if(tt){tt.select();tt.focus();}}
else if(nKeyCode==39){tt=document.getElementById(event.srcElement.id*1+100);if(tt){tt.select();tt.focus();}}
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
<input type="hidden" name="delcpid" value="<?php echo $delcpid;?>">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="shid" value="0">
<input type="hidden" name="ssid" value="0">
<input type="hidden" name="setdw" value="0">
<table border="1" class="tableborder3">
<?php 
$query="select sj.cpid,sj.sl,sj.songhl,sj.dj,sj.shisje,sj.feiy from sys_maozsj sj where sj.dhid=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
if($result!==false)
{
while($line=sqlsrv_fetch_array($result))
{
	$zsl[$line[0]]=$line[1];
	$zzl[$line[0]]=$line[2];
	$zdj[$line[0]]=$line[3];
	$zje[$line[0]]=$line[4];
	$zfy[$line[0]]=$line[5];
}
sqlsrv_free_stmt($result);
}
$dis_row=0;
$row=0;
$tmp_cp="";
$query="select mx.id,cp.mc,mx.zl,cp.id from sys_maozsj_mx mx,sys_cp cp,sys_maozdh dh where dh.id=mx.dhid and mx.cpid=cp.id and mx.dhid=".$_REQUEST['dhid']." order by mx.cpid,mx.id";
$result=sqlsrv_query($conn,$query);
while($line=sqlsrv_fetch_array($result))
{
	$row=$row+1;
	$tous[$line[3]]+=1;
	$songhl[$line[3]]+=$line[2];
	if($line[3]!=$tmp_cp && $tmp_cp!="")
	{
	$dis_row=$dis_row+1;
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
<td width=8% align=center><input type="hidden" name="cpid[<?php echo $dis_row;?>]" value="<?php echo $tmp_cp;?>"><?php echo $tmp_cpmc;?></td>
<td width=4%><input type="hidden" name="osl[<?php echo $dis_row;?>]" value="<?php echo $zsl[$tmp_cp]==""?$tous[$tmp_cp]:$zsl[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 100+$dis_row;?>"  name="sl[<?php echo $dis_row;?>]" value="<?php echo $zsl[$tmp_cp]==""?$tous[$tmp_cp]:$zsl[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=8%><input type="hidden" name="ozl[<?php echo $dis_row;?>]" value="<?php echo $zzl[$tmp_cp]==""?$songhl[$tmp_cp]:$zzl[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 200+$dis_row;?>"  name="zl[<?php echo $dis_row;?>]" value="<?php echo $zzl[$tmp_cp]==""?$songhl[$tmp_cp]:$zzl[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=4%><input type="hidden" name="odj[<?php echo $dis_row;?>]" value="<?php echo $zdj[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 300+$dis_row;?>"  name="dj[<?php echo $dis_row;?>]" value="<?php echo $zdj[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=8%><input type="hidden" name="oje[<?php echo $dis_row;?>]" value="<?php echo $zje[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 400+$dis_row;?>"  name="je[<?php echo $dis_row;?>]" value="<?php echo $zje[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=4%><input type="hidden" name="ofy[<?php echo $dis_row;?>]" value="<?php echo $zfy[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 500+$dis_row;?>"  name="fy[<?php echo $dis_row;?>]" value="<?php echo $zfy[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=60% align=left><?php echo $str[$tmp_cp];?></td>
<td align=center width=2%><a href="javascript:ed(<?php echo $_REQUEST['dhid'];?>,<?php echo $tmp_cp;?>,0)"><img border=0 src=im/xiug.png></a></td>
<td align=center width=2%><a href="JavaScript:del(<?php echo $_REQUEST['dhid'];?>,<?php echo $tmp_cp;?>,0)"><img border=0 src=im/shanc.png></a></td>
</tr>
<?php
		$str[$line[3]]="";
	}
	if($str[$line[3]]=="")
		$str[$line[3]]=$row."#".$line[2];
	else
		$str[$line[3]]=$str[$line[3]]."<b>,</b>".$row."#".$line[2];
$tmp_cp=$line[3];
$tmp_cpmc=$line[1];
$zl+=$line[2];
}
sqlsrv_free_stmt($result);
if($row>0)
{
	$dis_row=$dis_row+1;
?>
	<tr onclick="k(this)" onMouseOver="v(this)" onMouseOut="o(this)">
<td width=8% align=center><input type="hidden" name="cpid[<?php echo $dis_row;?>]" value="<?php echo $tmp_cp;?>"><?php echo $tmp_cpmc;?></td>
<td width=4%><input type="hidden" name="osl[<?php echo $dis_row;?>]" value="<?php echo $zsl[$tmp_cp]==""?$tous[$tmp_cp]:$zsl[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 100+$dis_row;?>"  name="sl[<?php echo $dis_row;?>]" value="<?php echo $zsl[$tmp_cp]==""?$tous[$tmp_cp]:$zsl[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=8%><input type="hidden" name="ozl[<?php echo $dis_row;?>]" value="<?php echo $zzl[$tmp_cp]==""?$songhl[$tmp_cp]:$zzl[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 200+$dis_row;?>"  name="zl[<?php echo $dis_row;?>]" value="<?php echo $zzl[$tmp_cp]==""?$songhl[$tmp_cp]:$zzl[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=4%><input type="hidden" name="odj[<?php echo $dis_row;?>]" value="<?php echo $zdj[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 300+$dis_row;?>"  name="dj[<?php echo $dis_row;?>]" value="<?php echo $zdj[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=8%><input type="hidden" name="oje[<?php echo $dis_row;?>]" value="<?php echo $zje[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 400+$dis_row;?>"  name="je[<?php echo $dis_row;?>]" value="<?php echo $zje[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=4%><input type="hidden" name="ofy[<?php echo $dis_row;?>]" value="<?php echo $zfy[$tmp_cp];?>"><input onfocus="this.select();" id="<?php echo 500+$dis_row;?>"  name="fy[<?php echo $dis_row;?>]" value="<?php echo $zfy[$tmp_cp];?>" style="height:100%;width:100%;text-align:center;background-color: #EAEAEA;"></td>
<td width=60% align=left><?php echo $str[$tmp_cp];?></td>
<td align=center width=2%><a href="javascript:ed(<?php echo $_REQUEST['dhid'];?>,<?php echo $tmp_cp;?>,0)"><img border=0 src=im/xiug.png></a></td>
<td align=center width=2%><a href="JavaScript:del(<?php echo $_REQUEST['dhid'];?>,<?php echo $tmp_cp;?>,0)"><img border=0 src=im/shanc.png></a></td>
	</tr>
<?php
}
?>
</table>
<input type="hidden" value="<?php echo $_REQUEST['dhid'];?>" name="dhid"><input type=hidden value="<?php echo $dis_row;?>" name=disrow></td>
</form>
</body>
<script language=javascript>
function ed(id,cp,zt)
{	
	if(zt==1)
		parent.parent.layer.msg('单据已审核,禁止操作！', {icon:2,time:1500});
	else
		layer_show3("修改商品猪采购明细","I_Shengzcg1Mx1Edit.php?dhid="+id+"&cpid="+cp,"800","500","");//最后一个是给标识符  需要父级打开就给  不然就空
}
function del(id,cpid,zt)
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
				window.Frm.delcpid.value=cpid;
				window.Frm.edtrow.value=0;
				parent.parent.layer.closeAll();
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
