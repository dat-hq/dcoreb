<?php 
ob_start();
  require_once 'init.php';
  require_once 'functions.php';
?>
<?php include 'header.php'; ?>
<h1>Đăng nhập</h1>
<?php if (isset($_GET['code'])): ?>
<?php
  $code = $_GET['code'];
  $success = false;

  $user = findUserByEmail($email);

  if ($user && $user['status'] ==1 && password_verify($password, $user['password'])) 
  {
    $success = true;
    $_SESSION['userId'] = $user['id'];
  }
?>
<?php if ($success): ?>
<?php header('Location: index.php'); ?>
<?php else: ?>
<div class="alert alert-danger" role="alert">
  Đăng nhập thất bại
</div>
<?php endif; ?>
<?php else: ?>
<form method="GET">
  <div class="form-group">
    <label for="code">Mã kích hoạt </label>
    <input type="text" class="form-control" id="code" name="code" placeholder="Mã kích hoạt">
  </div>
  <button type="submit" class="btn btn-primary">Kích hoạt tài khoản</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>
