<?php
include_once 'kiem-tra-dang-nhap.php';
$table_name = 'daily';
$sql = "
			SELECT *
			FROM $table_name
			ORDER BY Id asc	
";

$arr = $data->query($sql)->fetchAll();
$last_id = end($arr)['Id'];
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
 button {
     border-radius: 6px;
 }

button:disabled,
button[disabled]{
  background-color: #ccc;
  color: #666666;
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
  display: block;  
  padding: 5px 10px;
  background: #2199e8;  
  color: #ffffff;  
  margin-bottom: 10px;

  &:hover {  
    background: darken(#32AD60, 10%);  
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
input {
    width: 100%;
}

</style>
<p style = "font-weight: 600;">Danh sách đại lý: <span id="tong_sp"></span></p>
<div class="row">
	<div class="col-md-12 table-responsive">
        <button class="add" enabled>Add</button>
		<table class="table table-bordered text-center">
			<tbody>
                <tr style="background: rgb(62,184,205);color: rgb(255,255,255);">
                    <th>Continent</th>
                    <th>Country</th>
                    <th>ANTT</th>
                    <th>Tel</th>
                    <th>Website</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Location(Top:Left)</th>
                    <th style="padding: 0 5em;">Hành động</th>
                </tr>
                <?php
                    //$total = 0;
                foreach($arr as $k=>$v){
                    
                    //$v['noidung'] = str_replace('"img":"','"img":"<img width=40 src=\'',$v['noidung']);
                    //$v['noidung'] = str_replace('"}', '\'>"}',$v['noidung']);
                    if ($v['Id']) {
                        $total += 1;
                ?>				
                    <tr id = <?php echo $v['Id']?>>
                        <!-- Continent -->
                        <td  type="continent" class = "data data--editable"><?php echo $v['Continent'] ?></td>
                        <!-- Country -->
                        <td type="country" class = "data data--editable"><?php echo $v['Country'] ?></td>
                        <!-- ANTT -->
                        <td type="name" class = "data data--editable"><?php echo $v['ANTT'] ?></td>
                        <!-- Tel -->
                        <td  class = "data data--editable"><?php echo $v['Tel'] ?></td>
                        <!-- Website -->
                        <td  class = "data data--editable"><?php echo $v['Website'] ?></td>
                        <!-- Email -->
                        <td  class = "data data--editable"><?php echo $v['Email'] ?></td>
                        <!-- Address -->
                        <td  class = "data data--editable"><?php echo $v['Address'] ?></td>
                        <!-- Location -->
                        <td type="location" class = "data data--editable"><?php echo $v['Location'] ?></td>
                        <td>
                            <button class="save">Save</button>
                            <button class="edit" enabled>Edit</button>
                            <button class="cancel">Cancel</button>
                            <button class="delete">Delete</button>
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

    $('#tong_sp').html($('#total_sp').html());	
    p = $('table').html()
        
    p = p.replaceAll(':&quot;/','"img":"<img width=40 src=\'')
    p = p.replaceAll('"}', '\'>"}');
    // Add 
    $('.add').on('click', function() {
        let tableBody = $('.table').children('tbody');
        <?php 
          $total += 1;
          $last_id += 1;
        ?>
        let rowHtml = `
            <tr id= ${<?php echo $last_id; ?>}>
                <td type="continent" class = "data data--editable"></td>
                <td type="country" class = "data data--editable"></td>
                <td type="name" class = "data data--editable"></td>
                <td class = "data data--editable"></td>
                <td class = "data data--editable"></td>
                <td class = "data data--editable"></td>
                <td class = "data data--editable"></td>
                <td type="location" class = "data data--editable"></td>
                <td>
                    <button class="save">Save</button>
                    <button class="edit" enabled>Edit</button>
                    <button class="cancel">Cancel</button>
                    <button class="delete">Delete</button>
                </td>
            </tr>
        `;
        
        
        //Update in database
        let col_names = `Continent,Country,ANTT,Tel,Website,Email,Address,Location`;
        let col_vals = ` , , , , , , , `;
        tableBody.append(rowHtml);
        $.ajax({											
                url: '/admin/insertRow.php',
                type: 'get',				
                data: {					
                    table		:'<?php echo $table_name ; ?>',					
                    col_name	: col_names,
                    col_val    : col_vals
                },
                success: function(response){              
                  $('#tong_sp').text(<?php echo number_format( $total,0,",","."); ?>);	 
                },
            });
         $('.edit:last').click(); // Trigger click event on adding action   
    })
    // Edit
    $('.table').on('click', '.edit', function() {  
        $(this).parent().siblings('td.data--editable').each(function() {  
            var content = $(this).text();  
            if (content == '') content = ' ';
            var rst_value = content;
            var type = $(this).attr('type');
            $(this).html('<input default= "' + rst_value +'" name ="' + type + '" value="' + content + '" />');  
        });  
        $(this).siblings('.save').show();  
        $(this).siblings('.delete').hide();  
        $(this).siblings('.cancel').show();  
        $('.edit').attr('disabled', true);
        $('.add').attr('disabled', true);
        $(this).hide();  
    });  
    // Save
    $('.table').on('click', '.save', function() {  
        let rowId = $(this).closest('tr').attr('id');
        let continentVal = $.trim($('input[name="continent"]').val());
        let countryVal = $.trim($('input[name="country"]').val());
        let nameVal = $.trim($('input[name="name"]').val());
        let locationVal = $.trim($('input[name="location"]').val());
        if (!continentVal || !countryVal || !nameVal || !locationVal){
            alert("Missing information required!");
            return 0;
        }
        else if (confirm("Are you sure?")){
          let colVals = '';
            $('input').each(function() {  
                var content = $(this).val(); 
                colVals += `${content}|`;
                $(this).html(content);  
                $(this).contents().unwrap();  
            });
            $(this).siblings('.edit').show();  
            $(this).siblings('.delete').show();  
            $(this).siblings('.cancel').hide();  
            $('.edit').prop('disabled', false);
            $('.add').attr('disabled', false);
            $(this).hide(); 
            //Update in database
            let colNames = `Continent|Country|ANTT|Tel|Website|Email|Address|Location`
            // Update value
            $.ajax({											
                url: '/admin/updateRow.php',
                type: 'get',				
                data: {					
                    table		:'<?php echo $table_name ; ?>',					
                    col_name	: colNames, //
                    col_val     : colVals,
                    col_id     : 'Id', 
                    row_id      : rowId,  
                },
                success: function(response){
                    alert("Saved sucessfully!");
                },
            });
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
        $(this).siblings('.delete').show();  
        $('.edit').prop('disabled', false);
        $('.add').attr('disabled', false);
        $(this).hide();  
    });  
    // Delete
    $(document).on('click', '.delete', function() {  
      if (confirm("Are you sure?")){
        <?php $total -= 1;?>
        $(this).parents('tr').remove();  
        let rowId = $(this).closest('tr').attr('id');
        // Delete row
         $.ajax({											
              url: '/admin/removeRow.php',
              type: 'get',				
              data: {			
                table		:'<?php echo $table_name ; ?>',	
                col_id  		: 'Id',
                row_id      : rowId,  
              },
              success: function(response){
                  $('#tong_sp').text(<?php echo number_format( $total,0,",","."); ?>);	 
                  alert("Deleted sucessfully!");

              },
          });
        }
});  
    
   
        
   
</script>

