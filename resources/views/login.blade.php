<?php
session_start();

if (isset($_SESSION['user_object'])) {
    header('Location: dashboard.php');
    exit();
}

$flash_message = '';
if (isset($_SESSION['flash_msg'])) {
    $flash_message = $_SESSION['flash_msg'];
    unset($_SESSION['flash_msg']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <style>
    body {
      font-family: Arial, sans-serif; background: #f4f4f9; display: flex;
      justify-content: center; align-items: center; height: 100vh; margin: 0;
    }
    .login-container {
      background: #fff; padding: 30px; border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 320px; text-align: center;
    }
    .login-container h2 { margin-bottom: 20px; color: #333; }
    .form-group { margin-bottom: 15px; text-align: left; }
    .form-group label { display: block; margin-bottom: 5px; color: #555; font-size: 14px; }
    .form-group input {
      width: 100%; padding: 10px; border: 1px solid #ddd;
      border-radius: 5px; box-sizing: border-box; font-size: 14px;
    }
    .btn {
      background: #007bff; color: white; border: none; padding: 12px;
      width: 100%; border-radius: 5px; cursor: pointer; font-size: 16px;
    }
    .btn:hover { background: #0056b3; }
    .error-message {
      color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb;
      padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Selamat Datang</h2>
    <p style="color:#666; margin-top:-15px; margin-bottom:20px;">Silakan masuk ke akun Anda</p>

    <?php
    if (!empty($flash_message)) {
        echo "<div class='error-message'>" . htmlspecialchars($flash_message) . "</div>";
    }
    ?>

    <form method="POST" action="{{ route('prosesLogin') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>