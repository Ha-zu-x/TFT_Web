<?php
include_once 'kiem-tra-dang-nhap.php';

$sql = "
			SELECT *
			FROM donhang
			ORDER BY id desc	
";

$arr = $data->query($sql)->fetchAll();
//echo '<pre>'; print_r($arr); echo '</pre>';	


?>
<style>
th,td{}
</style>
<p> Doanh Thu: <span id="doanh-thu"></span></p>
<div class="row">
	<div class="col-md-8 table-responsive">
	
		<table class="table table-bordered text-center">
			<tbody>
				<tr style="background: rgb(62,184,205);color: rgb(255,255,255);">
<th>Đơn hàng</th>
<th>Ngày</th>
<th>Giá trị</th>
<th>Thông tin User</th>
<th>idUser</th>
				</tr>
<?php
$total = 0;
foreach($arr as $k=>$v){

	$total += $v['giatri'];
	//$v['noidung'] = str_replace('"img":"','"img":"<img width=40 src=\'',$v['noidung']);
	//$v['noidung'] = str_replace('"}', '\'>"}',$v['noidung']);
?>				
				<tr>
<td><a href="#" class="data click" data-id='<?php echo $v['noidung'] ?>'><?php echo $v['id'] ?></a></td>
<td><?php echo $v['ngay'] ?></td>
<td style="text-align: right"><?php echo number_format( $v['giatri'],0,",",".") ?></td>
<td><?php echo $v['infoUser'] ?></td>
<td><a href="#" class="user click" data-user='<?php echo $v['idUser'] ?>'><?php echo $v['idUser'] ?></a></td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
	</div>

	<div class="col-md-4 table-responsive" id='mydiv'></div>
</div>
<div id="total" style="display:none"><?php echo number_format( $total,0,",",".") ?></div>
<script>
$(".user").on('click', function(event){
	var iduser =$(this).data('user')
	$(".click").removeClass('bg-info')
	$(this).addClass("bg-info");
	$.ajax
		({
			type: "POST",
			url:"/admin/getInfoUser.php",
			data: {					
				id	:iduser,
			},
			beforeSend:function(){				
				$("#mydiv").html('<img class="center-block" src="/images/loading.gif" alt="loading">');
			},
			
			success: function(res){
				$("#mydiv").html(res)								
			} 
	});
	

});





	$('#doanh-thu').html($('#total').html())	

//p = '[{"name":"J-link Adapter Cổng Chuyển Đổi Kết Nối","price":39000,"amount":1,"img":"/user-upload/imgs/j-link-adapter-cong-chuyen-doi-ket-noi.jpg"},{"name":"K150 Mạch Nạp PIC","price":137000,"amount":1,"img":"/user-upload/imgs/k150-mach-nap-pic.jpg"}]'
p = $('table').html()
	
p = p.replaceAll(':&quot;/','"img":"<img width=40 src=\'')
p = p.replaceAll('"}', '\'>"}')
console.log(p)

//$('table').html(p)	
//alert(p)
//[{"name":"Mạch Nạp JLINK OB V8 MicroUSB","price":99000,"count":1}]
//var fruits = JSON.parse('[{"key":"apple","value":1.90}, {"key":"berry","value":1.7}, {"key":"banana","value":1.5}, {"key":"cherry","value":1.2} ]');

    //let myobj =JSON.parse('[{ "name": "apple", "rel": 1.90 },{ "name": "berry", "rel": 1.7 }, { "name": "banana", "rel": 1.5 }]');


$(".data").on('click', function(event){
	let myobj =$(this).data('id')
	document.querySelector("#mydiv").innerHTML = tableMarkupFromObjectArray(myobj)
	$(".click").removeClass('bg-info')
	$(this).addClass("bg-info");
});

    function tableMarkupFromObjectArray(obj) {
		//obj = JSON.parse(obj_text);
      let headers = `
      <th>TT</th>
      ${Object.keys(obj[0]).map((col) => {
        return `<th>${col}</th>`
      }).join('')}`

      let content = obj.map((row, idx) => {
        return `<tr>
          <td>${idx+1}</td>
          ${Object.values(row).map((datum) => {
          return `<td>${datum}</td>`
        }).join('')}
        </tr>
    `}).join('')

      let tablemarkup = `
      <table class='table table-bordered'>
        ${headers}
        ${content}
      </table>
      `
      return tablemarkup
	  
    }

    

</script>

