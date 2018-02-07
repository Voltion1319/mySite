<?php

class NewsController
{
    /**
     * Display news in details
     */
    public function actionView($newsId)
    {
        $news = News::getById($newsId);
        $comments = Comment::getNewsComments($newsId);
        require_once(ROOT . '/view/news/view.php');
        return true;
    }
    /**
     * Add comment to news by ajax
     */
    public function actionAddCommentAjax($newsId)
    {
        Comment::add($newsId, $_POST['comment']);
        echo json_encode(Comment::getLast($newsId));
        return true;
    }
}