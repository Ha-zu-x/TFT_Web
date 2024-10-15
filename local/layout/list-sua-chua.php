<?php 
include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php";
// list-repair.php
    // $svrname = "localhost:4306";
    // $username ="root";
    // $password = "";
    // $dbname = "test";
    // $conn = mysqli_connect($svrname, $username, $password, $dbname); 
    // if (!$conn) {
    //     die("Connection failed: ". mysqli_connect_error());
    // }
    // $sql = "SELECT * FROM repair";
    // $result = mysqli_query($conn, $sql);
    // $num_rows = mysqli_num_rows($result);
    $table_name = "repair";
    $field = "All"; // Get from query parameters (Default: All)
    $search_term = ""; // Get from query parameters (search_term: "")
    if (isset($_GET['field']) && ($_GET['field']!= "All")) $field=$field_repair[$_GET['field']];
    if (isset($_GET['key'])) $search_term=$_GET['key'];
    $sql = "SELECT * FROM ". $table_name; // Default query
    if ($field == "All") {
        if (!empty($search_term)) {
            $sql = "SELECT * FROM $table_name WHERE ". 
            "Ngay_nhan LIKE " . "'%". $search_term . "%'" . 
            " OR Ngay_hoan_thanh LIKE " . "'%". $search_term . "%'" . 
            "OR Ma_KH LIKE " . "'%". $search_term . "%'" . 
            "OR Model LIKE " . "'%". $search_term . "%'" . 
            "OR Ma_quan_ly LIKE " . "'%". $search_term . "%'" . 
            "OR Noi_dung_loi LIKE " . "'%". $search_term . "%'" . 
            "OR Ghi_chu LIKE " . "'%". $search_term . "%'" . 
            "ORDER BY Id DESC";
        }
    }
    else if (!empty($search_term)) {
        $sql = "SELECT * FROM " . $table_name. " WHERE ". $field . " LIKE " . "'%" . $search_term ."%'" . " ORDER BY Id DESC";
    }
    $arr_repair_list = $data -> query($sql) -> fetchAll();
    $canonical = "local/layout/index.php"; // Edit to the respective file directory
    //  Get page number by query in request
    if (isset($_GET['value'])) {
        $id = $_GET['value'];
        $_GET['item2'] = $_GET['value']; // Edit to 2 before publishing
    }
    $recordPerPage = 20;
    $n = 0;
    $pages=0;
    $pageNow=1;
    if (isset($_GET['item2']) && $_GET['item2']>=1) {
        $pageNow = $_GET["item2"];
    }
    
    $n = count($arr_repair_list);
    $surplus=$n%$recordPerPage;
    ($pageNow==1)?($begin = 1) : ($begin=($pageNow-1)*$recordPerPage + 1);
    if ($surplus==0) {
        $pages = (int)($n/$recordPerPage);
        $end = $pageNow*$recordPerPage;
    }
    else {
        $pages = (int)($n/$recordPerPage) + 1;
        if ($pageNow==$pages) {
            $end=($pageNow-1)*$recordPerPage + $surplus;
        }
        else $end = $pageNow*$recordPerPage;

    }
    if ($n>$recordPerPage) {
        $NextPage = $pageNow + 1;
        $PrevPage = $pageNow - 1;
        if ($pageNow == 1) $PrevPage = 1;
        if ($pageNow == $pages) $NextPage = $pageNow;
    }
    ?>
    <div class="container-data">

        <div class="filter-input col-md-6 col-sm-12">
            <div class="field-list">
                <div class="custom-select">
                    <button
                        class="select-button form-control"
                        role="combobox"
                        aria-labelledby="select button"
                        aria-haspopup="listbox"
                        aria-expanded="false"
                        aria-controls="select-dropdown">
                        <span class="selected-value"><?php if (isset($_GET['field'])) echo $_GET['field']; else echo $field; ?></span>
                        <span class="arrow"></span>
                    </button>
                    <ul class="select-dropdown" role="listbox" id="select-dropdown">
                        <li role="option">
                            <input type="radio" />
                            <label>All</label>
                        </li>
                        <li role="option">
                            <input type="radio" />
                            <label>Ngày nhận</label>
                        </li>
                        <li role="option">
                            <input type="radio" />
                            <label>Ngày HT</label>
                        </li>
                        <li role="option">
                            <input type="radio" />
                            <label>Mã KH</label>
                        </li>
                        <li role="option">
                            <input type="radio" />
                            <label>Model</label>
                        </li>
                        <li role="option">
                            <input type="radio" />
                            <label>Mã quản lý</label>
                        </li>
                        <li role="option">
                            <input type="radio" />
                            <label>Nội dung lỗi</label>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="text" placeholder="Từ khóa" class="form-control filter-key" data-trigger="focus">
            <button class="filter-search">
                <span class="glyphicon glyphicon-search"></span>
            </button>
            
            
        </div>   
        <?php if (!empty($search_term)) {
            ?>
        <span class="filter-notify" >Có <strong> <?php echo $n; ?> </strong> kết quả tìm kiếm với từ khóa <strong> <?php echo $search_term;?> </strong></span>
        <?php } 
        if ($n > 0) { ?>
        <table class="repair-list">
            <tr>
                <th>Id</th>
                <th>Ngày nhận</th>
                <th>Ngày HT</th>
                <th>Mã KH</th>
                <th>Model</th>
                <th>Mã quản lý</th>
                <th>Nội dung lỗi</th>
                <th>Link video</th>
                <th>Ghi chú</th>
            </tr>
            <?php 
                for ($i=$begin-1; $i<$end;$i++) {
                    ?>
                    <tr>
                        <td> <?php echo $arr_repair_list[$i]["Id"];?></td>
                        <td> <?php echo $arr_repair_list[$i]["Ngay_nhan"];?></td>
                        <td> <?php echo $arr_repair_list[$i]["Ngay_hoan_thanh"];?></td>
                        <td> <?php echo $arr_repair_list[$i]["Ma_KH"];?></td>
                        <td title="<?php echo $arr_repair_list[$i]["Model"];?>" style="max-width: 100px;"> <?php echo $arr_repair_list[$i]["Model"];?></td>
                        <td> <?php echo $arr_repair_list[$i]["Ma_quan_ly"];?></td>
                        <td title="<?php echo $arr_repair_list[$i]["Noi_dung_loi"];?>"style="max-width: 120px;"> <?php echo $arr_repair_list[$i]["Noi_dung_loi"];?></td>
                        <td title="<?php echo $arr_repair_list[$i]["Link_video"];?>" style="max-width: 120px;"> <a href="<?php echo $arr_repair_list[$i]["Link_video"];?>" target="_blank"><?php echo $arr_repair_list[$i]["Link_video"];?></a></td>
                        <td> <?php echo $arr_repair_list[$i]["Ghi_chu"];?></td>
                    </tr>
                    <?php 
                }
            ?>
        </table>
        <?php 
            if ($pages > 1) { 
                $lim_page_btn = 6;
                $is_dot_begin = 0;
                $is_dot_end  = 0;
                $nextPage = 0;
                $prevPage = 0;
                if ($pageNow < $pages) $nextPage = $pageNow+1;
                if ($pageNow > 1) $prevPage = $pageNow-1;
                ?>    
            <nav aria-label="pagination-area" class="repair-pager">
               <ul class="pagination">
                    <li class="page-item <?php if ($pageNow==1) echo 'disabled';?>">
                        <a href="<?php if ($pageNow > 1) echo ($pageNow - 1);?>" class="page-link" aria-label="Previous" tabindex="-1" key='<?php echo $search_term;?>'>
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for ($i=1; $i<=$pages;$i++) {       
                        if ($i<3 || ($i>=($pageNow - 1) && $i<=($pageNow+1)) || ($i > $pages-2)) {
                            ?> <li class='page-item <?php if ($i==$pageNow) echo'active'; ?>'><a class='page-link' key='<?php echo $search_term;?>' href='<?php echo $i;?>'><?php echo $i;?></a></li>
                            <?php
                        }                 
                        else if (($pageNow - $i >= 2) && ($i<$pageNow)&& $is_dot_begin==0)  {
                            $is_dot_begin = 1;
                            echo "<li class='page-item'><a class='page-link' key='$search_term' href='$prevPage'>...</a></li>";
                        }
                        else if (($pages - $i >= 2) && ($is_dot_end==0) && ($i > $pageNow)) {
                            $is_dot_end = 1;
                            echo "<li class='page-item'><a class='page-link' key='$search_term' href='$nextPage'>...</a></li>";
                        } 
                    }?>
                    <li class="page-item <?php if ($pageNow==$pages) echo 'disabled';?>">
                        <a class="page-link" href="<?php echo $nextPage; ?>" key='<?php echo $search_term;?>' aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
               </ul>
            </nav>
            <script src="/local/js/page-change.js?v=1"></script>
           <?php } ?>
    </div>
    <?php  } ?>
    
    
    
<script>
//  -------- Custom select options ------------------ //
const customSelect = document.querySelector(".custom-select");
const selectBtn = document.querySelector(".select-button");

const selectedValue = document.querySelector(".selected-value");
const optionsList = document.querySelectorAll(".select-dropdown li");

selectBtn.addEventListener("click", () => {
    customSelect.classList.toggle("active");
    selectBtn.setAttribute(
        "aria-expanded",
        selectBtn.getAttribute("aria-expanded") === "true" ? "false" : "true"
    );
});

optionsList.forEach((option) => {
    function handler(e) {
        // Click Events
        if (e.type === "click" && e.clientX !== 0 && e.clientY !== 0) {
            selectedValue.textContent = this.children[1].textContent;
            customSelect.classList.remove("active");
        }
        // Key Events
        if (e.key === "Enter") {
            selectedValue.textContent = this.textContent;
            customSelect.classList.remove("active");
        }
    }
    option.addEventListener("keyup", handler);
    option.addEventListener("click", handler);
});
//  Filter search actions 
let FilterBtn = $('.filter-search');
FilterBtn.click(function() {
    $.ajax({
        url: "/local/layout/list-sua-chua.php?field=" + selectedValue.textContent + "&key=" + $('.filter-key').val(), // Need to edit here before public (remove local)
        beforeSend: function() {
            // $("#container").remove();
            $('.container-data').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
        },
        success: function(msg) {
            $(".container-data").html(msg);
            // $("html, body").animate({ scrollTop: $("#container").offset().top - 100 }, 700);
        },
    });
})
$(".filter-key").keypress(function(e) {
    let key = e.which;
    if(key == 13) {
        FilterBtn.click();
        return false;
    }
})
$('.repair-list td').dblclick(function() {
    $(this).css({"overflow" : "auto", "white-space": "normal", "word-wrap": "break-word"});
})
</script>
