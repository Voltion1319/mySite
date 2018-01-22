<?php

class SiteController
{
    public function actionIndex($page = 1)
    {

        $total = Db::getNewsCount();

        $start = ($page-1)*News::SHOW_BY_DEFAULT; // calculate position to start display news

        $latestNews = array();
        $latestNews = News::getLatestNews($start);

        $pagination = new Pagination($total, $page, '/news');

        require_once(ROOT.'/views/site/index.php');


        return true;
    }

}