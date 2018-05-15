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

    <table class="table" border="1">
        <tr>
            <th>id</th>
            <th>E-mail</th>
            <th>Сообщение</th>
            <th>Город</th>
            <th>Браузер</th>
            <th>Устройство</th>
            <th>ip</th>
        </tr>
        <?php foreach ($user_data as $userItem):?>
        <tr>
            <td><?= $userItem['id']?></td>
            <td><?= $userItem['email']?></td>
            <form action="/site/addAjax/<?= $userItem['id']?>" method="POST" id="form-mes">
            <td><textarea name="message" type="text" data-id="<?= $userItem['id']?>" class="message-area" id="message-area<?= $userItem['id']?>"><?= $userItem['message']?></textarea></td>
            </form>
            <td><?= $userItem['city']?></td>
            <td><?= $userItem['browser']?></td>
            <td><?= $userItem['device']?></td>
            <td><?= $userItem['ip']?></td>
        </tr>
        <?php endforeach; ?>
    </table>


<script type="text/javascript" src="/template/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $(".message-area").change(function (){
            var text = $(this).val();
            var id  = $(this).attr('data-id');
            $.ajax({
                url: "/site/addAjax/"+id,
                type: 'POST',
                data: {
                    message:text,
                    id:id
                },
                success:function(data){

                    var ob = "#message-area" + id;

                    $(ob).html(data);
                    alert('Данные успешно отредактированы');
                }
            });
            });

    });
</script>
</body>
</html>