<?php include ROOT . '/view/layouts/header.php'; ?>

<table border="0" align="center" width="800">
    <caption><h2>Редактировать</h2></caption>
    <tr height="50">
        <td>
            Заголовок<br>
            <input type="text" id="title" size="80" maxlength=250 value='<?=$news['title']?>'>
            <br>Дата<br>
            <input  type="date" id="date" value="<?=date('Y-m-d',$news["date"]) ?>">
            <br>Текст<br>
            <textarea name="text" id="text" cols="80" rows="25"><?=$news['text']?></textarea><br>
            <button type="button" align="left" id="btn-edit-news" data-id="<?=$news['id']?>" onclick="ajax_edit_news()">Сохранить изменения</button>
            <button type="button" id="btn-delete-news" data-id="<?=$news['id']?>" onclick="ajax_delete_news()">Удалить запись</button>
        </td>
    </tr>
</table>

<?php include ROOT . '/view/layouts/footer.php'; ?>