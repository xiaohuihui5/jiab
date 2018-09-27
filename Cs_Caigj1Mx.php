<?php 
require('./inc/xhead.php');
require('./inc/xpage_uplib_list.php');
?>
<head>
<title>供应商采购价</title>
<link rel="stylesheet" href="./inc/xup.css?i=1" type="text/css">




<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" /><!--$lur显示模块-->
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script><!--提交-->
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>
<STYLE type=text/css>
body{font-family:"微软雅黑";}
#th{width:100%;border:0px solid #ccc;}
.cl{float:right;margin-right:18px;width:100%;text-align:right;}
.ss{width: 130px;border: 0px solid #ccc;height: 30px;}
table tr th{height:30px;font-size:12px;padding:0px!important;line-height:30px!important;}
.seldiv {width:300;text-align:left;line-height:25px;background-color:#ddecfe;border:1px solid #C2C2C2}
.seltd {font-family: Arial;font-size:12px;color:#000000;padding:3px 2px;border-bottom:1px solid #808080}
</STYLE>
<script type="text/javascript" src="xSelpmMohu.js"></script>
<script language="javascript">
document.onkeydown=bb;function bb()
{var nKeyCode=event.keyCode;
if(nKeyCode==119) {parent.update();}if(nKeyCode==120) {SelCp(1);}
}
</script>

</head>
<body >
<?php
$menuright=menuright(11);//取得菜单权限
//取得单号信息
$query="select a.dh,CONVERT(varchar(10),a.brq,120),CONVERT(varchar(10),a.erq,120),b.shortname,a.beiz,a.unitid from sys_selljg a,sys_unit b where  a.unitid=b.id and a.id=".$_REQUEST['dhid'];
$result=sqlsrv_query($conn,$query);
$line=sqlsrv_fetch_array($result);
$khid=$line[5];
$tis="&nbsp;&nbsp;单号:<font color=black>".$line[0]."</font>";
$tis.="&nbsp;&nbsp;作用日期:<font color=black>".$line[1]."</font>";
$tis.="&nbsp;&nbsp;结束日期:<font color=black>".$line[2]."</font>";
$tis.="&nbsp;&nbsp;供应商名称:<font color=black>".$line[3]."</font>";
sqlsrv_free_stmt($result);
//取得单号信息
$tit='';
if($menuright>1)
$lur='
<table class="hetable" align=center style="width:55%"><form action="'.$xiam.'1.php" target="hqlist" method="post" name="IFrm">
<tr>
<td algin=center onclick="SelCp(1)"><div class="text-c"><font color=blue>产品搜索</font>[F9]</div></td>
<td algin=center><div class="text-c">产品名称</div></td>
<td algin=center><div class="text-c">本期合同售价</div></td>
<td algin=center><div class="text-c">备注</div></td>
<td algin=center><div class="text-c"></div></td>
</tr>
</div>
<tr>
<td algin=center><div class="text-c">
<input type="hidden" name="dhid" value="'.$_REQUEST['dhid'].'">
<input type="hidden" name="cpid" id="cpid">
<input type="hidden" id="oldvalue" name="oldvalue">
<input type="text" class="input-text" style="width: 90px;" onkeyup="AutoFinish()"   title="请输入关键字"  onclick="this.select();CloseTipDiv();" id="spdm" name="spdm">
</div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:140px" id="cpmc" name="cpmc"></div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:80px" id="dj" name="dj" onkeydown="if(event.keyCode==13){window.IFrm.bz.select();}else  if(event.keyCode==39){window.IIFrm.bz.select();}"></div></td>
<td algin=center><div class="text-c"><input type="text" class="input-text" style="width:145px"  id="bz" name="bz" onkeydown="if(event.keyCode==13) sub();"></div></td>
<td algin=center><div class="text-c"><input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;增加&nbsp;&nbsp;" onclick="sub();"></div></td>
</tr>
</IFrm>
</table>
';
else
$lur='';
$cha='';
$lnk='<span class="r">
<a href="xExcel_NoCountdis.php"  title="导出数据到Excel表" class="btn radius"><img border=0 src=im/daoc.png>导出</a> 
<a href="JavaScript:openwindow2(\'Cs_Sellfljg1MxPrint.php?dhid='.$_REQUEST['dhid'].'\',850,500)" title="打印当页数据" class="btn radius"><img border=0 src=im/dy.png>打印</a> </span>';
if($menuright>1)//录入
{
$tis.='&nbsp;&nbsp;&nbsp;<a href="javascript:update()" class="btn btn-primary radius"> F8 保存</a>';
$lie=",序,编号,商品名称,单位,规格,上期合同价,振幅,本期合同价,备注,销售均价,振幅,删";
$wid=",5%,10%,20%,4%,10%,10%,6%,10%,7%,8%,6%,4%";
}
else
{
$lie=",序,编号,商品名称,单位,规格,上期合同价,振幅,本期合同价,备注,销售均价,振幅";
$wid=",5%,10%,20%,4%,10%,10%,6%,10%,8%,10%,7%";
}
$xuh='';
$yul='';
pageup($tit,$lur,$lnk,$cha,$lie,$wid,$xiam."1.php?dhid=".$_REQUEST['dhid'],$tis,$xuh,$yul);

?>
</body>
<script lanuage ="javascript">
function sub()
{
	if($("input[name=cpid]").val()=="" || $("input[name=cpid]").val()==null)
	{
		parent.layer.msg('请选取产品！', {icon:2,time:1500});
		window.IFrm.spdm.focus();
		return false;
	}
	else if($("input[name=dj]").val()=="" || $("input[name=dj]").val()==null)
	{
		parent.layer.msg('合同价格不能为空！', {icon:2,time:1500});
		window.IFrm.dj.focus();
		return false;
	}
	else
	{
		window.IFrm.submit();
		window.IFrm.reset();
		window.IFrm.spdm.focus();
	}
}
function startRequest(spbh,id)//如果传产品id进来Cs_SellfljgAjax.php直接得到产品，否则模糊搜索
{
	createXMLHttpRequest();
	xmlHttp.open("post","Cs_SellfljgAjax.php",true);//提交返回结果的php页面
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
			window.IFrm.cpid.value=arrTmp[0];
			window.IFrm.cpmc.value=arrTmp[1];
			window.IFrm.dj.value=arrTmp[2];
			window.IFrm.dj.select();
			window.IFrm.dj.focus();
                        CloseTipDiv();
			}
		}
	};
	xmlHttp.send("spbh="+spbh+"&id="+id+"&khid=<?php echo $khid;?>");//传递给php页面的参数
}
var tt=document.getElementById('spdm');
if(tt){document.getElementById('spdm').select();document.getElementById('spdm').focus();}
</script>

