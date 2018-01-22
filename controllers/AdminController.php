<?php

class AdminController
{
    public function actionIndex($page = 1)
    {
        $total = Db::getNewsCount();

        $start = ($page-1)*News::SHOW_BY_DEFAULT; // calculate position to start display news

        $latestNews = array();
        $latestNews = News::getLatestNews($start);

        $pagination = new Pagination($total, $page,'/admin');

        require_once(ROOT.'/views/admin/index.php');

        return true;
    }

    public function actionView($newsId)
    {
        $news = News::getNewsById($newsId);

        require_once(ROOT . '/views/admin/view.php');

        return true;
    }

    public function actionDelete($newsId)
    {
        News::deleteNewsById($newsId);
        return true;
    }

    public function actionEdit($newsId)
    {
        $title = trim(htmlspecialchars($_POST['title']));
        $text = trim(htmlspecialchars($_POST['text']));
        $date = trim(htmlspecialchars($_POST['date']));

        News::editNewsById($newsId, $title, $date, $text);

        return true;
    }

    public function actionAdd()
    {
        $title = trim(htmlspecialchars($_POST['title']));
        $text = trim(htmlspecialchars($_POST['text']));
        $date = trim(htmlspecialchars($_POST['date']));

        News::addNews($title, $date, $text);

        echo json_encode(News::getLastNews());
        return true;
    }

}