<?php
return '
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT1'].'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT2'].'"/>
<input id="gysflid" name="gysflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysflmc" name="gysflmc" value="供应商分类" readonly onclick="layer_show2(\'供应商分类选取\',\'Select_GysFl_Md.php\',\'700\',\'600\')">  
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="供应商选取" readonly  onclick="layer_show2(\'供应商选取\',\'Select_Gys_Md.php\',\'700\',\'600\')">
<input id="cpxlid" name="cpxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpxlmc" name="cpxlmc" value="产品分类" readonly onclick="layer_show2(\'二级分类选取\',\'Select_CpXl_Md.php\',\'700\',\'600\')">  
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="产品选取" readonly  onclick="layer_show2(\'产品选取\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<select name="lx" class="select-box" style="width:85px;height:31px;text-align:center;"><option value="">单号类型</option><option value="1">采购单</option><option value="4">采购退货单</option></select>
';
?>