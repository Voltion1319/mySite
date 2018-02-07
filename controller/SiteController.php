<?php

class SiteController
{
    /**
     * display all news by page for users
     */
    public function actionIndex($page = 1)
    {
        $latestNews = News::getLatest($page);
        $pagination = new Pagination(News::Count(), $page, '/site/index');
        require_once(ROOT . '/view/site/index.php');
        return true;
    }

}