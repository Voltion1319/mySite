<?php include ROOT . '/view/layouts/header.php'; ?>

    <table border="0" align="center" width="800">
        <caption><h2> <?=$news['title']?> </h2></caption>

        <tr height="50">
            <td align="center" ><?=$news['text']?></td>
        </tr>
    </table>

    <table border="1" align="center" width="800" id="table1">
        <caption><h2>Комментарии</h2></caption>
        <tr>
            <td align="center">
                <textarea name="comment" id="comment" cols="40" rows="3"></textarea><br>
                <button type="button" id="btn-add-comm" data-id="<?=$news['id']?>" onclick="ajax_add_comment();">Комментировать</button>
            </td>
        </tr>

        <?php foreach($comments as $comment): ?>

            <tr>
                <td align="center"><?=$comment['text']?></td>
            </tr>

        <?php endforeach; ?>
    </table>

<?php include ROOT . '/view/layouts/footer.php'; ?>