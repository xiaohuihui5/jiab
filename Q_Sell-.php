<?php
return '
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT1'].'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT2'].'"/>
<input id="khflid" name="khflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khflmc" name="khflmc" value="�ͻ�����" readonly onclick="layer_show2(\'�ͻ�����ѡȡ\',\'Select_KhFl_Md.php\',\'700\',\'600\')">  
<input id="khjgid" name="khxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="khxlmc" name="khxlmc" value="�ͻ���·" readonly onclick="layer_show2(\'�ͻ���·ѡȡ\',\'Select_KhXl_Md.php\',\'700\',\'600\')">  
<input id="khid" name="khid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="khmc" name="khmc" value="�ͻ�ѡȡ" readonly  onclick="layer_show2(\'�ͻ�ѡȡ\',\'Select_Kh_Md.php\',\'700\',\'600\')">
<input id="cpxlid" name="cpxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpxlmc" name="cpxlmc" value="��Ʒ����" readonly onclick="layer_show2(\'��������ѡȡ\',\'Select_CpXl_Md.php\',\'700\',\'600\')">  
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="��Ʒѡȡ" readonly  onclick="layer_show2(\'��Ʒѡȡ\',\'Select_Cp_Md.php\',\'700\',\'600\')">
';
?>