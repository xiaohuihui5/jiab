<?php
session_start();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type:text/html;charset=GB2312');
if(isset($_SESSION['empid']))
	require('xc_c.php');
else
	header('Location:./New_NoEnter.html');
?>