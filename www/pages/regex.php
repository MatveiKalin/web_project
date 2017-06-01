<?php

echo '<h1>Преподаватели кафедры ИТАС с сайта "itas.pstu.ru"</h1>';
echo '<h2>С помощью регулярных выражений</h2>';
echo '<a href="../index.php"><< Назад</a>';

$html = file_get_contents('http://itas.pstu.ru/wiki/index.php/%D0%9F%D1%80%D0%B5%D0%BF%D0%BE%D0%B4%D0%B0%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D0%B8');

//echo $html;

preg_match_all('#<p>.*?<a.*?</a>.*?</p>#su', $html, $res);

foreach ($res[0] as $value) {
    echo $value;
}
