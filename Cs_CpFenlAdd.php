<?php
require('./inc/xhead.php');
if (isset($_POST['mc']))//lurָ����¼����������Ǹ��ֹ�˾��,chaxָ��Ȩ�޲�ѯ�Ĺ�˾id��
{
	$query="insert into sys_cpfenl(bianh,fenlmc,yn) values('".$_POST['bh']."','".$_POST['mc']."',1)";
	require("./inc/xexec.php");
       if($res)
	{
			$_SESSION['layer']="aa"; //������д��ɹ���ʱ�� ��aa�Ž�session��
			//echo "<script language=javascript>parent.layer.closeAll();layer.msg('��ӳɹ�',{shade:false})</script>";
       }
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>һ������--��������</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >


	<form name="forml" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>���:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="" id="bh" name="bh" onkeydown="if(event.keyCode==13)event.keyCode=9">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>һ����������:</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input type="text" class="input-text"  id="mc"  name="mc" onkeydown="if(event.keyCode==13)event.keyCode=9" >	
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;�ύ&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;ȡ��&nbsp;&nbsp;" onclick="exit()">
			</div>
		</div>


	</form>



</body>
</html>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script lanuage="javascript">
$("input[type=text],.select-box,textarea").css("width","80%");
function sub()
{
	if(window.forml.bh.value=="")
		layer.msg('��Ų���Ϊ��!',{shade:false});
	else if(window.forml.mc.value=="")
		layer.msg('���Ʋ���Ϊ��!',{shade:false});
	else
		window.forml.submit();       
}
function exit()
{
	parent.layer.closeAll();
}
</script>
