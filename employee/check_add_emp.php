<?php
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join']) && !isset($_SESSION['id'])) {
    header('Location: /login_app/admin/sign_in.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $hurigana = $_SESSION['join']['last_hurigana'] . ' ' . $_SESSION['join']['first_hurigana'];
    $name = $_SESSION['join']['last_name'] . ' ' . $_SESSION['join']['first_name'];
    $emp_user_name = $_SESSION['join']['emp_user_name'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['join'])) {
    $state = $db->prepare('INSERT INTO employees SET last_hurigana=?, first_hurigana=?, last_name=?, first_name=?, emp_user_name=?, created_at=NOW()');
    $state->execute(array(
        $_SESSION['join']['last_hurigana'],
        $_SESSION['join']['first_hurigana'],
        $_SESSION['join']['last_name'],
        $_SESSION['join']['first_name'],
        $_SESSION['join']['emp_user_name']
    ));
    unset($_SESSION['join']);
    
    header('Location: /login_app/admin/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>社員登録確認</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/emp_form.css">
</head>
<body>
    <header>
    </header>
    <div class="main">
        <h1>社員登録確認</h1>
        <form action="" method="POST">
            <div>
                <table>
                    <tr>
                        <td class="table-left">ふりがな:</td>
                        <td class="table-right"><?php echo htmlspecialchars($hurigana, ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td class="table-left">お名前:</td>
                        <td class="table-right"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td class="table-left">ユーザー名:</td>
                        <td class="table-right"><?php echo htmlspecialchars($emp_user_name, ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td class="table-left"><a href="add_emp.php">戻る</a></td>
                        <td class="table-right"><button type="submit">登録する</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    <footer>
    </footer>
</body>
</html>