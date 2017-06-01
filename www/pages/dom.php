<?php

//Подгружаем библиотеку "PHP Simple HTML DOM Parser" www.simplehtmldom.sourceforge.net
require_once '../components/simple_html_dom.php';

echo '<h1>Преподаватели кафедры ИТАС с сайта "itas.pstu.ru"</h1>';
echo '<h2>С помощью DOM</h2>';
echo '<a href="../index.php"><< Назад</a>';

$html = file_get_html('http://itas.pstu.ru/wiki/index.php/%D0%9F%D1%80%D0%B5%D0%BF%D0%BE%D0%B4%D0%B0%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D0%B8');

$main = $html->find('div[id=mw-content-text]', 0);

echo '<ol>';

// Находим все ссылки 
foreach($main->find('a') as $element) {
    
    if ( ($element->title != 'Косяков Антон Павлович (страница не существует)') ) {
        echo '<li><a href="http://itas.pstu.ru' . $element->href .  '">' . $element->title . '</a><br>';

        $html_teacher = file_get_html('http://itas.pstu.ru' . $element->href);

        if ( count($html_teacher->find('img')) > 2 ) {
            $photo = $html_teacher->find('img', 1);

            echo '<img src="http://itas.pstu.ru' . $photo->src . '" /></li>';
        }
    }       
}

echo '</ol>';


