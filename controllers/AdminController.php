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

    public function actionEdit($newsId)
    {
        $news = News::getNewsById($newsId);

        require_once(ROOT . '/views/admin/edit.php');

        return true;
    }
}