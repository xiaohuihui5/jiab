<?php
return '
日期范围：<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT1'].'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT2'].'"/>
<input id="khflid" name="khflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="客户分类" readonly onclick="layer_show2(\'客户分类选取\',\'Select_KhFl_Md.php\',\'700\',\'600\')">  
<input id="khjgid" name="khxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="客户线路" readonly onclick="layer_show2(\'客户线路选取\',\'Select_KhXl_Md.php\',\'700\',\'600\')">  
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="客户选取" readonly  onclick="layer_show2(\'客户选取\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<input id="cpxlid" name="cpxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpxlmc" name="cpxlmc" value="产品分类" readonly onclick="layer_show2(\'二级分类选取\',\'Select_CpXl_Md.php\',\'700\',\'600\')">  
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="产品选取" readonly  onclick="layer_show2(\'产品选取\',\'Select_Cp_Md.php\',\'700\',\'600\')">
';
?>