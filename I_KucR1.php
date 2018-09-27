<?php 
require('./inc/xhead.php');
require('./inc/xpage_downlib.php');
$t_s=explode('/',$_SERVER['PHP_SELF']);$xiam=current(explode('.',end($t_s)));
if (isset($_POST['delrow']) and $_POST['delrow']!=0)
{
	$query="update sys_jhdh set lx=-1*lx where id=".$_POST['delrow'];
	require("./inc/xexec.php");
}
?>
<head>
<link rel="stylesheet" href="./inc/xdown.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {parent.Add();}}</script>
</head>
<body >
<form action="" method=post name="Frm">
<input type="hidden" name="scroll" value="<?php echo isset($_POST['scroll'])?$_POST['scroll']:0;?>">
<input type="hidden" name="delrow" value="0">
<input type="hidden" name="edtrow" value="0">
<input type="hidden" name="shid" value="0">
<input type="hidden" name="cxtj" value="<?php echo isset($_POST['cxtj'])?$_POST['cxtj']:"";?>">
<input type="hidden" name="paix" value="<?php echo isset($_POST['paix'])?$_POST['paix']:"";?>">
<input type="hidden" name="dt1" value="<?php echo isset($_POST['dt1'])?$_POST['dt1']:"";?>">
<input type="hidden" name="dt2" value="<?php echo isset($_POST['dt2'])?$_POST['dt2']:"";?>">
<?php 
if(isset($_POST['dt1']) and $_POST['dt1']!="")
{
	$_SESSION['DT1']=$_POST['dt1'];
	$_SESSION['DT2']=$_POST['dt2'];
}
$TJ=" and dh.lx=7 and dh.dhrq between '".$_SESSION['DT1']."' and '".$_SESSION['DT2']."' ";
if(isset($_POST['cxtj']) and $_POST['cxtj']!="")
	$TJ.=" and dh.dh like '%".$_POST['cxtj']."%' ";
if(isset($_POST['paix']) and $_POST['paix']!="") $px=$_POST['paix']; else $px=" x.id desc";
$macmac="select x.id,0,x.dh,x.dhrq,y.songhl,y.shisje,x.lury,x.xg,x.sc from 
(select dh.lury,dh.id,dh.dh,CONVERT(varchar(10),dh.dhrq,120) as dhrq,'<a href=javascript:ed('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/xiug.png alt=修改此单></a>' as xg,'<a href=javascript:del('+cast(dh.id as varchar(10))+','+cast(dh.zt as varchar(10))+')><img border=0 src=im/shanc.png alt=删除此单></a>' as sc 
from sys_jhdh dh where dh.id>0 ".$TJ.") x left join
(select sj.dhid,sum(songhl) as songhl,sum(shisje) as shisje from sys_jhdh dh,sys_jhsj sj where dh.id=sj.dhid ".$TJ." group by sj.dhid)y on x.id=y.dhid 
order by ".$px;
$macmac.="#"."8,1,1,1,1,1,1,0,0";//1表示单击此行后弹出明细窗口
$macmac.="#".",10%,15%,19%,18%,18%,10%,5%,5%";
$macmac.="#".",center,center,center,right,right,left,center,center";
$macmac.="#";
$macmac.="#";
$macmac.="#";
$macmac.="#";
require("./inc/xNoCountOneRowOpen.php");
?>
</form>	
</body>

<script language=javascript>
function mx(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	openwindow('<?php echo $xiam;?>Mx.php?dhid='+id,1280,768);
}
function ed(id,zt)
{	
	if(zt==1)
		parent.parent.layer.msg('单据已审核,禁止操作！', {icon:2,time:1500});
	else
	{
		window.Frm.scroll.value=document.body.scrollTop;
		layer_show3("修改订单","<?php echo $xiam;?>Edit.php?dhid="+id,"500","300","parent");//最后一个是给标识符  需要父级打开就给  不然就空
	}
}
function sh(id)
{
	window.Frm.scroll.value=document.body.scrollTop;
	window.Frm.shid.value=id;
	window.Frm.submit();
}
</script>
<script defer="defer">setscroll();</script>
<script type="text/javascript" defer="defer">closeload()</script>

