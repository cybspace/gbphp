<form action="" method="post">
    <p><?=$comments_message?></p>
    <label for="name">Ваше имя:</label>
    <br>
    <input type="text" name="name" id="name" />
    <br>
    <label for="comment">Ваш отзыв:</label>
    <br>
    <textarea name="comment" id="comment" style="width: 300px; height: 150px;"></textarea>
    <br>
    <input type="submit" value="Отправить" />
</form>