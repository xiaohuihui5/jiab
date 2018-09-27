<?php
require('./inc/xhead.php');
if (isset($_POST['mc']))//lur指的是录入的数据是那个分公司的,chax指有权限查询的公司id号
{
	$query="insert into sys_cpfenl(bianh,fenlmc,yn) values('".$_POST['bh']."','".$_POST['mc']."',1)";
	require("./inc/xexec.php");
       if($res)
	{
			$_SESSION['layer']="aa"; //当数据写入成功的时候 将aa放进session中
			//echo "<script language=javascript>parent.layer.closeAll();layer.msg('添加成功',{shade:false})</script>";
       }
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>一级分类--新增分类</title>
<link rel="stylesheet" href="./inc/xup.css" type="text/css">
<link rel="stylesheet" href="./inc/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<BODY >


	<form name="forml" action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>编号:</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="" id="bh" name="bh" onkeydown="if(event.keyCode==13)event.keyCode=9">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>一级分类名称:</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input type="text" class="input-text"  id="mc"  name="mc" onkeydown="if(event.keyCode==13)event.keyCode=9" >	
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="sub()">
				<input class="btn radius delcom" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" onclick="exit()">
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
		layer.msg('编号不能为空!',{shade:false});
	else if(window.forml.mc.value=="")
		layer.msg('名称不能为空!',{shade:false});
	else
		window.forml.submit();       
}
function exit()
{
	parent.layer.closeAll();
}
</script>
