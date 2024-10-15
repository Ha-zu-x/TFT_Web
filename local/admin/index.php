<?php 
include 'kiem-tra-dang-nhap.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/admin/dist/style.min.css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.min.js" ></script>
<script type="text/javascript" src="/admin/dist/jstree.min.js"></script>
<title></title>
</head>
<body style="margin-bottom: 50px;">
<div class="container-fluid"  style="position: relative;">
	<h1>Quản trị website</h1>
	<button class="btn btn-info btn-xs" onclick="editPass()">đổi mật khẩu</button>	
	<div class="row">
			<div class="col-sm-8"><hr>
				<div id="tree-container" ></div>
			</div>
			<div class="col-sm-4"><hr>
				<center><button class="btn btn-success" onclick="edit_layout('top')">Trên</button></center>
				<button class="btn btn-success" onclick="edit_layout('left')">Trái</button>
				<button class="btn btn-success pull-right" onclick="edit_layout('right')">Phải</button>
				<center><button class="btn btn-success" onclick="edit_layout('bottom')">Dưới</button></center>
				<hr>
				<center>
				
				<button class="btn btn-success" onclick="edit_layout('info')">Info</button>&nbsp;
				<button class="btn btn-success" onclick="edit_layout('slide')">Slide</button>&nbsp;
				<button class="btn btn-success" onclick="edit_layout('doi-tac')">Đối tác</button>&nbsp;
				<button class="btn btn-success" onclick="edit_layout('thong-bao-hoan-thanh')">Thông báo hoàn thành</button>
				<hr>
				<!-- <button class="btn btn-success" onclick="load_file('don-hang.php')">Danh Sách Đơn Hàng</button> -->
				<button class="btn btn-success" onclick="load_file('san-pham.php')">Danh Sách Sản Phẩm</button>
				<button class="btn btn-success" onclick="load_file('agency.php')">Danh Sách Đại Lý</button>
				</center>
			</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="modal" data-backdrop="-static">
		<div class="modal-dialog modal-lg" style=" width: 100%; " role="document">
			<div class="modal-content">
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
				<div class="modal-body" id="modal-body" ></div>		
			</div>
		</div>
	</div>
	
	
</div>

<div id="bien_tap"></div>

<script>
var text = '';
var select_node_id = 1;
	function load_file(filename){
		$("#modal").modal();
		$.ajax({
			url:"/admin/" + filename,
			beforeSend:function(){				
				$('#modal-body').html('<img class="center-block" src="/images/loading.gif" alt="loading">');
			},
			success:function(msg){				
				$("#modal-body").html(msg);				
			},
		});   
    }
	
	function editPass(user_id){
		var pass = prompt("Nhập password mới", "");    
		if (pass != null) {
			$.ajax({
				url:"/registeration/user_pass_update.php?password=" + pass ,
				success:function(msg){
					$("#thong_bao").html(msg);			
				},
			});    
    }}
	function createNode(parent_node, new_node_id, new_node_text, url, position) {
		$('#tree-container').jstree('create_node', $(parent_node), { 
			"text":new_node_text, 
			"id":new_node_id,
			"parent": select_node_id,
			"a_attr":{"href":"/" + url } 
			
			}, position, false, false);	
	}
	
	function edit_layout(vitri) {
		$.ajax({
			url:"layout-ckeditor.php?vitri=" + vitri,
			beforeSend:function(){
				//$("#modal").modal('show');
				$('#bien_tap').html('<img class="center-block" src="/images/loading.gif" alt="loading">');
			},
			success:function(msg){
				
				$("#bien_tap").html(msg);				
			},
		});
	}	
	
	$(document).on('click', 'a > .jstree-themeicon', function(e){ 
		e.preventDefault(); 
		var url = $( this ).parent().attr('href'); 
		window.open(url, '_blank');
	});
	
	
	$('#tree-container').jstree({
        'core' : {			
			'data' : {
              'url' : 'response.php?operation=get_node',
              'data' : function (node) {
                return { 'id' : node.id };				
              },
              "dataType" : "json"
            },
			'check_callback' : true,
			"multiple" : false,
            'themes' : {
				'responsive' : false,
				'icons' : true,
				//"variant" : "large"
            },
		},
		
		checkbox: {       
		  three_state : false, // to avoid that fact that checking a node also check others
		  whole_node : false,  // to avoid checking the box just clicking the node 
		  tie_selection : false, // for checking without selecting and selecting without checking
		  
		},
		'plugins' : ['contextmenu','wholerow','checkbox'], //'state','contextmenu','wholerow','checkbox','massload'
		"contextmenu":{         
			"items": function($node) {
				var tree = $("#tree-container").jstree(true);
				return {
					
					createItem: {
						"separator_before"	: true,
						"icon"				: false,
						"separator_after"	: false,
						"label"				: "Tạo mới",
						"action"			: false,
						"submenu" : { 
							"Tạo mới" : {
								"separator_before"	: false,
								"separator_after"	: false,
								"label"				: "Thư mục, bài viết",
								"action"			: function (obj) { 
									var value = prompt('Đặt tên node con của: ' + text);    
									if (value != null ) {										
										$.ajax({											
											url: '/admin/insertUrl.php',
											type: 'get',				
											data: {					
												table		:'<?php echo $bai_viet ; ?>',					
												text		:value,
												parent_id	:select_node_id,
											},
											success:function(response){
												//console.log(response)
												// response	: kiểu json
												var response = JSON.parse(response);
												createNode("#" + select_node_id, response.id, response.text, response.url, "first");
												//$('#tree-container').jstree(true).refresh();
											},
										});
									}							
								}
							},
/*	*/
							"Sản Phẩm" : {
								"separator_before"	: false,
								"separator_after"	: false,
								"label"				: "Tạo sản phẩm",
								"action"			: function (obj) { 
									var value = prompt('Đặt tên node con của: ' + text);    
									if (value != null ) {
										$.ajax({
											type: 'get',				
											data: {					
												table		:'<?php echo $bai_viet ; ?>',					
												text		:value,
												parent_id	:select_node_id,
												chitiet		:1,
											},
											url: '/admin/insertUrl.php',
											success:function(response){																								
												var response = JSON.parse(response);
												console.log(response) ;
												createNode("#" + select_node_id, response.id, response.text, response.url, "first");
												$.ajax({
													type: 'get',				
													data: {					
														table	:response.kinhdoanh,					
														id		:response.id,														
													},
													url: '/control/insert.php',
													success:function(response_sp){														
														console.log(response_sp)
													},
												});
											},
										});

									}							
								}
							},		
						}
					},
					"Biên tập" : {
						"separator_before"	: false,
						"separator_after"	: false,
						"label"				: "Biên tập",
						"action"			: function (data) {
							console.log(data);							
/*	*/						
							$.ajax({
								url:"ckeditor.php?id=" + select_node_id,
								beforeSend:function(){
									//$("#modal").modal('show');
									$('#bien_tap').html('<img class="center-block" src="/images/loading.gif" alt="loading">');
								},
								success:function(msg){
									$("#bien_tap").html(msg);				
								},
							});
					
						}
					},
					"Rename": {
						//"separator_before": false,
						//"separator_after": false,
						"label": "Sửa",
						"action": function (obj) { 
							tree.edit($node);
						}
					},                         
					"Remove": {						
						"label": "Xóa",
						"action": function (obj) { 
							//console.log(obj);
							//tree.delete_node($node);
							
							$.ajax({
								url:"check-children-node.php?id=" + $node.id ,
								success:function(msg){									
									if(msg==0)
										tree.delete_node($node);
									else alert('Xóa node con trước');
								},
							});
							
						}
					}
				};
			}
			
		}
	})
	.on('rename_node.jstree', function (e, data) {
		$.get('response.php?operation=rename_node', { 'id' : data.node.id, 'text' : data.text })
		.fail(function () {
			//data.instance.refresh();
		});
	})
	.on('delete_node.jstree', function (e, data) {
		$.get('response.php?operation=delete_node', { 'id' : data.node.id })
		.fail(function () {	
			//data.instance.refresh();
		});
	})	
	.on("changed.jstree", function (e, data) {
		if(data.selected.length){
			text=data.instance.get_node(data.selected[0]).text;
			select_node_id = data.node.id;
			$('title').html('pa:' + data.node.parent + ' ,sel:'+ select_node_id + ' ,t:'+text);
			$('#bt_Editor,#bt_create').removeAttr("disabled");
		}
		console.log(data);
		//location.href = this.href;
	})
	.on("check_node.jstree uncheck_node.jstree", function(e, data) {
		//$('title').html(data.node.text +(data.node.state.checked ? ' CHECKED': ' NOT CHECKED'))
		var value;
		if(data.node.state.checked){
			value=1;
			$('title').html(data.node.text + ' CHECKED, id='+ data.node.id)			
		}else{
			value=0;
			$('title').html(data.node.text + ' NOT CHECKED, id='+ data.node.id)
		}
		console.log(data.node.parents);
		$.ajax({
			url:"/control/update.php?id=" + data.node.id + '&parent_id='+ data.node.parent + '&view='+ value + '&table=<?php echo $bai_viet ; ?>',
			success:function(msg){
				if(value==0){
					alert("Nội dung trang '" + data.node.text + "' không được hiển thị")
				}else{
					alert("Nội dung trang '" + data.node.text + "' đã được hiển thị")
				}
				
				console.log(msg);
			},
		});
	})
</script>

</body>
<h3><?php echo $lq_model; ?> </h3>
</html>