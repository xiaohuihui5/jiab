<?php
return '
���ڷ�Χ��<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt1" id="datemin" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT1'].'"/>--
<input type="text" onFocus="WdatePicker({lang:\'zh-cn\'})" name="dt2" id="datemax" class="input-text Wdate" style="width:100px;" value="'.$_SESSION['DT2'].'"/>
<input id="gysflid" name="gysflid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysflmc" name="gysflmc" value="��Ӧ�̷���" readonly onclick="layer_show2(\'��Ӧ�̷���ѡȡ\',\'Select_GysFl_Md.php\',\'700\',\'600\')">  
<input id="gysid" name="gysid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="gysmc" name="gysmc" value="��Ӧ��ѡȡ" readonly  onclick="layer_show2(\'��Ӧ��ѡȡ\',\'Select_Gys_Md.php\',\'700\',\'600\')">
<input id="cpxlid" name="cpxlid" type="hidden"> <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpxlmc" name="cpxlmc" value="��Ʒ����" readonly onclick="layer_show2(\'��������ѡȡ\',\'Select_CpXl_Md.php\',\'700\',\'600\')">  
<input id="cpid" name="cpid" type="hidden">  <input type="text" class="input-text" style="width:80px;text-align:center;" id="cpmc" name="cpmc" value="��Ʒѡȡ" readonly  onclick="layer_show2(\'��Ʒѡȡ\',\'Select_Cp_Md.php\',\'700\',\'600\')">
<select name="lx" class="select-box" style="width:85px;height:31px;text-align:center;"><option value="">��������</option><option value="1">�ɹ���</option><option value="4">�ɹ��˻���</option></select>
';
?>