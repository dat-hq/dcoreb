<?php
    require_once 'init.php';
?>
    <?php include 'header.php'; ?>
    <h1 align="center">QUÊN MẬT KHẨU</h1>
    <?php if(isset($_GET['email'])): ?>
    <?php
        $email = $_GET['email'];
        $success = false;

        $user = findUserByEmail($email);
        
        if ($user && $user['status'] == 1)
        {
            $success = LostPassword($user['id'], $user['displayName'], $user['email'], $user['password']);
        }
    ?>
    <?php if($success): ?>
        <div class="alert alert-success" role="alert">
            Vui lòng kiểm tra email để lấy mật khẩu mới
        </div> 
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Không tìm thấy email của bạn
        </div>
    <?php endif; ?>
    <?php else: ?>
    <form method="GET">
        <div class ="form-group">
            <label for="email">Email</label>
            <input type="email" class ="form-control" id ="email" name ="email" placeholder="Email">
        </div>
        <button type = "submit" class = "btn btn-primary">Lấy mật khẩu mới</button>
    </form>
    <?php endif; ?>