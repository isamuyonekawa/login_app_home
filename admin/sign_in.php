<?php
require('dbconnect.php');
session_start();

if (isset($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $state = $db->prepare('SELECT * FROM admin WHERE user_name=?');
  $state->execute(array(
    $_POST['user_name']
  ));
  $user = $state->fetch();
  
  $errors = array();
  if ($user && password_verify($_POST['password'], $user['password']) && $user['delete_flag'] == 0) {
    //セッションIDの変更
    session_regenerate_id(true);
    $_SESSION['id'] = $user['id'];
    header('Location: index.php');
    exit();
  } else {
    $errors['sign_in'] = 'ユーザー名またはパスワードが間違っています';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
    <header>
        <a href="/login_app/time_record.php">タイムカード</a>
    </header>
    <h1>管理者ログイン</h1>

    <?php if (!empty($errors)): ?>
        <ul class="validation_error">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="name">ユーザー名:</label>
            <input type="text" id="name" name="user_name" autofocus>
        </div>
        <div>
            <label for="pass">パスワード:</label>
            <input type="password" id="pass" name="password">
        </div>
        <div class="button">
            <button type="submit">ログイン</button>
        </div>
    </form>
</body>
</html>