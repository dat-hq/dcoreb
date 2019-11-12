<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Dere's website</title>

  </head>
<body>
  <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Lập trình Web 1</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item  <?php echo $page == 'index' ? 'active' :'' ?> ">
        <a class="nav-link" href="index.php">Home </a>
     </li>

     <li class="nav-item  <?php echo $page == 'contact' ? 'active' :'' ?> ">
        <a class="nav-link" href="contact.php" >Liên Hệ </a>
     </li>

      <?php if(!$currentUser):?>
     <li class="nav-item" <?php echo $page == 'register' ? 'active' :'' ?>>
        <a class="nav-link" href="register.php">Đăng Ký</a>
      </li>
      <li class="nav-item" <?php echo $page == 'login' ? 'active' :'' ?>>
        <a class="nav-link" href="login.php">Đăng Nhập</a>
      </li>
      <?php endif;?>
      <?php if($currentUser):?>
      <li class="nav-item" <?php echo $page == 'change-password' ? 'active' :'' ?>>
        <a class="nav-link" href="change-password.php">Đổi mật khẩu    </a>
      <li class="nav-item" <?php echo $page == 'logout' ? 'active' :'' ?>>
        <a class="nav-link" href="logout.php">Đăng Xuất <?php echo $currentUser ? '(' . $currentUser['displayName'] . ')' : '' ?> </a>
      <?php endif;?>
      <?php if($currentUser):?>
      </li>
     <li class="nav-item" <?php echo $page == 'forgot-password' ? 'active' :'' ?>>
        <a class="nav-link" href="forgot-password.php">Quên mật khẩu</a>
      </li>
      <?php endif;?>
  </div>
</nav>