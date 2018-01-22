<?php
return array(
    'news/page-([0-9]+)' => 'site/index/$1',
    'news/addCommentAjax/([0-9]+)' => 'news/addCommentAjax/$1',
    'news/([0-9]+)' => 'news/view/$1',
    'admin/page-([0-9]+)' => 'admin/index/$1',
    '' => 'site/index',
);