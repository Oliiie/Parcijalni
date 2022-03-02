<?php
    if(isset($_POST['login'])){
        $user = htmlspecialchars($_POST['nickname']);
        require_once './classes/DB.php';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="title">
            <p>CHAT Login</p>
        </div>
        <nav>
            <ul>
                <li><a href="./index.php" class="btn"></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="chat.php" method="post">
            <input type="text" name="nickname" id="" placeholder="nickname" required>
            <input type="submit" value="login" name="login">
        </form>
    </main>
</body>
</html>