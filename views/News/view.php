<?php include ROOT . '/views/layouts/header.php'; ?>

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
                <form>
                    <textarea name="comment" id="comment" cols="40" rows="3"></textarea><br>
                    <button type="button" onclick="ajax_post();">Комментировать</button>
                </form>
            </td>
        </tr>

        <?php foreach($comments as $comment): ?>

            <tr>
                <td align="center"><?=$comment['text']?></td>
            </tr>

        <?php endforeach; ?>
    </table>


    <script>
        function ajax_post()
        {
            var xhr = new XMLHttpRequest();

            var comment = document.getElementById("comment").value;
            var url = "/news/addCommentAjax/20";
            var body = "comment="+comment;
            xhr.open("POST", url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function()
            {
                if(xhr.readyState == 4 && xhr.status==200)
                {
                    var res = JSON.parse(xhr.responseText);
                    for(text in res)
                    {
                        var parentEl = document.getElementById("table1");
                        var row = parentEl.insertRow(1);
                        var cell1 = row.insertCell(0);
                        cell1.innerHTML = res[text].text;
                        cell1.ClassName = '';

                    }
                }
            }
            xhr.send(body);
        }
    </script>

<?php include ROOT . '/views/layouts/footer.php'; ?>