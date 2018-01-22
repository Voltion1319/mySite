<?php
return array(
    'news/page-([0-9]+)' => 'site/index/$1',
    'news/addCommentAjax/([0-9]+)' => 'news/addCommentAjax/$1',
    'news/([0-9]+)' => 'news/view/$1',
    'admin/page-([0-9]+)' => 'admin/index/$1',
    'admin/view/([0-9]+)' => 'admin/view/$1',
    'admin/edit/([0-9]+)' => 'admin/edit/$1',
    'admin/delete/([0-9]+)' => 'admin/delete/$1',
    'admin/add' => 'admin/add',
    '' => 'site/index',
);