<?php
include('../class/Property.class.php');
include('../function.php');
include('../conn.php');

$uid=1;
$a_id=$_GET['id'];//42 33
$aa=Property::detail($uid,$a_id);


echo '<script type="text/javascript">window.history.back();</script>';

?>
<style>
body,ul,li,a,b,span,p{margin:0;padding:0;}
.main{width:100%;}
.property{list-style:none;  font-family:'微软雅黑';}
.property li{ line-height:50px;min-height:50px; overflow: hidden; background:#eee; font-size:20px;margin:10px 0;}
.property li b{text-align:right; font-variant:small-caps;  display:inline-block; width:18%; vertical-align: top;}
.property li span{  display: inline-block; margin: 0 20px;}
.property li p{ width:20%;  display: inline-block;float:right;}

.property li img{max-width:100%;}
</style>
<div class=main>
<ul class=property id=property>
	<li><b>key</b><span>value</span></li>
	<li><b>key</b><span>value</span></li>
	<li><b>key</b><span>value</span></li>
</ul>
</div>
<script>
aa='<?php echo json_encode($aa);?>';
function n(s){console.log(s)}
function $(s){return document.getElementById(s);}
//
bb=eval("("+aa+")");

$('property').innerHTML=getEle(bb);
//n(wjl);


function getEle(json){
	keys=json['key']; //[Object, Object, Object, Object]
	values=json['value']; //[Object, Object, Object, Object]
	if(0==values.length){
		n('nothing');
		return false;
	}
	dom='';
	for(var i=0;i<keys.length;i++){
		key=keys[i];//Object {id: "1", name: "HPLC", type: "1", u_id: "1", rank: "1"}
		for(var j=0;j<values.length;j++){
			value=values[j];
			
			//Object {id: "1", a_id: "42", u_id: "1", add_time: "1452681891", modi_time: "",text: "upload/usr_1/001.jpg",key_id: "6"}
			//n(value['key_id']+' - '+key['id']);
			if(value['key_id']==key['id']){
				k=key['name'];
				v=value['text'];
				id=value['id'];
				
				switch (+key['type']){
					case 0://文字
						dom += '<li><b>'+k+'</b><span>'+v+'</span><p>(text)</p></li>';
						break;
					case 1://图片
						dom += '<li><b>'+k+'</b><span><img src="../../'+v+'" /></span><p>(picture)</p></li>';
						break;
					case 2://附件
						dom += '<li><b>'+k+'</b><span><a href="../../'+v+'" />download</a>(right click, save as...)</span><p>(file)</p></li>';
						break;
					default:
						//n(key['type']+' , key='+ key['name'] +', value='+value['text']+', id='+value['id'])
				}
			}
		}
	}
	return dom;
}

</script>
