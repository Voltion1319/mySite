<?php

class NewsController
{
    public function actionView($newsId)
    {
        $news = News::getNewsById($newsId);
        $comments = Comment::getNewsComments($newsId);

        require_once(ROOT . '/views/news/view.php');

        return true;
    }

    public function actionAddCommentAjax($newsId)
    {
        //$comment = trim(htmlspecialchars($_POST['comment']));
        //echo "[f[ff[f[[[ff[f[ =  ".$newsId;
        echo json_encode(Comment::getLastComment($newsId));

    }
}