<?php
class classData {

    protected $connection;
	protected $query;
	public $query_count = 0;
	
	public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = '', $charset = 'utf8') {
		$this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($this->connection->connect_error) {
			die('Lỗi kết nối MySQL - ' . $this->connection->connect_error);
		}
		$this->connection->set_charset($charset);
	}
	
    public function query($query, $hide='') {
		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
           	if ($this->query->errno) {
				die('check your params - ' . $this->query->error . ' - ' . $query);
           	}
			$this->query_count++;
        } else {
            die('check your syntax - ' . $this->connection->error . ' - ' . $query);
        }
		if($hide !='') echo $query;
		return $this;
    }

	public function fetchAll() {
	    $params = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
		return $result;
	}

	public function fetchArray() {
	    $params = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
		return $result;
	}
	
	
	public function insert($table,$arr){		
		$s1 = implode(',',array_keys($arr));
		
		$s2 = implode("','" , array_values($arr)) ;
				
		$sql="INSERT INTO $table ($s1) VALUES ('$s2')";
		
		//echo $sql;
		$this->query($sql);
		
		return $sql;
	}
	
	public function update_value($table,$fieldName,$value,$where,$chitiet=0){		
		$value = str_replace("'","’",$value);
		if($chitiet==0)
			if($fieldName=='view') $sql="UPDATE " . $table . " SET view='". $value ."', chitiet=0 ". $where;
			else $sql="UPDATE " . $table . " SET " . $fieldName . "='". $value . "' ". $where;
		else
			$sql="UPDATE " . $table . " SET " . $fieldName . "='". $value . "', chitiet='1'". $where;
		
		$this->query($sql);
	}
	public function update($table,$fieldName,$value,$where_col, $where_val){		
		$value = str_replace("'","’",$value);
		$sql="UPDATE " . $table . " SET " . $fieldName . "='". $value ."' WHERE ". $where_col . "='" . $where_val ."'";
		$this->query($sql);
	}

	public function getTable($tablename,$filter="",$limit=""){ //ham tra ve mang
		$arr = array();
		if($filter==""){
			$s=" ORDER BY id DESC";
		}else{
			$s=" WHERE ". $filter . " ORDER BY id DESC";
		}	
		$s="SELECT * FROM " . $tablename . $s . " ". $limit;
		
		//echo $s;
		return $this->query($s)->fetchAll();
	}
	
	public function getRow($tablename,$filter="",$limit="", $sap_xep="ORDER BY id"){ //ham tra ve mang
		
		if($filter==""){
			$s=$sap_xep;
		}else{
			$s="WHERE ". $filter . " " . $sap_xep;
		}	
		$sql	=	"SELECT * FROM " . $tablename . " ". $s . " " . $limit;
		
		return $this->query($sql)->fetchAll();
	}
	
	public function getMinRow($tablename,$filter="",$limit="", $sap_xep="ORDER BY id"){ //ham tra ve mang
		
		if($filter==""){
			$s=$sap_xep;
		}else{
			$s="WHERE ". $filter . " " . $sap_xep;
		}	
		$s="SELECT id,url,text,description,img_dai_dien,ngay_viet FROM " . $tablename . " ". $s . " " . $limit;
		
		return $this->query($s)->fetchAll();
	}
	
	public function getSanPham($tablename='',$filter='',$limit='',$orderBy ='ORDER BY sap_xep',$field=array(),$bai_viet = ''){ //sau này sẽ bỏ
			
		
		$arr = array();
		if($filter==""){
			$s=$orderBy; // ORDER BY id DESC
		}else{
			$s=" WHERE $filter $orderBy"; //GROUP BY $tablename.parent_id
		}	
		
		$addField ="";
		//echo $tablename;
		$selectField = "SELECT url,text,description,noi_dung,img_dai_dien,$bai_viet.id,parent_id,gia_0,giam_gia_0,manual_code,manual_link,view,chitiet,kinhdoanh,sap_xep,nav ";

		$i = 0;
		$temp = array();
		foreach($field as $k=>$v) {
			$temp[$i] = $k;
			$i++;
		}
		$temp = implode(",",$temp);
		$s= "$selectField ,$temp FROM $tablename INNER JOIN $bai_viet ON $bai_viet.id=$tablename.id $s $limit";		
		
		//echo $s;
		
		return $this->query($s)->fetchAll();
				
	}
	
	public function update_arr($table,$post){
		
		if(isset($post['noi_dung']) && $post['noi_dung']!=""){
						
			$doc = new DOMDocument();
			$doc->loadHTML($post['noi_dung']);		
			
			$doc->preserveWhiteSpace = false;		
			$tags_img = $doc->getElementsByTagName('img');		
			$images = array();		
			foreach($tags_img as $img){
				$images[] = $img->getAttribute('src');  
			}			
			if(isset($images[0])){
				$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
				$post['img_dai_dien']= str_replace($url,'',$images[0]);
			}
			
			$tags_youtobe = $doc->getElementsByTagName('iframe');		
			$src = array();		
			foreach($tags_youtobe as $iframe){
				$src[] = $iframe->getAttribute('src');  
			}			
			if(isset($src[0])){
				$urlArr = explode("/",$src[0]);
				//echo '<pre>';print_r($urlArr);echo '</pre>';
				if($urlArr[2] == 'www.youtube.com'){
				$urlArrNum = count($urlArr);
				$youtubeVideoId = $urlArr[$urlArrNum - 1];
				$post['img_dai_dien'] = 'https://img.youtube.com/vi/'.$youtubeVideoId.'/0.jpg';	
				
				}
			}		
			
			
			$post['noi_dung'] = str_replace('<p> </p>', '', $post['noi_dung']);
			$post['baiviet']='0';
			//$post['ngay_viet']=date('Y-m-d');
			
			$s = preg_replace("/<p.*?img-dai-dien.*?p>/i", '', $post['noi_dung']);
			$s = preg_replace('/\s+/', '', $s);
			
			if( $s!= '') $post['baiviet']='1';
			
		}
		
		
		$sql="UPDATE $table SET ";
		foreach($post as $k=>$v){			
			$v = str_replace("'","\'",$v) ;
			if($k != 'id' && $k != 'table'){
				//$v = str_replace("'","’",$v);
				$sql .= $k . "='" . $v . "',";
			}	
		}
		$id = $post['id'];
		$sql .= " WHERE id='$id'";
		
		$sql =str_replace(", WHERE"," WHERE",$sql);
		
		//echo $sql;
		
		$this->query($sql);
		
		return $sql;
	}

	public function dele($table,$col_id,$row_id){
		$sql="DELETE $table FROM $table WHERE $col_id=$row_id";
		//echo $sql;
		$this->query($sql);
	}
	
	
	public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	public function close() {
		return $this->connection->close();
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}
// ----- Implement for User management ---- //
	// Standalize user input
	public function std_user_input($str) {
		$str = htmlspecialchars($str);
		return mysqli_real_escape_string($this->connection, $str);
	}
	private function _gettype($var) {
	    if(is_string($var)) return 's';
	    if(is_float($var)) return 'd';
	    if(is_int($var)) return 'i';
	    return 'b';
	}
	
}

include_once dirname(dirname(__FILE__)) . '/config.php';
$data=new classData($dbhost, $dbuser, $dbpass, $dbname);

function convert_vi_to_en($str, $replace = array(), $delimiter = '-') {
	if(!empty($replace))
    {
        $str = str_replace((array) $replace, ' ', $str);
    }
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
	$str = preg_replace("/(đ|Đ)/", 'd', $str);

    $clean=$str;
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    return $clean;
}

/*
How To Use

Connect to a database:
include 'db.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'example';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

Fetch a record from a database:
$account = $db->query('SELECT * FROM accounts WHERE username = ? AND password = ?', 'test', 'test')->fetchArray();
echo $account['name'];
Or you could do:

$account = $db->query('SELECT * FROM accounts WHERE username = ? AND password = ?', array('test', 'test'))->fetchArray();
echo $account['name'];

Fetch multiple records from a database:
$accounts = $db->query('SELECT * FROM accounts')->fetchAll();

foreach ($accounts as $account) {
	echo $account['name'] . '<br>';
}

Checking the number of rows:
$accounts = $db->query('SELECT * FROM accounts');
echo $accounts->numRows();

Checking the affected number of rows:
$insert = $db->query('INSERT INTO accounts (username,password,email,name) VALUES (?,?,?,?)', 'test', 'test', 'test@gmail.com', 'Test');
echo $insert->affectedRows();

Close the database:
$db->close();

Checking the total number of queries:
echo $db->query_count;
*/

?>

