<?php

require_once 'init.php';
if(!$currentUser)
{
    header('Location:index.php');
    exit();
}

?>

<?php include 'header.php'; ?>
<h1>Đổi Mật Khẩu</h1>
<?php if(isset($_POST['currentpassword']) && isset($_POST['password'])): ?>
<?php 
$currentpassword = $_POST['currentpassword'];
$password = $_POST['password'];
$hashpassword = password_hash($password,PASSWORD_DEFAULT);
$success = false;

if(password_verify($currentpassword,$currentUser['password']))
{
$stmt = $db->prepare("UPDATE users SET password = ? where id = ?");
var_dump($stmt->execute(array($hashpassword, $currentUser['id'])));
$success = true;

}


?>
<?php if ($success): ?>
<?php header('Location: index.php'); ?>
<?php else : ?>
<div class ="alert alert-danger" role="alert">
 Thất Bại
</div>
<?php endif; ?>
<?php else : ?>
    <form action="change-password.php" method = "POST">

    <div class = "form-group">
   <h2> <label for="currentpassword">Mật Khẩu Hiện Tại</label> </h2>
    <input type="currentpassword" class = "form-control" id = "currentpassword" name = "currentpassword" placeholder = "Mật Khẩu Hiện Tại">
    </div>
    <div class = "form-group">
   <h2> <label for="password">Mật Khẩu Mới</label> </h2>
    <input type="password" class = "form-control" id = "password" name = "password" placeholder = "Mật Khẩu Mới">
    </div>

    
    <p><button type = "submit" class = "btn btn-primary">Đổi Mật Khẩu</button> </p>

    </form>
    
<?php endif; ?>
<?php include 'footer.php'; ?>