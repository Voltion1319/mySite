<?php include ROOT . '/view/layouts/header.php'; ?>

    <table border="1" align="center" width="800" id = "news">
        <caption><h2> Новости </h2></caption>


        <?php foreach($latestNews as $news): ?>
        <tr>
            <td rowspan="2"><?=date('Y/m/d', $news['date'])?></td>
            <td>
                <a href="/news/<?=$news['id']?>">
                    <h3><?=$news['title']?></h3>
                </a>
            </td>

        </tr>
        <tr height="50">
            <td>
                <?=mb_substr($news['text'],0,255,'UTF-8')?>...
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2">
                <?php  $pagination->show();  ?>
            </td>
        </tr>


    </table>

<?php include ROOT . '/view/layouts/footer.php'; ?>