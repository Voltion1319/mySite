<?php

class AdminController
{
    /**
     * display list of all news by pages with adding new news for admin
     */
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
    /**
     * display news to deleting or editing
     */
    public function actionView($newsId)
    {
        $news = News::getNewsById($newsId);

        require_once(ROOT . '/views/admin/view.php');

        return true;
    }

    /**
     * action delete to ajax request
     */
    public function actionDelete($newsId)
    {
        News::deleteNewsById($newsId);
        return true;
    }

    /**
     * action edit to ajax request
     */
    public function actionEdit($newsId)
    {
        $title = trim(htmlspecialchars($_POST['title']));
        $text = trim(htmlspecialchars($_POST['text']));
        $date = trim(htmlspecialchars($_POST['date']));

        News::editNewsById($newsId, $title, $date, $text);

        return true;
    }

    /**
     * action add to ajax request
     */
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