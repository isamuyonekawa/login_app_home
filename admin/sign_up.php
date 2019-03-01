<?php
require('dbconnect.php');
require('admin_validations.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $errors = array();
  
  $error = user_name_validation($_POST['user_name']);
  if (isset($error)) {
    $errors['user_name'] = $error;
  }

  $error = password_validation($_POST['password'], $_POST['user_name']);
  if (isset($error)) {
    $errors['password'] = $error;
  }
  
  $error = confirmation_validation($_POST['confirmation'], $_POST['password']);
  if (isset($error)) {
    $errors['confirmation'] = $error;
  }
  
  if (empty($errors)) {
    $_SESSION['join'] = $_POST;
    header('Location: check_sign_up.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>フォーム</title>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
  </head>
  <body>
    <header>
      <a href="/login_app/time_record.php">タイムカード</a>
    </header>
    <h1>Sign Up</h1>

    <?php if (!empty($errors)): ?>
      <ul class="validation_error">
        <?php foreach ($errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form action="" method="post">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="user_name" minlength="5">
      </div>
      <div>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="password" minlength="8">
      </div>
      <div>
        <label for="confirmation">Confirmation:</label>
        <input type="password" id="confirmation" name="confirmation">
      </div>
      <div class="button">
        <button type="submit">Send</button>
      </div>
    </form>
  </body>
</html>