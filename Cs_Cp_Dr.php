<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>

<?php 
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
$rq=date('Y-m-d');//今天
$error_cp="";
if(isset($_POST['xiaofl']))
{
	//取明细数据部分
	$cp_mc=array();
	$uploaddir='upfile/excel/';
	$uploadfile=$uploaddir.date('YmdHis_').".".array_pop(explode('.',basename($_FILES['upfile']['name'])));
	if(move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile))
	{
		require_once 'upfile/excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP936');
		$data->read($uploadfile);

			for ($i=3;$i<=$data->sheets[0]['numRows']; $i++)//第一个sheets第3行有产品的开始
			{
				$bh=iconv("gb2312","utf-8//IGNORE",$data->sheets[0]['cells'][$i][2]);//转码,避免插入到系统中变成乱码
				$mc=$data->sheets[0]['cells'][$i][3];
				$dw=$data->sheets[0]['cells'][$i][4];
				$gg=$data->sheets[0]['cells'][$i][5];
				$laiy=$data->sheets[0]['cells'][$i][6];
				$query="insert into sys_cp(yn,weix_dis,bh,mc,dfl,xiaofl,laiy,dw,gg,piny,shuiw) select 1,1,'".$bh."','".$mc."',dafl,".$_POST['xiaofl'].",".$laiy.",'".$dw."','".$gg."','".Get_Piny($mc)."',1 from sys_cpxiaofl where id=".$_POST['xiaofl'];
				$res=sqlsrv_query($conn,$query);
				if($res)
				{
					echo "";			
				}
				else
				{	
						$error_cp.=',序号'.$data->sheets[0]['cells'][$i][1].'—'.$data->sheets[0]['cells'][$i][2].'—'.$data->sheets[0]['cells'][$i][3];
				}
			}

	//取明细数据部分
	}
	//echo "<script language=javascript>	window.open('I_DaorError.php?cpbh=".$error_cp."','','width=500,height=350,left=362,top=260,resizable=1,scrollbars=1,menubar=no,status=no');parent.layer.closeAll();</script>";
	echo "<script language=javascript>	layer_show('导入失败温馨提示','I_DaorError.php?cpbh=".$error_cp."','','');//parent.layer.closeAll();</script>";
}
?>
<HTML>
<HEAD>
<title><?php echo $DHLX;?></title>
<script language="javascript" src="./inc/xdate.js"></script>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />

</HEAD>
<body>
<form name="IFrm" enctype="multipart/form-data" method="POST" action="">
<table style="width:100%; height:100%;">

<tr>
<td align=center width="30%"><span class="c-red">*</span><font color=blue>二级分类：</font></td>
<td>		<select class="select" size="1" id="xiaofl" name="xiaofl" onkeydown="if(event.keyCode==13) window.Frm.laiy.focus();" style="width:80%;height:30px;">
			<option value=''>二级分类选取</option>
			<?php 
			$query='select id,fenlmc from sys_cpxiaofl where yn=1 order by bianh';
			$result=sqlsrv_query($conn,$query);
			while($line=sqlsrv_fetch_array($result))
			{
			if($_POST['xiaofl']==$line[0])
				echo "<option value=".$line[0]." selected>".$line[1]."</option>";
			else
				echo '<option value=',$line[0],'>',$line[1],'</option>';
			}       
			sqlsrv_free_stmt($result);
			?>
		</select>
</td>
</tr>
<tr>
<td align=center width=30%>Excel表:</td>
<td align=left width=70%>
	<input name="dhid" type="hidden" value="<?php echo $_REQUEST['dhid'];?>">
	<input name="zt" type="hidden" value="100">
	<input name="upfile" type="file" style="width:80%;height:30px;">
</td></tr>
<tr><td align=center colspan=2><a href="upfile/产品导入模板.xls" title="打印当页数据" class="btn radius">Excel导入模板</a></td></tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
</td></tr>
<tr><td align=center colspan=2><font size=2 color="#666666">支持Excel2003请核对导入的Excel表格式是否正确！</font></tr></td>
</TABLE>
</form>
</body>
</HTML>
<script lanuage ="javascript">
function sub()
{
	openload();
	window.IFrm.submit();
}
function exit()
{
	parent.layer.closeAll();
}
</script>



