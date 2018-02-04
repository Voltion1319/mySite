<?php

class SiteController
{
    /**
     * display all news by page for users
     */
    public function actionIndex($page = 1)
    {
        $total = News::getNewsCount();
        $latestNews = News::getLatestNews($page);
        $pagination = new Pagination($total, $page, '/news');
        require_once(ROOT.'/views/site/index.php');

        return true;
    }

}