<?php

class SiteController
{
	
	public function actionIndex()
	{
        $count = Db::getNewsCount();

		$latestNews = array();
		$latestNews = News::getLatestNews(3);

		require_once(ROOT.'/views/site/index.php');

		return true;
	}

}