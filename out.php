<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>TOP</title>
</head>
<body>
    <header>
        <a href="./admin/sign_in.php">管理者ログイン</a>
    </header>

    <h1 id="time"></h1>
    <script>
        time();
        function time(){
            var now = new Date();
            document.getElementById("time").innerHTML = now.toLocaleString();
        }
        setInterval('time()',1000);
    </script>

    <h2>出勤</h2>
    <form>
        <label></label>
        <div>
            <input type="text" name="emp_user_id" required>
        </div>
        <div class="button">
            <button type="submit">打刻</button>
        </div>
    </form>

    <aside>

    </aside>
</body>
</html>
