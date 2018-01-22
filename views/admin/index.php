<?php include ROOT.'/views/layouts/header.php'; ?>

<table border="1" align="center" width="800" id = "news">
    <caption>
        <h2>
            Админ-панель
        </h2>
    </caption>
    <tr>
        <td colspan="4">
                Заголовок<br>
                <input type="text" id="title" size="80">
                <br>Дата<br>
                <input id="date" type="date">
                <br>Текст<br>
                <textarea name="text" id="text" cols="80" rows="3"></textarea>
                <br>
                <button type="button" onclick="ajax_add_news()">Добавить</button>
        </td>
    </tr>

    <?php foreach($latestNews as $news): ?>
    <tr>
        <td rowspan="2"><?=date('Y/m/d', $news['date'])?></td>
        <td>
            <a href="/news/<?=$news['id']?>">
                <h3><?=$news['title']?></h3>
            </a>
        </td>
        <td rowspan="2">
            <a href="/admin/view/<?=$news['id']?>"><h3>Редактировать</h3></a>
        </td>
    </tr>
    <tr height="50">
        <td>
            <?=mb_substr($news['text'],0,255,'UTF-8')?>...
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3">
            <?php  $pagination->show();  ?>
        </td>
    </tr>


</table>

<?php include ROOT.'/views/layouts/footer.php'; ?>