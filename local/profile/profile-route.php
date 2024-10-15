<?php if (!$is_login) {
    // For testing only
    $url = strval("https://localhost:8081/local/layout/index.php");
    $cr_url  = strval("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    //
    if ($url != $cr_url) {
        echo "<script> location.href='/local/layout/index.php' </script>"; // Use this only on live servers
    }
} else {
    $query= '';
    
    if (isset($_GET['q'])) $query = $_GET['q'];
     switch($query) {
        case 'thong-tin-ca-nhan':
            include_once('../profile/profile.php');
            break;
        case 'lich-su-sua-chua':
            include_once('../profile/profile-repair-dt.php');
            break;
        case 'lich-su-mua-hang':
            include_once('../profile/profile-buy-dt.php');
            break;
        case 'chinh-sua-thong-tin':
            include_once('../profile/profile-edit.php');
            break;
        case 'doi-mat-khau':
            include_once('../profile/profile-edit-pass.php');
            break;
        default: break;
      }  
}
?>