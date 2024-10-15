<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php"; // Need to edit here		
include_once "C:/xampp/htdocs/local/mailer/send-to-mail.php"; // Need to edit here
$email = "";
$name = "";
$response = array('code'=>0); //  Code : response with errorCode; 1: Login success; 2: OTP vertification; 3: Password reset;
    // Login action
    if (isset($_POST['login'])) {
        $email = $data->std_user_input($_POST['email']);
        $password = $data->std_user_input($_POST['password']);
        $phone = $email; // In case user login with Phone number
        $check_mail_sql = "SELECT * FROM thanhvien WHERE email = '$email' OR phone = '$phone'";
        $res = $data->query($check_mail_sql)->fetchAll();
        if (count($res) > 0) {
            $fetch_pass = $res[0]['password'];
            $fetch_name = $res[0]['name'];
            if (password_verify($password, $fetch_pass)) { 
                $_SESSION['email'] = $email;
                $status = $res[0]['status'];
                if($status=='verified'){
                    $_SESSION['email']=$email;
                    $_SESSION['password'] = $password;
                    $_SESSION['name'] = $fetch_name;
                    $response['code']=1;// Login success 
                    $response['name']=$fetch_name;
                }
                else {
                    $info = "It's look like you haven't still verify your email";
                    $_SESSION['info']=$info;
                    $response['code']=2; /// OTP vertification
                }
            } else {
                $response['login_err']="Incorrect email or password" ;
            }
        } else {
            $response['login_err'] = "It's look like you're not yet a member!" ;
        }
        echo json_encode($response);
    }
    // OTP check 
    if (isset($_POST['check'])) {
        $_SESSION['info'] = "";
        $otp_code = $data->std_user_input($_POST['otp']);
        $check_code_sql = "SELECT * FROM thanhvien WHERE code=$otp_code";
        $res = $data->query($check_code_sql)->fetchAll();
        if(count($res)>0) {
            $fetch_code = $res[0]['code'];
            $email = $res[0]['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE thanhvien SET code=$code, status = '$status' WHERE code=$fetch_code";
            $update_res = $data->query($update_otp);
            if($update_res) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $res[0]['name'];
                $response['code'] = 1;
                $response['name'] = $res[0]['name'];
            }
            else {
                $response['otp_err'] = "Failed while updating code!";
            }
        } else {
            $response['otp_err'] = "You've entered incorrect code!";
        }
        echo json_encode($response);
    }
    // Sigup
    if(isset($_POST['signup'])) {
        $name = $data->std_user_input($_POST['name']);
        $email = $data->std_user_input($_POST['email']);
        $phone = $data->std_user_input($_POST['sdt']);
        $password = $data->std_user_input($_POST['password']);
        $cpassword = $data->std_user_input($_POST['cpassword']);
        if($password != $cpassword) {
            $response['signup_err'] = "Confirm password not match";
        }
        // Validate password
        $check_mail_sql = "SELECT * FROM thanhvien WHERE email='$email'";
        $res = $data->query($check_mail_sql)->fetchAll();
        if(count($res)>0) {
            $response['signup_err'] = "Email that you've entered is already exist";

        }
        if(!(array_key_exists('signup_err', $response))) {
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data_sql = "INSERT INTO thanhvien (name, password, email, phone, code, status)
                                values('$name', '$encpass', '$email', '$phone', '$code', '$status') ";
            $data_check = $data->query($insert_data_sql);
            if($data_check) {
                $subject = 'Xác thực tài khoản đăng ký';
                $message = "
                <img style='max-width: 200px;' src='https://tifatech.vn/user-upload/imgs/tft-logo.png'/>
                <hr>
                <span>Xin chào $name </span>

                <br><span>Mã xác thực cho tài khoản của bạn là<strong style='font-size: 20px;'> $code</strong></span>
                <p> Vui lòng nhập mã bên trên để hoàn tất quá trình đăng ký </p> 
                <p>Trân trọng,</p>
                <p><strong>TIFATECH CO., LTD</strong></p>" ;
                $MailSent = sendMail($email, $name, $subject, $message);
                if($MailSent == 1) {
                    $info = "We've sent a verification code to $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $response['code'] = 1; // OTP check
                    $response['signup_info'] = $info;
                } else {
                    $response['signup_err'] = "Failed whhile sending code";
                }
            } else {
                $response['signup_err'] = "Failed while inserting data into database!";
            }
           
        }
        echo json_encode($response);
    }

     //if user click continue button in forgot password form
     if(isset($_POST['check-email'])){
        $email = $data->std_user_input($_POST['email']);
        $check_email_sql = "SELECT * FROM thanhvien WHERE email='$email'";
        $res = $data->query($check_email_sql)->fetchAll();
        if(count($res) > 0){
            $code = rand(999999, 111111);
            $insert_code_sql = "UPDATE thanhvien SET code = $code WHERE email = '$email'";
            $run_query =  $data->query($insert_code_sql);
            if($run_query){
                $name = $res[0]['name'];
                $subject = 'Cập nhật mật khẩu tài khoản';
                $message = "
                <img style='max-width: 200px;' src='https://tifatech.vn/user-upload/imgs/tft-logo.png'/>
                <hr>
                <span>Xin chào $name </span>

                <br><span>Mã khôi phục mật khẩu của bạn là<strong style='font-size: 20px;'> $code</strong></span>
                <p> Vui lòng nhập mã bên trên để hoàn tất quá trình xác thực </p> 
                <p>Trân trọng,</p>
                <p><strong>TIFATECH CO., LTD</strong></p>" ;
                $MailSent = sendMail($email, $name, $subject, $message);
                if($MailSent == 1) {
                    $info = "We've sent a verification code to $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $response['code'] = 1; // Mail sent successfully
                    
                } else {
                    $response['mcheck_err'] = "Failed while sending code";
                }
            }else{
                $response['mcheck_err'] = "Something went wrong!";
            }
        }else{
            $response['mcheck_err'] = "This email address does not exist!";
        }
        echo json_encode($response);
    }
    // Reset Pasword OTP submit
    if(isset($_POST['check-reset-otp'])) {
        $_SESSION['info'] = "";
        $otp_code = $data->std_user_input($_POST['otp']);
        $check_code_sql = "SELECT * FROM thanhvien WHERE code = $otp_code";
        $res = $data->query($check_code_sql)->fetchAll();
        if(count($res)>0) {
            $email = $res[0]['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site data";
            $_SESSION['info'] = $info;
            $response['code']=1;
        } else {
            $response['reset_otp_err'] = "You've enterred incorrect code";
        }
        echo json_encode($response);
    }
    // Password change 
    if(isset($_POST['change-password'])) {
        $_SESSION['info'] = "";
        $password = $data->std_user_input($_POST['password']);
        $code = 0;
        $email = $_SESSION['email'];
        $encpass= password_hash($password, PASSWORD_BCRYPT); 
        $update_pass_sql = "UPDATE thanhvien SET code=$code, password ='$encpass' WHERE email='$email'";
        $run_query = $data->query($update_pass_sql);
        if($run_query) {
            $info = "Your password has been changed";
            $_SESSION['info'] = $info;
            $response['code'] = 1;
            $response['info'] = $info;
        } else {
            $reponse['pwdchange_err'] = "Failed to change your password";
        }
        echo json_encode($response);
    }
?>