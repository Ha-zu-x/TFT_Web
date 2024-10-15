<?php
include_once 'kiem-tra-dang-nhap.php';

$sql = "
			SELECT *
			FROM sanpham
			ORDER BY id desc	
";

$arr = $data->query($sql)->fetchAll();
//echo '<pre>'; print_r($arr); echo '</pre>';	


?>
<style>
tr:first-child { color: #FB667A; }  
td:hover {  
    /* font-weight: bold;    */
    transition-delay: 0s;  
    transition-duration: 0.4s;  
    transition-property: all;  
    transition-timing-function: line;  
}  
 
.add {  
  outline: none;  
  background: none;  
  border: none;  
}  
.edit {  
  outline: none;  
  background: none;  
  border: none;  
}  
.save {  
  outline: none;  
  background: none;  
  border: none;  
}  
.delete {  
  outline: none;  
  background: none;  
  border: none;  
}  
.edit {  
  padding: 5px 10px;  
  cursor: pointer;  
}  
.save {  
  padding: 5px 10px;  
  cursor: pointer;  
}  
.delete {  
  padding: 5px 10px;  
  cursor: pointer;  
}  
.cancel {  
  padding: 5px 10px;  
  cursor: pointer; 
  display: none; 
}  
.add {  
  float: right;  
  background: transparent;  
  border: 1px solid  black;  
  color: black;  
  font-size: 13px;  
  padding: 0;  
  padding: 3px 5px;  
  cursor: pointer;  
  &:hover {  
    background: #ffffff;  
    color: #00adee;  
  }  
}  
.save {  
  display: none;  
  background: #32AD60;  
  color: #ffffff;  
  &:hover {  
    background: darken(#32AD60, 10%);  
  }  
}  
.edit {  
  background: #2199e8;  
  color: #ffffff;  
  &:hover {  
    background: darken(#2199e8, 10%);  
  }  
}  
.delete {  
  background: #EC5840;  
  color: #ffffff;  
   &:hover {  
    background: darken(#EC5840, 10%);  
  }  
}  
.cancel {  
  background: #EC5840;  
  color: #ffffff;  
   &:hover {  
    background: darken(#EC5840, 10%);  
  }  
}
</style>
<p style = "font-weight: 600;">Tổng sản phẩm: <span id="tong_sp"></span></p>
<div class="row">
	<div class="col-md-12 table-responsive">
		<table class="table table-bordered text-center">
			<tbody>
                <tr style="background: rgb(62,184,205);color: rgb(255,255,255);">
                    <th>Mã sản phẩm</th>
                    <th>Giá gốc</th>
                    <th>Giá bán</th>
                    <!-- <th>Giảm giá (%)</th> -->
                    <th>Bảo hành</th>
                    <th>Hành động</th>
                </tr>
                <?php
                    //$total = 0;
                foreach($arr as $k=>$v){
                    
                    //$v['noidung'] = str_replace('"img":"','"img":"<img width=40 src=\'',$v['noidung']);
                    //$v['noidung'] = str_replace('"}', '\'>"}',$v['noidung']);
                    if ($v['ma_san_pham']) {
                        $total += 1;
                ?>				
                    <tr>
                        <!-- Ma san pham -->
                        <td type = 'model' class = "data"><?php echo $v['ma_san_pham'] ?></td>
                        <!-- Gia goc -->
                        <td type = "org-price" class = "data data--editable" style="text-align: right"><?php echo number_format( $v['giam_gia_0'],0,",",".") ?></td> 
                        <!-- Gia ban -->
                        <td type = "sell-price" class = "data data--editable" style="text-align: right"><?php echo number_format( $v['gia_0'],0,",",".") ?></td>
                        <!-- Giam gia (So voi hien tai) -->
                        <!-- <td type = "sale-price" class = "data data--editable"><?php echo $v['giam_hien_tai'] ?></td> -->
                        <!-- Bao hanh -->
                        <td class = "data"><?php echo $v['bao_hanh'] ?></td>
                        <td>
                            <button class="save">Save</button>
                            <button class="edit">Edit</button>
                            <button class="cancel">Cancel</button>
                        </td>
                    </tr>
                <?php
                    }
                }
            ?>
			</tbody>
		</table>
	</div>
</div>
<div id="total_sp" style="display:none"><?php echo number_format( $total,0,",",".") ?></div>

<script>
    $('#tong_sp').html($('#total_sp').html())	

    p = $('table').html()
        
    p = p.replaceAll(':&quot;/','"img":"<img width=40 src=\'')
    p = p.replaceAll('"}', '\'>"}');
    // Edit
    $('.table').on('click', '.edit', function() {  
        $(this).parent().siblings('td.data--editable').each(function() {  
            var content = $(this).html();  
            var rst_value = content;
            var type = $(this).attr('type');
            $(this).html('<input default= "' + rst_value + '" name ="' + type + '" value="' + content + '" />');  
        });  
        $(this).siblings('.save').show();  
         $(this).siblings('.cancel').show();  
        $(this).hide();  
    });  
    // Save
    $('.table').on('click', '.save', function() {  
        if (!($('input[name="sell-price"]').val())){
            alert("Selling price can not be empty!");
            return 0;
        }
        else {
            if (confirm("Are you sure?")){
                $('input').each(function() {  
                    var content = $(this).val(); 
                    $(this).html(content);  
                    $(this).contents().unwrap();  
                });
                //Update in database
                
                $(this).siblings('.edit').show();  
                $(this).siblings('.cancel').hide();  
                $(this).hide(); 
                alert("Saved sucessfully!");
            }
        }
    });  
    // Cancel
    $(document).on('click', '.cancel', function() {  
        $('input').each(function() {  
            var content = $(this).attr('default');
            $(this).html(content);
            $(this).contents().unwrap();  
        }); 
        $(this).siblings('.edit').show(); 
        $(this).siblings('.save').hide(); 
        $(this).hide();  
    });  
    /*
    // Delete
    $(document).on('click', '.delete', function() {  
    $(this).parents('tr').remove();  
    });  
    */
</script>

