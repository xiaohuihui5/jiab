<script language="javascript" src="./inc/xSelectajax.js" type="text/javascript" charset="GB2312"></script>
<div class="box disnone">
	<div class="layui-layer-shade" id="layui-layer-shade1" times="1" style="z-index:19891014; background-color:#000; opacity:0.4; filter:alpha(opacity=40);"></div>
		<div class="layui-layer layui-layer-iframe  layer-anim" id="layui-layer1" type="iframe" times="1" showtime="0" contype="string" style="z-index: 19891015; width: 800px; height: 510px; position: absolute; top: 219.5px; left: 278px;">
		<div class="layui-layer-title" style="cursor: move;" move="ok">��Ʒѡȡ</div>
		<div id="" >
			<?php include('popup1.php');?>
		</div>
		<span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;" onclick="console()"></a></span>
	</div>
</div>

<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer ��Ϊ����ģ������ȥ-->

<!--�����·�д��ҳ��ҵ����صĽű�-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script>
	function console(){
		$('.box').addClass("disnone");
	}
	function DisSelect(IdStr,cwho)
	{
		CreateSelect("Select_Kh_M1.php",cwho,"selid="+IdStr+"&cxtj="+document.getElementById('cxtj').value+"&cpfl="+document.getElementById('cpfl').value+"&khleix="+document.getElementById('khleix').value);//��һ��������ajaxȡֵ��phpҳ��ϵͳ�Զ����,�ڶ�������Ϊ0��ʾ��ʾ���ѡ���,Ϊ1��ʾ�ұ�Ϊ2���Ҷ���ʾ,����������Ϊ�ύ�Ĳ�ѯ����
	}
	function SelOk()
	{
		var s_id="";
		var s_name="";
		for(var num=0;num<document.getElementById('toBox').length;num++)
		if(s_id=="")
		{
			s_id=document.getElementById('toBox').options[num].value;
			s_name=document.getElementById('toBox').options[num].text;
		}
		else
		{
			s_id=s_id+","+document.getElementById('toBox').options[num].value;
			s_name=s_name+","+document.getElementById('toBox').options[num].text;
		}
		if(s_id=="") s_name="--�ͻ�ѡȡ--";
		if(s_id){
			var aa = $("input[name='cpflid']").val(s_id);
			var bb = $("input[name='cpflmc']").val(s_name);
		}else{
			var bb = $("input[name='cpflid']").val("");
			var aa = $("input[name='cpflmc']").val("");
			$('.box').addClass("disnone");
		}
		
	}
</script>