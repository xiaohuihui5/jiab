<?php
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if(isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query='delete from sys_khpm where id='.$_POST['delrow'];
	include('./inc/xexec.php');
}
if(isset($_POST['jies']) and $_POST['jies']!=0)
{
	$query='update sys_khpm set jies=jies^1 where id='.$_POST['jies'];
	include('./inc/xexec.php');
}
if(isset($_POST['edtrow']) and $_POST['edtrow']!=0)
{
	$query='delete from sys_khpm where khid='.$_POST['edtrow'];
	include('./inc/xexec.php');
}
if(isset($_POST['row']))
{  
    
	for($i=1;$i<=$_POST['row'];$i++)
	{
		if($_POST['okhbh'][$i]!=$_POST['khbh'][$i] || $_POST['opm'][$i]!=$_POST['pm'][$i] || $_POST['ocode'][$i]!=$_POST['code'][$i] || $_POST['ohuans'][$i]!=$_POST['huans'][$i] || $_POST['ofdw'][$i]!=$_POST['fdw'][$i] || $_POST['ogg'][$i]!=$_POST['gg'][$i])
		{
		$query="update sys_khpm set bh='".$_POST['khbh'][$i]."',mc='".$_POST['pm'][$i]."',basecode='".$_POST['code'][$i]."',huans=".$_POST['huans'][$i].",dw='".$_POST['fdw'][$i]."',gg='".$_POST['gg'][$i]."' where id=".$_POST['id'][$i];
		$query=str_replace("=,","=null,",$query);
		$query=str_replace("=undefined,","=0,",$query);
		sqlsrv_query($conn,$query);
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
<body >
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="jies" value="0">
<input type="hidden" name="khid" value="<?php echo isset($_POST['khid'])?$_POST['khid']:"";?>">
<input type="hidden" name="cpid" value="<?php echo isset($_POST['cpid'])?$_POST['cpid']:"";?>">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<?php 
$TJ=" and khpm.id>0 ";
if(isset($_POST['khid']) and $_POST['khid']!="")
	$TJ.=" and khpm.flid in(".$_POST['khid'].") ";
if(isset($_POST['cpid']) and $_POST['cpid']!="")
	$TJ.=" and khpm.cpid in(".$_POST['cpid'].") ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and (khpm.bh+khpm.mc+cp.bh+cp.mc like '%".$_POST['cxtj']."%') ";
?>
<table border="0" class="tableborder3">
<?php
 if(menuright(21)>1)
 {  
   $row=0;
   $mid=0;
   $tp1='';
	$query="select 0,0,khfenl.fenlmc,khpm.bh,khpm.mc,khpm.basecode,cast(khpm.huans as varchar),khpm.dw,khpm.gg,cp.bh,cp.mc,cp.dw,cp.gg,khpm.id,case khpm.jies when 0 then '<a href=javascript:js('+cast(khpm.id as varchar(10))+')><font color=red>数量</a>' else '<a href=javascript:js('+cast(khpm.id as varchar(10))+')>重量</a>' end from sys_khpm khpm,sys_khfenl khfenl,sys_cp cp,sys_cpxfl fl where fl.id=cp.typec and khfenl.id=khpm.flid and khpm.cpid=cp.id ".$TJ." order by khpm.flid,fl.bianh";
$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{  
	$row=$row+1;
?>
<td width="3%" align="center"><input align="center" type="hidden" value="<?php echo $line[13]?>" name='id[<?php echo $row?>]'><?php echo $row?></td>
<td width="10%" align="center"><?php echo $line[2];?></td>
<td width="8%" align="center"><input type="hidden" name="okhbh[<?php echo $row;?>]" value="<?php echo $line[3];?>"><input onfocus="this.select()"id="<?php echo 500+$row;?>" name="khbh[<?php echo $row;?>]" value="<?php echo $line[3];?>" style="text-align:center;width:100%;height:100%;background-color: #EAEAEA;"></td>
<td width="22%" align="center"><input type="hidden" name="opm[<?php echo $row;?>]" value="<?php echo $line[4];?>"><input onfocus="this.select()"id="<?php echo 1000+$row;?>" name="pm[<?php echo $row;?>]" value="<?php echo $line[4];?>" style="text-align:center;width:100%;height:100%;background-color: #EAEAEA;"></td>
<td width="13%" align="center"><input type="hidden" name="ocode[<?php echo $row;?>]" value="<?php echo $line[5];?>"><input onfocus="this.select()"id="<?php echo 1500+$row;?>" name="code[<?php echo $row;?>]" value="<?php echo $line[5];?>" style="text-align:center;width:100%;height:100%;background-color: #EAEAEA;"></td>
<td width="4%" align="center"><?php echo $line[14];?></td>
<td width="4%" align="center"><input type="hidden" name="ohuans[<?php echo $row;?>]" value="<?php echo $line[6];?>"><input onfocus="this.select()" id="<?php echo 2000+$row;?>" name="huans[<?php echo $row;?>]" value="<?php echo $line[6];?>" style="text-align:center;width:100%;height:100%;background-color: #EAEAEA;"></td>
<td width="4%" align="center"><input type="hidden" name="ofdw[<?php echo $row;?>]" value="<?php echo $line[7];?>"><input onfocus="this.select()" id="<?php echo 2500+$row;?>" name="fdw[<?php echo $row;?>]" value="<?php echo $line[7];?>" style="text-align:center;width:100%;height:100%;background-color: #EAEAEA;"></td>
<td width="7%" align="center"><input type="hidden" name="ogg[<?php echo $row;?>]" value="<?php echo $line[8];?>"><input onfocus="this.select()" id="<?php echo 3000+$row;?>" name="gg[<?php echo $row;?>]" value="<?php echo $line[8];?>" style="text-align:center;width:100%;height:100%;background-color: #EAEAEA;"></td>
<td width="8%" align="center"><?php echo $line[9];?></td>
<td width="9%" align="center"><?php echo $line[10];?></td>
<td width="4%" align="center"><?php echo $line[11];?></td>
<td width="4%" align="center"><a href=javascript:del(<?php echo $line[13]?>,0)><img border=0 src='im/shanc.png' alt='删除此单'></a></td>
</tr>
<?php
	}
 }
else 
{//查询权限
	$query="select 0,0,khfenl.fenlmc,khpm.bh,khpm.mc,khpm.basecode,cast(khpm.huans as varchar),khpm.dw,khpm.gg,cp.bh,cp.mc,cp.dw,cp.gg,case khpm.jies when 0 then '<font color=red>数量</font>' else '重量' end from sys_khpm khpm,sys_khfenl khfenl,sys_cp cp,sys_cpxfl fl where fl.id=cp.typec and khpm.flid=khfenl.id and khpm.cpid=cp.id ".$TJ." order by khpm.flid,fl.bianh";
	$result=sqlsrv_query($conn,$query);
	while($line=sqlsrv_fetch_array($result))
	{
		$row=$row+1;
?>
<tr>
<td width="4%" align="center"><?php echo $row?></td>
<td width="9%" align="center"><?php echo $line[2];?></td>
<td width="9%" align="center"><?php echo $line[3];?></td>
<td width="10%" align="center"><?php echo $line[4];?></td>
<td width="8%" align="center"><?php echo $line[5];?></td>
<td width="4%" align="center"><?php echo $line[13];?></td>
<td width="4%" align="center"><?php echo $line[6];?></td>
<td width="10%" align="center"><?php echo $line[7];?></td>
<td width="8%" align="center"><?php echo $line[8];?></td>
<td width="10%" align="center"><?php echo $line[9];?></td>
<td width="12%" align="center"><?php echo $line[10];?></td>
<td width="4%" align="center"><?php echo $line[11];?></td>
<td width="8%" align="center"><?php echo $line[12];?></td>
</tr>
<?php
	}
 }
?>
</table>
<input type=hidden value="<?php echo $row;?>" name=row>
</form>	
</body>
<script language=javascript>
function js(id)
{
	if(window.Frm.jies.value==0)
	{
	parent.parent.layer.confirm('您确定要切换结算方式吗?',{
		btn:["确定","取消"],
		shade:0.2,

		yes:function(){
			window.Frm.scroll.value=document.body.scrollTop;
			window.Frm.jies.value=id;
			parent.parent.layer.closeAll();
			window.Frm.submit();
		},
		btn2:function(){
			parent.parent.layer.msg('用户中途取消,此次操作失败!', {icon:2,time:1500});
		}
	});
	}
}
function khdel(id)
{
		parent.parent.layer.confirm('您确定要删除此客户产品吗?',
		{
			btn:["确定","取消"],
			shade:0.2,
			yes:function()
			{
				window.Frm.scroll.value=document.body.scrollTop;
				window.Frm.edtrow.value=id;
				window.Frm.submit();
			},
			btn2:function()
			{
				parent.parent.layer.msg('用户中途取消,此次操作失败!', {icon:2,time:1500});
			}

		}
		);
}
function ed(id)
{	
	window.Frm.scroll.value=document.body.scrollTop;
	layer_show3("客户品名--修改","<?php echo $xiam;?>Edit.php?eid="+id,"600","600","parent");//最后一个是给标识符  需要父级打开就给  不然就空
} 
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

