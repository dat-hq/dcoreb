<?php
    ob_start();
require_once 'init.php';
if(!$currentUser)
{
    header('Location:index.php');
    exit();
}

?>

<?php include 'header.php'; ?>
<h1>Đổi Thông Tin Cá Nhân</h1>
<?php if(isset($_POST['displayName'])): ?>
<?php 
$displayName = $_POST['displayName'];
$phoneNumber=$_POST['phoneNumber'];
$success = false;
/*if($currentUser)
{
$stmt = $db->prepare("UPDATE DB SET displayName = ?where id = ?");
var_dump($stmt->execute(array($displayName, $currentUser['id'])));
$success = true;
}*/
if($displayName !='')
{
    updateUserProfile($currentUser['id'],$displayName);
    updateUserPhoneNum($currentUser['id'],$phoneNumber);
    $success=true;
}
/*elseif($currentUser)
{
$stmt = $db->prepare("UPDATE DB SET phoneNumber = ?where id = ?");
var_dump($stmt->execute(array($phoneNumber, $currentUser['id'])));
$success = true;
}*/
?>
<?php if ($success): ?>
<?php header('Location: index.php'); ?>
<?php else : ?>
<div class ="alert alert-danger" role="alert">
 Thất Bại
</div>
<?php endif; ?>
<?php else : ?>
    <form action="change-profile.php" method = "POST">
    <div class = "form-group">
   <h2> <label for="displayName">Tên hiển thị</label> </h2>
    <input type="text" class = "form-control" id = "displayName" name = "displayName" placeholder = "Tên mới">
    </div>
    <div class = "form-group">
   <h2> <label for="phoneNumber">Số điện thoại</label> </h2>
    <input type="number" class = "form-control" id = "phoneNumber" name = "phoneNumber" placeholder = "Số điện thoại mới">
    </div>
    <p><button type = "submit" class = "btn btn-primary">Đổi Thông Tin</button> </p>

    </form>
    
<?php endif; ?>
<?php include 'footer.php'; ?>
