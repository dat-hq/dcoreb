<?php
require_once('./vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function detectPage() 
{
  $uri = $_SERVER['REQUEST_URI'];
  $parts = explode('/', $uri);
  $fileName = $parts[2];
  $parts = explode('.', $fileName);
  $page = $parts[0];
  return $page;
}

function findUserByEmail($email) 
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute(array($email));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function findUserById($id) 
{
  global $db;
  $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute(array($id));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUserPassword($id, $password) 
{
  global $db;
  $hashPassword = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
  return $stmt->execute(array($hashPassword, $id));
}

/*function createUser($displayName, $email, $password) 
 {
   global $db;
   $hashPassword = password_hash($password, PASSWORD_DEFAULT);
   $stmt = $db->prepare("INSERT INTO users (displayName, email, password) VALUES (?, ?, ?)");
   $stmt->execute(array($displayName, $email, $hashPassword));
   return $db->lastInsertId();
 }*/
function createUser($displayName, $email, $password)
    {
        global $db, $BASE_URL;
        $code = RandomString(6);
        $hassPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users(displayName, email, password, status, code) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($displayName, $email, $hassPassword, 0, $code));
        $id = $db->lastInsertId();
        sendEmail($email, $displayName, 'Kích hoạt tài khoản', "Mã kích hoạt của bạn là $code.
        Vui lòng vào đường link này để nhập mã <a href =\"http://localhost/W56/activate.php?code=$code\">http://localhost/W56/activate.php?code=$code</a>");
        return $id;
    }
    function RandomString($length = 10) 
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function sendEmail($to, $name, $subject, $content)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hoquocdat1310@gmail.com';                     // SMTP username
        $mail->Password   = 'HQD131099';                              // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('hoquocdat1310@gmail.com', 'LT Web 1 - 2019');
        $mail->addAddress($to, $name);     // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';               
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->AltBody = $content;

        $mail->send();
        return true;
    }
    function activateUser($code)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM users WHERE code = ? AND status = ?");
        $stmt->execute(array($code, 0));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['code'] == $code)
        {
            $stmt = $db->prepare("UPDATE users SET code = ?, status = ? WHERE id = ?");
            $stmt->execute(array('', 1, $user['id']));
            return true;
        }
        return false;
    }
    function LostPassword($id, $displayName, $email, $password)
    {
        global $db, $BASE_URL;
        $code = RandomString(9);
        $hassCode = password_hash($code, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");               
        sendEmail($email, $displayName, 'Lấy mật khẩu mới', "Mật khẩu mới là $code.
        Vui lòng vào đường link này để đăng nhập <a href =\"http://localhost/W56/login.php\">http://localhost/W56/login.php</a>");
        return $stmt->execute(array($hassCode, $id));
    }
