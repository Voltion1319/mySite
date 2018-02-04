<?php

class NewsController
{
    /**
     * Display news in details
     */
    public function actionView($newsId)
    {
        $news = News::getNewsById($newsId);
        $comments = Comment::getNewsComments($newsId);

        require_once(ROOT . '/views/news/view.php');

        return true;
    }

    /**
     * Add commemt to news by ajax
     */
    public function actionAddCommentAjax($newsId)
    {
        $comment = trim(htmlspecialchars($_POST['comment']));
        if($comment!="")
        {
            Comment::addComment($newsId, $comment);
            echo json_encode(Comment::getLastComment($newsId));
        }
        return true;
    }
}