<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <?php if($result):?>
            <h3>Вы успешно подписались!Спасибо</h3>
            <div><a href="/">Назад</a></div>
            <div><a href="admin" type="submit" name="submit">Административная панель</a></div>
        <?php else:?>
        <h4>Форма ввода </h4>
        <?php if (isset($errors) && is_array($errors)):?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>- <?= $error?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <form action="" method="POST">
            <div class="email-wrapper">
                <label for="email">
                    E-mail
                </label><br>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="message-wrapper">
                <label for="message">
                    Message
                </label><br>
                <textarea type="message" name="message" id="message" ></textarea>
            </div>
            <div class="send-wrapper">
                <button type="submit" name="submit">Подписаться</button>
            </div>
        </form>
        <div class="send-wrapper">
            <a href="admin" type="submit" name="submit">Административная панель</a>
        </div>
        <?php endif;?>
    </div>
</body>
</html>