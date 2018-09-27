<table align="center" cellspacing="0" cellpadding="0" border="0" class="table_box">
<tr>
	<td width="49%" height="100%" style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;">
		<table style="width:100%; height:100%;" cellSpacing="0" cellPadding="0" border="0" class="table1">
			<tr>
				<td align=center>
					<select style="width:280;" id="khleix" name="khleix" onchange="ListLeft()">
					<option value="" style="align:center">-------客户类型选取-------</option>
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
					<option value="" style="align:center">-------客户分类选取-------</option>
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
					<input id="cxtj"  tabindex="1" name="cxtj" placeholder="模糊查找" onkeydown="if(event.keyCode==13) ListLeft()" style="width: 220px;font-family:Verdana,Tahoma,微软雅黑; font-size: 12px; line-height: 15px;">
					<a title="名称模糊查找" href="javascript:ListLeft()"><i class="icon iconfont icon-sousuo"></i></a>
				</td>
			</tr>
			<tr>
				<td align=center width="100%" height="100%">
				待选列表<br>
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
		<a href="javascript:LtoR_S()" title="将左边选中的右移"><b><i class="icon iconfont icon-jiantouyou1"></i></b></a>
		<br>
		<br>
		<a href="JavaScript:LtoR_M()" title="将左边列表全部右移"><b><i class="icon iconfont icon-jiantouyou"></i></b></a>
		<br>
		<br>
		<br>
		<br>
		<br>
		<a href="JavaScript:RtoL_S()" title="将右边选中的左移"><b><i class="icon iconfont icon-jiantou2"></i></b></a>
		<br>
		<br>
		<a href="JavaScript:RtoL_M()" title="将右边列表全部左移"><b><i class="icon iconfont icon-jiantouarrowheads3"></i></b></a>
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
		<b>提示：</b>>>将左边选中右移,>>>将左边全部右移,可按住Ctrl键多选
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