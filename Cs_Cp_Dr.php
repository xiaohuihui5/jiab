<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script language="javascript" src="./inc/xmy.js"></script>

<?php 
require('./inc/xhead.php');
require("./inc/xsys_lib.php");
$rq=date('Y-m-d');//����
$error_cp="";
if(isset($_POST['xiaofl']))
{
	//ȡ��ϸ���ݲ���
	$cp_mc=array();
	$uploaddir='upfile/excel/';
	$uploadfile=$uploaddir.date('YmdHis_').".".array_pop(explode('.',basename($_FILES['upfile']['name'])));
	if(move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile))
	{
		require_once 'upfile/excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP936');
		$data->read($uploadfile);

			for ($i=3;$i<=$data->sheets[0]['numRows']; $i++)//��һ��sheets��3���в�Ʒ�Ŀ�ʼ
			{
				$bh=iconv("gb2312","utf-8//IGNORE",$data->sheets[0]['cells'][$i][2]);//ת��,������뵽ϵͳ�б������
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
						$error_cp.=',���'.$data->sheets[0]['cells'][$i][1].'��'.$data->sheets[0]['cells'][$i][2].'��'.$data->sheets[0]['cells'][$i][3];
				}
			}

	//ȡ��ϸ���ݲ���
	}
	//echo "<script language=javascript>	window.open('I_DaorError.php?cpbh=".$error_cp."','','width=500,height=350,left=362,top=260,resizable=1,scrollbars=1,menubar=no,status=no');parent.layer.closeAll();</script>";
	echo "<script language=javascript>	layer_show('����ʧ����ܰ��ʾ','I_DaorError.php?cpbh=".$error_cp."','','');//parent.layer.closeAll();</script>";
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
<td align=center width="30%"><span class="c-red">*</span><font color=blue>�������ࣺ</font></td>
<td>		<select class="select" size="1" id="xiaofl" name="xiaofl" onkeydown="if(event.keyCode==13) window.Frm.laiy.focus();" style="width:80%;height:30px;">
			<option value=''>��������ѡȡ</option>
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
<td align=center width=30%>Excel��:</td>
<td align=left width=70%>
	<input name="dhid" type="hidden" value="<?php echo $_REQUEST['dhid'];?>">
	<input name="zt" type="hidden" value="100">
	<input name="upfile" type="file" style="width:80%;height:30px;">
</td></tr>
<tr><td align=center colspan=2><a href="upfile/��Ʒ����ģ��.xls" title="��ӡ��ҳ����" class="btn radius">Excel����ģ��</a></td></tr>
<tr><td align=center colspan=2>
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
</td></tr>
<tr><td align=center colspan=2><font size=2 color="#666666">֧��Excel2003��˶Ե����Excel���ʽ�Ƿ���ȷ��</font></tr></td>
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



