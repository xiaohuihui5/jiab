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
<title>�ҵ�����</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">��ӭʹ��������� <span class="f-14">v8.1</span>�ۺ�ҵ�����ϵͳ��</p>
	<p>���ܵ�¼������<b><?php echo $loginnums;?></b> </p>
	<p>�ϴε�¼ʱ�䣺<b><?php echo $logintime;?> </b></p>
	<p>�ϴε�¼���������<b><?php echo $nam;?> </b> </p>
	<p>�ϴε�¼�����IP��ַ��<b><?php echo $vip;?> </b> </p>
	<p></p>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer mt-20">
	<div class="container">
		<p>����ʹ��1280*1024�����Ϸֱ��ʵ�¼ϵͳ<br>
			����̨ϵͳ��<a href="http://www.chinause.cn" target="_blank">��������������Ƽ����޹�˾</a>�ṩ����֧��</p>
	</div>
</footer>
</body>
</html>
