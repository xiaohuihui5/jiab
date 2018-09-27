<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib.php');
$query='select gongsids from sys_user where empid='.$_SESSION['empid'];//取得有操作权限的业务点
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
if($line[0]!="")
	$TJ=" and id in(".$line[0].")";
sqlsrv_free_stmt($result);
$syslx=20;
if(isset($_REQUEST['dt1']))
{
	$daocj=sprintf("%1.2f",($_POST['daohzl']*$_POST['chucj']+$_POST['yunzf'])/$_POST['daohzl']);
	$query="insert into sys_shengz(dh,daohrq,unit,tous,chuczl,daohzl,chucj,danj,jine,yunzf,beiz,zt,lx,pinz,gongsid,lury,cheph) values('".getdh($_POST['dt1'],$syslx)."','".$_POST['dt1']."',".$_POST['gysid'].",".$_POST['tous'].",".$_POST['chuczl'].",".$_POST['daohzl'].",".$_POST['chucj'].",".$daocj.",".$_POST['jine'].",".$_POST['yunzf'].",'".$_POST['beiz']."',0,".$syslx.",".$_POST['pinz'].",".$_POST['gongsid'].",'".$_SESSION['uname']."','".$_POST['cheph']."')";
	$query=str_replace(",,",",null,",$query);
	$query=str_replace(",,",",null,",$query);
	include("./inc/xexec.php");
	echo "<script language=javascript>window.parent.Frm.submit();parent.layer.closeAll();</script>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:1px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 1px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:0px!important;}
.seldiv {width:398;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script language="javascript">document.onkeydown=bb;function bb(){var nKeyCode=event.keyCode;if(nKeyCode==120) {Sel();}}</script>
<script language="javascript" src="xSelGysMohu.js"></script>
</head>
<BODY>
<form name="IFrm" method="POST" action="">
<table style="width:95%">
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>业务分点：</td>
	<td>
		<select class="select" size="1" id="gongsid" name="gongsid" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.dt1.focus();" style="width:210px;height:30px;">
			<?php 
			$query='select id,fenlmc from sys_maozfd where id>0 '.$TJ.' order by id';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
<tr><td width="35%" align=right height="40"><span class="c-red">*</span>采购日期：</td><td><input type="text" class="input-text" name="dt1" id="dt1" value="<?php echo date('Y-m-d');?>" onclick="calendar(this)" style="width:210px;"></td>
<tr><td align=right height="40"><span class="c-red">*</span><a href="javascript:;" onclick="Sel()"><font color=blue>[F9]供应商：</font></a></td><td><input type="hidden" value="" id="gysid" name="gysid"><input type="hidden" id="oldvalue" name="oldvalue"><input type="text" class="input-text" onkeyup="AutoFinish();" title="请输入关键字" onclick="this.select();CloseTipDiv();" onkeydown="if(event.keyCode==13) {startRequest(this.value,0);}" style="width: 210px;" id="spdm" name="spdm"></td></tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>生猪品种：</td>
	<td>
		<select class="select" size="1" id="pinz" name="pinz" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.tous.focus();else if(event.keyCode==38)window.IFrm.spdm.select();" style="width:210px;height:30px;">
			<?php 
			$query='select id,mc from sys_cp where yn=1 and typec=1 order by mc';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
				echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
	</td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>头数：</td>
	<td><input type="text" class="input-text"  placeholder="" id="tous" name="tous" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.chuczl.select();else if(event.keyCode==38)window.IFrm.pinz.focus();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">出场重量/斤：</td>
	<td><input type="text" class="input-text"  placeholder="" id="chuczl" name="chuczl" onkeyup="window.IFrm.daohzl.value=this.value;" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.daohzl.select();else if(event.keyCode==38)window.IFrm.tous.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>到场重量/斤：</td>
	<td><input type="text" class="input-text"  placeholder="" id="daohzl" name="daohzl" onkeyup="window.IFrm.jine.value=this.value*window.IFrm.chucj.value+1*window.IFrm.yunzf.value;" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.chucj.select();else if(event.keyCode==38)window.IFrm.chuczl.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>出场价格：</td>
	<td><input type="text" class="input-text"  placeholder="" id="chucj" name="chucj" onkeyup="window.IFrm.jine.value=this.value*window.IFrm.daohzl.value+1*window.IFrm.yunzf.value;" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.yunzf.select();else if(event.keyCode==38)window.IFrm.daohzl.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">运杂费用：</td>
	<td><input type="text" class="input-text"  placeholder="" id="yunzf" name="yunzf" onkeyup="window.IFrm.jine.value=window.IFrm.chucj.value*window.IFrm.daohzl.value+1*this.value;" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.jine.select();else if(event.keyCode==38)window.IFrm.chucj.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40"><span class="c-red">*</span>应付猪款：</td>
	<td><input type="text" class="input-text"  placeholder="" id="jine" name="jine" onkeydown="if(event.keyCode==13 || event.keyCode==40) window.IFrm.cheph.select();else if(event.keyCode==38)window.IFrm.yunzf.select();" style="width:210px;height:30px;"></td>
</tr>
<tr>
	<td align=right width="35%" height="40">车牌号：</td>
	<td><input type="text" class="input-text"  placeholder="" id="cheph" name="cheph" onkeydown="if(event.keyCode==13 || event.keyCode==40) sub();else if(event.keyCode==38)window.IFrm.jine.select();" style="width:210px;height:30px;"></td>
</tr>
<tr><td align=center width="95%" colspan=2>备&nbsp;&nbsp;&nbsp;注</td></tr><tr><td align=center colspan=2><textarea rows="4" name="bz" cols="32" class="textarea" style="width:300px;"></textarea></td></tr>
<tr><td align=center>&nbsp;</td></tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()"></td></tr>
</TABLE>
</form>
</body>
</html>
<script language="javascript">
function sub()
{
	if(window.IFrm.gongsid.value=="")
		layer.msg('请选择业务分点!',{shade:false});
	else if(window.IFrm.gysid.value=="")
		layer.msg('请选择供应商!',{shade:false});
	else if(window.IFrm.tous.value=="")
		layer.msg('头数不能为空,请重新输入!',{shade:false});
	//else if(window.IFrm.chuczl.value=="")
	//	layer.msg('出场重量不能为空,请重新输入!',{shade:false});
	else if(window.IFrm.daohzl.value=="")
		layer.msg('到场重量不能为空,请重新输入!',{shade:false});
	else if(window.IFrm.chucj.value=="")
		layer.msg('出场单价不能为空,请重新输入!',{shade:false});
	else if(window.IFrm.jine.value=="")
		layer.msg('应付猪款不能为空,请重新输入!',{shade:false});
	else
	{
		window.IFrm.submit();
      }
}
function startRequest(spbh,id)//如果传产品id进来直接得到，否则模糊搜索
{
//alert(spbh);
	createXMLHttpRequest();
	xmlHttp.open("post","xSelGysAjax.php",true);//提交返回结果的php页面
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-Type","text/xml");
	xmlHttp.setRequestHeader("Content-Type","gb2312");
	xmlHttp.onreadystatechange = function ()
	{
	if (xmlHttp.readyState == 4)
		{
			if (xmlHttp.status == 200)
			{
			var arrTmp= xmlHttp.responseText.split("@");
			window.IFrm.gysid.value=arrTmp[0];
			window.IFrm.spdm.value=arrTmp[1];
			CloseTipDiv();
			window.IFrm.pinz.focus();
			}
		}
	}
	xmlHttp.send("spbh="+spbh+"&id="+id);//传递给php页面的参数
}
function Sel()
{
	layer_show2("供应商选取","I_Select_SzGys_S.php","400","460"); //最后一个参数是给一个标识符 
} 
function exit()
{
	parent.layer.closeAll();
}
window.IFrm.spdm.focus();
window.IFrm.spdm.select();
</script>

