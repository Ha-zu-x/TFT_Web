<?php
include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php"; // Need to edit here		
session_start();
$response = array('code'=>0);
function compressImage($source, $destination, $quality) {
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];
    switch ($mime) {
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png': 
            $image = imagecreatefrompng($source);
            break;
        default: $image = imagecreatefrompng($source);
    }
    imagejpeg($image, $destination, $quality);
    return $destination;
}
 // Profile edit action 
 if (isset($_POST['profile-edit'])) {
    $semail = $_SESSION['email'];
    $sphone = $semail;
    // Image upload
    if (!empty($_FILES['image']['name'])) {
        $imgUpOk = 1;
        $folder = "../user-upload/imgs/";
        $img_name= basename($_FILES['image']['name']);
        $target_file = $folder . $img_name;
        if(!file_exists($folder)) {
            $response['update_err'] = "Folder does not exist";
            // mkdir($folder, 0777, true);
            $imgUpOk = 0;
        } 
        if($_FILES['image']['size'] > 500000) {
            $response['update_err'] = "Your image size must be smaller than 500kB";
            $imgUpOk = 0;
        }
        $allowed = ['image/jpeg', 'image/png'];
        if(!in_array($_FILES['image']['type'], $allowed)) {
            $imgUpOk = 0;
            $response['update_err'] = "The chosen file is invalid!";
        } 
        if ($imgUpOk==1) {
            $tmpImage = $_FILES['image']['tmp_name'];
            $compressedImage = compressImage($tmpImage, $target_file, 65); // Image is compressed and uploaded
            // Save directory to Database
            $img_sql = "UPDATE thanhvien SET image='$img_name' WHERE email = '$semail' OR phone = '$sphone'";
            $data->query($img_sql);
        } 
    }
    if (!isset($response['update_err'])) { 
        $name = $data->std_user_input($_POST['name']);
        $phone = $data->std_user_input($_POST['sdt']);
        $address = $data->std_user_input($_POST['address']);
        $gender = $data->std_user_input($_POST['gender']);
        $birthday = $data->std_user_input($_POST['birthday']); 
        // Update to DB
        $update_sql = "UPDATE thanhvien SET name='$name', phone='$phone', address='$address', gender='$gender', birthday='$birthday' WHERE email = '$semail' OR phone = '$sphone'";
        $update_res = $data->query($update_sql);
        if($update_res) {
            $response['code'] = 1; 
            $response['info'] = $name;
        } else {
            $response['update_err'] = "Failed to update to the database";
        }
    }
    echo json_encode($response);
 } 
 if(isset($_POST['profile-edit-pass'])) {
    $password = $data->std_user_input($_POST['password']);
    $semail = $_SESSION['email'];
    $sphone = $semail;
    $check_mail_sql = "SELECT * FROM thanhvien WHERE email = '$semail' OR phone = '$sphone'";
    $res = $data->query($check_mail_sql)->fetchAll();
    $fetch_pass = $res[0]['password'];
    if(password_verify($password, $fetch_pass)) {
        $npass = $data->std_user_input($_POST['npassword']);
        $encnpass = password_hash($npass, PASSWORD_BCRYPT);
        $update_sql = "UPDATE thanhvien SET password = '$encnpass' WHERE email = '$semail' OR phone = '$sphone'";
        $update_res = $data->query($update_sql);
        if($update_res) {
            $response['code'] = 1;
            $response['info'] = "Your password has been updated";
        } else {
            $response['pwd_edit_err'] = "Failed to update new password";}
    } else {
        $response['pwd_edit_err'] ="Your current password is incorrect";
    }
    echo json_encode($response);
 }
  // Edit 
?>