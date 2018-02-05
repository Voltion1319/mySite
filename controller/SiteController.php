<?php

class SiteController
{
    /**
     * display all news by page for users
     */
    public function actionIndex($page = 1)
    {
        $total = News::Count();
        $latestNews = News::getLatest($page);
        $pagination = new Pagination($total, $page, '/news');
        require_once(ROOT . '/view/site/index.php');

        return true;
    }

}