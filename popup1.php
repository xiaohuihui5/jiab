<table align="center" cellspacing="0" cellpadding="0" border="0" class="table_box">
<tr>
	<td width="49%" height="100%" style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;">
		<table style="width:100%; height:100%;" cellSpacing="0" cellPadding="0" border="0" class="table1">
			<tr>
				<td align=center>
					<select style="width:280;" id="khleix" name="khleix" onchange="ListLeft()">
					<option value="" style="align:center">-------�ͻ�����ѡȡ-------</option>
					<?php 
						$query="select khleix.id,khleix.fenlmc from sys_khleix khleix where khleix.yn=1 order by khleix.bianh,khleix.fenlmc";
						$result=sqlsrv_query($conn,$query);
						while($line=sqlsrv_fetch_array($result))
						{
							echo '<option value="',$line[0],'">',$line[1],'</option>';
						}       
						sqlsrv_free_stmt($result);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align=center>
					<select style="width:280;" id="cpfl" name="cpfl" onchange="ListLeft()">
					<option value="" style="align:center">-------�ͻ�����ѡȡ-------</option>
					<?php 
						$query="select khfenl.id,khfenl.fenlmc from sys_khfenl khfenl where khfenl.yn=1 order by khfenl.bianh,khfenl.fenlmc";
						$result=sqlsrv_query($conn,$query);
						while($line=sqlsrv_fetch_array($result))
						{
							echo '<option value="',$line[0],'">',$line[1],'</option>';
						}       
						sqlsrv_free_stmt($result);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align=center>
					<input id="cxtj"  tabindex="1" name="cxtj" placeholder="ģ������" onkeydown="if(event.keyCode==13) ListLeft()" style="width: 220px;font-family:Verdana,Tahoma,΢���ź�; font-size: 12px; line-height: 15px;">
					<a title="����ģ������" href="javascript:ListLeft()"><i class="icon iconfont icon-sousuo"></i></a>
				</td>
			</tr>
			<tr>
				<td align=center width="100%" height="100%">
				��ѡ�б�<br>
					<select style="width:290px;height:295px" name="fromBox" onDblClick="LtoR_S()" id="fromBox" size="18" multiple="multiple">
					<?php 
						$query="select top 200 unit.id,unit.shortname from sys_unit unit where unit.yn=1 and unit.mode=2 order by unit.usercode,unit.shortname";
						$result=sqlsrv_query($conn,$query);
						while($line=sqlsrv_fetch_array($result))
						{
							echo '<option value="',$line[0],'" title="',$line[1],'">',$line[1],'</option>';
						}       
						sqlsrv_free_stmt($result);
						sqlsrv_close($conn);
					?>
					</select>
				</td>
			</tr>
		</table>
	</td>
	<td width="2%" height="100%" align="center" class="table2">
		<a href="javascript:LtoR_S()" title="�����ѡ�е�����"><b><i class="icon iconfont icon-jiantouyou1"></i></b></a>
		<br>
		<br>
		<a href="JavaScript:LtoR_M()" title="������б�ȫ������"><b><i class="icon iconfont icon-jiantouyou"></i></b></a>
		<br>
		<br>
		<br>
		<br>
		<br>
		<a href="JavaScript:RtoL_S()" title="���ұ�ѡ�е�����"><b><i class="icon iconfont icon-jiantou2"></i></b></a>
		<br>
		<br>
		<a href="JavaScript:RtoL_M()" title="���ұ��б�ȫ������"><b><i class="icon iconfont icon-jiantouarrowheads3"></i></b></a>
	</td>
	<td width="49%" height="100%" style="border:1px solid #ccc;" class="table3">
		<table style="width:100%; height:100%;" cellSpacing="0" cellPadding="0" border="0">
		<tr><td align=center  height="100%">
		<select style="width:290;height:100%" name="toBox" onDblClick="RtoL_S()" id="toBox" size="12" multiple="multiple">
		</select>
		</td></tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" style="color:red;">
		<b>��ʾ��</b>>>�����ѡ������,>>>�����ȫ������,�ɰ�סCtrl����ѡ
	</td>
</tr>
<tr>
	<td align=center colspan="3">
		<input name="SelId" id="SelId" type="hidden" value="">
		<a href="JavaScript:SelOk()"><IMG border=0 src=im/conf.gif></a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="javascript:console()"><IMG border=0 src=im/exit.gif></a>
	</td>
</tr>
</table>