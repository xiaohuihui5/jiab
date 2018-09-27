<?php
	require('./inc/xhead.php');
                $query='select loginnums from sys_user where empid='.$_SESSION['empid'];
                $result=sqlsrv_query($conn,$query);
                $line=sqlsrv_fetch_array($result);
			$loginnums=$line[0];
                sqlsrv_free_stmt($result);

                $query='select top 2 convert(varchar(20),logintime,120),vip,nam from sys_login where empid='.$_SESSION['empid'].' order by ID desc';
                $result=sqlsrv_query($conn,$query);
                $line=sqlsrv_fetch_array($result);
                $line=sqlsrv_fetch_array($result);
				$logintime=$line[0];$vip=$line[1];$nam=$line[2];
                sqlsrv_free_stmt($result);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎使用中用软件 <span class="f-14">v8.1</span>综合业务管理系统！</p>
	<p>您总登录次数：<b><?php echo $loginnums;?></b> </p>
	<p>上次登录时间：<b><?php echo $logintime;?> </b></p>
	<p>上次登录计算机名：<b><?php echo $nam;?> </b> </p>
	<p>上次登录计算机IP地址：<b><?php echo $vip;?> </b> </p>
	<p></p>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer mt-20">
	<div class="container">
		<p>建议使用1280*1024及以上分辨率登录系统<br>
			本后台系统由<a href="http://www.chinause.cn" target="_blank">深圳市中用软件科技有限公司</a>提供技术支持</p>
	</div>
</footer>
</body>
</html>
