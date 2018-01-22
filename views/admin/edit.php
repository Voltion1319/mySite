<?php include ROOT.'/views/layouts/header.php'; ?>

<table border="0" align="center" width="800">
    <caption><h2>Редактировать</h2></caption>
    <tr height="50">
        <td>
            <form id = "formEdit">
                Заголовок<br>
                <input type="text" id="title" size="80" maxlength=250 value='<?=$news['title']?>'><br>
                Дата<br>
                <input  type="date" id="date" value="<?=date('Y-m-d',$news["date"]) ?>"><br>
                Текст<br>
                <textarea name="text" id="text" cols="80" rows="25"><?=$news['text']?></textarea><br>
                <button type="submit" align="left">Сохранить изменения</button>
            </form>
            <form id = "formDelete">
                <button type="submit">Удалить запись</button>
            </form>
        </td>
    </tr>
</table>

<?php include ROOT.'/views/layouts/footer.php'; ?>