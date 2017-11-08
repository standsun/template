<?php
define('ROOT_PATH',dirname(dirname(__file__)) . '/');

include ROOT_PATH . 'template.php';

$Template = new Template();
$Template->assign(array(
    'title' =>  '测试标题',
    'list'  =>  array(
        array(
            'title' =>  '文章一',
            'author'=>  '作者一',
        ),
        array(
            'title' =>  '文章二',
            'author'=>  '作者二',
        ),
        array(
            'title' =>  '文章三',
            'author'=>  '作者三',
        ),
    ),
))->render(ROOT_PATH . 'test/example.html');
